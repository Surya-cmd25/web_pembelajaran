<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PuzzleLevel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PuzzleLevelController extends Controller
{
    /**
     * List the configured puzzle levels.
     */
    public function index(): View
    {
        return view('admin.puzzle.index', [
            'levels' => PuzzleLevel::orderBy('level')->get(),
            'maxLevels' => PuzzleLevel::MAX_LEVELS,
        ]);
    }

    /**
     * Show the form to add a level.
     */
    public function create(): View|RedirectResponse
    {
        $free = $this->freeLevelNumbers();

        if ($free === []) {
            return redirect()
                ->route('admin.puzzle.index')
                ->with('error', 'Level puzzle maksimal '.PuzzleLevel::MAX_LEVELS.'. Hapus salah satu level untuk menambah yang baru.');
        }

        return view('admin.puzzle.create', ['freeLevels' => $free]);
    }

    /**
     * Persist a new level.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateLevel($request);

        if (PuzzleLevel::count() >= PuzzleLevel::MAX_LEVELS) {
            return redirect()
                ->route('admin.puzzle.index')
                ->with('error', 'Level puzzle maksimal '.PuzzleLevel::MAX_LEVELS.'.');
        }

        $validated['image_path'] = $request->hasFile('image')
            ? $request->file('image')->store('puzzle', 'public')
            : null;

        PuzzleLevel::create($validated);

        return redirect()->route('admin.puzzle.index')->with('status', 'Level puzzle berhasil ditambahkan.');
    }

    /**
     * Show the form to edit a level.
     */
    public function edit(PuzzleLevel $puzzle): View
    {
        return view('admin.puzzle.edit', ['level' => $puzzle]);
    }

    /**
     * Update a level.
     */
    public function update(Request $request, PuzzleLevel $puzzle): RedirectResponse
    {
        $validated = $this->validateLevel($request, $puzzle);

        if ($request->hasFile('image')) {
            $this->deleteImage($puzzle);
            $validated['image_path'] = $request->file('image')->store('puzzle', 'public');
        } elseif ($request->boolean('remove_image')) {
            $this->deleteImage($puzzle);
            $validated['image_path'] = null;
        }

        $puzzle->update($validated);

        return redirect()->route('admin.puzzle.index')->with('status', 'Level puzzle berhasil diperbarui.');
    }

    /**
     * Delete a level and its picture.
     */
    public function destroy(PuzzleLevel $puzzle): RedirectResponse
    {
        $this->deleteImage($puzzle);
        $puzzle->delete();

        return redirect()->route('admin.puzzle.index')->with('status', 'Level puzzle berhasil dihapus.');
    }

    /**
     * Validate the level payload and convert minutes into seconds.
     *
     * @return array<string, mixed>
     */
    private function validateLevel(Request $request, ?PuzzleLevel $level = null): array
    {
        $validated = $request->validate([
            'level' => ['required', 'integer', 'between:1,'.PuzzleLevel::MAX_LEVELS, Rule::unique('puzzle_levels', 'level')->ignore($level)],
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:2000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'rows' => ['required', 'integer', 'between:2,6'],
            'cols' => ['required', 'integer', 'between:2,6'],
            'time_minutes' => ['required', 'integer', 'between:1,60'],
        ]);

        $validated['time_limit'] = $validated['time_minutes'] * 60;
        $validated['is_active'] = $request->boolean('is_active');

        unset($validated['image'], $validated['time_minutes']);

        return $validated;
    }

    /**
     * Level numbers that are not used yet.
     *
     * @return list<int>
     */
    private function freeLevelNumbers(): array
    {
        $used = PuzzleLevel::pluck('level')->all();

        return array_values(array_diff(range(1, PuzzleLevel::MAX_LEVELS), $used));
    }

    /**
     * Remove the stored picture of a level.
     */
    private function deleteImage(PuzzleLevel $level): void
    {
        if ($level->image_path && Storage::disk('public')->exists($level->image_path)) {
            Storage::disk('public')->delete($level->image_path);
        }
    }
}
