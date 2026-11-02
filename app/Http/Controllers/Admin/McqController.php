<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\McqQuestion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class McqController extends Controller
{
    /**
     * List every multiple-choice question ordered by sort order.
     */
    public function index(): View
    {
        $questions = McqQuestion::orderBy('sort_order')->orderBy('id')->get();

        return view('admin.soal-pilihan-ganda.index', compact('questions'));
    }

    /**
     * Show the form to create a new question.
     */
    public function create(): View
    {
        return view('admin.soal-pilihan-ganda.create', [
            'nextSortOrder' => (int) McqQuestion::max('sort_order') + 1,
        ]);
    }

    /**
     * Persist a new question.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateQuestion($request);
        $validated['is_active'] = $request->boolean('is_active');

        McqQuestion::create($validated);

        return redirect()
            ->route('admin.soal-pilihan-ganda.index')
            ->with('status', 'Soal pilihan ganda berhasil ditambahkan.');
    }

    /**
     * Show the form to edit an existing question.
     */
    public function edit(McqQuestion $soal_pilihan_ganda): View
    {
        return view('admin.soal-pilihan-ganda.edit', ['question' => $soal_pilihan_ganda]);
    }

    /**
     * Update an existing question.
     */
    public function update(Request $request, McqQuestion $soal_pilihan_ganda): RedirectResponse
    {
        $validated = $this->validateQuestion($request);
        $validated['is_active'] = $request->boolean('is_active');

        $soal_pilihan_ganda->update($validated);

        return redirect()
            ->route('admin.soal-pilihan-ganda.index')
            ->with('status', 'Soal pilihan ganda berhasil diperbarui.');
    }

    /**
     * Delete a question.
     */
    public function destroy(McqQuestion $soal_pilihan_ganda): RedirectResponse
    {
        $soal_pilihan_ganda->delete();

        return redirect()
            ->route('admin.soal-pilihan-ganda.index')
            ->with('status', 'Soal pilihan ganda berhasil dihapus.');
    }

    /**
     * Validate the question payload shared by store and update.
     *
     * @return array<string, mixed>
     */
    private function validateQuestion(Request $request): array
    {
        return $request->validate([
            'question' => ['required', 'string', 'max:1000'],
            'options' => ['required', 'array', 'size:4'],
            'options.*' => ['required', 'string', 'max:500'],
            'correct_index' => ['required', 'integer', 'in:0,1,2,3'],
            'explanation' => ['nullable', 'string', 'max:1000'],
            'sort_order' => ['required', 'integer', 'min:1', 'max:100'],
        ]);
    }
}
