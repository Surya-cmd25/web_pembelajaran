<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Norm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class NormController extends Controller
{
    /**
     * The colors available for a norm card.
     *
     * @var list<string>
     */
    private const array COLORS = ['blue', 'rose', 'emerald', 'amber'];

    /**
     * List every norm ordered by sort order.
     */
    public function index(): View
    {
        $norms = Norm::orderBy('sort_order')->orderBy('name')->get();

        return view('admin.norma.index', compact('norms'));
    }

    /**
     * Show the form to create a new norm.
     */
    public function create(): View
    {
        return view('admin.norma.create', [
            'colors' => self::COLORS,
            'nextSortOrder' => (int) Norm::max('sort_order') + 1,
        ]);
    }

    /**
     * Persist a new norm.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateNorm($request);
        $validated['illustration_path'] = $this->storeIllustration($request);

        Norm::create($validated);

        return redirect()
            ->route('admin.norma.index')
            ->with('status', 'Norma berhasil ditambahkan.');
    }

    /**
     * Show the form to edit an existing norm.
     */
    public function edit(Norm $norma): View
    {
        return view('admin.norma.edit', [
            'norm' => $norma,
            'colors' => self::COLORS,
        ]);
    }

    /**
     * Update an existing norm.
     */
    public function update(Request $request, Norm $norma): RedirectResponse
    {
        $validated = $this->validateNorm($request, $norma);

        if ($request->hasFile('illustration_path')) {
            if ($norma->illustration_path && Storage::disk('public')->exists($norma->illustration_path)) {
                Storage::disk('public')->delete($norma->illustration_path);
            }

            $validated['illustration_path'] = $this->storeIllustration($request);
        }

        $norma->update($validated);

        return redirect()
            ->route('admin.norma.index')
            ->with('status', 'Norma berhasil diperbarui.');
    }

    /**
     * Delete a norm and its illustration file.
     */
    public function destroy(Norm $norma): RedirectResponse
    {
        if ($norma->illustration_path && Storage::disk('public')->exists($norma->illustration_path)) {
            Storage::disk('public')->delete($norma->illustration_path);
        }

        $norma->delete();

        return redirect()
            ->route('admin.norma.index')
            ->with('status', 'Norma berhasil dihapus.');
    }

    /**
     * Validate the norm payload shared by store and update.
     *
     * @return array<string, mixed>
     */
    private function validateNorm(Request $request, ?Norm $norm = null): array
    {
        $this->normalizeListFields($request);

        return $request->validate([
            'slug' => [
                'required',
                'string',
                'max:100',
                Rule::unique('norms', 'slug')->ignore($norm),
            ],
            'name' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:2000'],
            'examples' => ['required', 'array', 'min:1'],
            'examples.*' => ['required', 'string', 'max:300'],
            'sanctions' => ['required', 'array', 'min:1'],
            'sanctions.*' => ['required', 'string', 'max:300'],
            'color' => ['required', 'in:'.implode(',', self::COLORS)],
            'illustration_path' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);
    }

    /**
     * Drop empty list entries submitted from the dynamic example/sanction rows.
     */
    private function normalizeListFields(Request $request): void
    {
        foreach (['examples', 'sanctions'] as $field) {
            $values = array_map(
                static fn ($value): string => trim((string) $value),
                $request->input($field, [])
            );

            $request->merge([
                $field => array_values(array_filter($values, static fn (string $value): bool => $value !== '')),
            ]);
        }
    }

    /**
     * Store the uploaded illustration on the public disk.
     */
    private function storeIllustration(Request $request): ?string
    {
        if (! $request->hasFile('illustration_path')) {
            return null;
        }

        return $request->file('illustration_path')->store('illustrations', 'public');
    }
}
