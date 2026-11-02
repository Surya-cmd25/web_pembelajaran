<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuizPair;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuizPairController extends Controller
{
    /**
     * Human-readable labels for each norm type.
     *
     * @var array<string, string>
     */
    private const array NORM_LABELS = [
        'agama' => 'Norma Agama',
        'kesusilaan' => 'Norma Kesusilaan',
        'kesopanan' => 'Norma Kesopanan',
        'hukum' => 'Norma Hukum',
    ];

    /**
     * List every quiz pair.
     */
    public function index(): View
    {
        $pairs = QuizPair::orderBy('id')->get();

        return view('admin.pasangan-quiz.index', [
            'pairs' => $pairs,
            'normLabels' => self::NORM_LABELS,
        ]);
    }

    /**
     * Show the form to create a new quiz pair.
     */
    public function create(): View
    {
        return view('admin.pasangan-quiz.create', ['normLabels' => self::NORM_LABELS]);
    }

    /**
     * Persist a new quiz pair.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatePair($request);
        $validated['is_active'] = $request->boolean('is_active');

        QuizPair::create($validated);

        return redirect()
            ->route('admin.pasangan-quiz.index')
            ->with('status', 'Pasangan quiz berhasil ditambahkan.');
    }

    /**
     * Show the form to edit an existing quiz pair.
     */
    public function edit(QuizPair $pasangan_quiz): View
    {
        return view('admin.pasangan-quiz.edit', [
            'pair' => $pasangan_quiz,
            'normLabels' => self::NORM_LABELS,
        ]);
    }

    /**
     * Update an existing quiz pair.
     */
    public function update(Request $request, QuizPair $pasangan_quiz): RedirectResponse
    {
        $validated = $this->validatePair($request);
        $validated['is_active'] = $request->boolean('is_active');

        $pasangan_quiz->update($validated);

        return redirect()
            ->route('admin.pasangan-quiz.index')
            ->with('status', 'Pasangan quiz berhasil diperbarui.');
    }

    /**
     * Delete a quiz pair.
     */
    public function destroy(QuizPair $pasangan_quiz): RedirectResponse
    {
        $pasangan_quiz->delete();

        return redirect()
            ->route('admin.pasangan-quiz.index')
            ->with('status', 'Pasangan quiz berhasil dihapus.');
    }

    /**
     * Validate the quiz pair payload shared by store and update.
     *
     * @return array<string, mixed>
     */
    private function validatePair(Request $request): array
    {
        return $request->validate([
            'situation' => ['required', 'string', 'max:255'],
            'correct_norm' => ['required', 'in:'.implode(',', QuizPair::NORM_TYPES)],
            'explanation' => ['nullable', 'string', 'max:1000'],
        ]);
    }
}
