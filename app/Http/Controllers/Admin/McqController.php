<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SoalController;
use App\Models\AppSetting;
use App\Models\McqAttempt;
use App\Models\McqQuestion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class McqController extends Controller
{
    /**
     * List every multiple-choice question ordered by sort order.
     *
     * The optional level query parameter narrows the list to one difficulty level.
     */
    public function index(Request $request): View
    {
        $level = $request->query('level');

        if ($level !== null && (! is_string($level) || ! isset(McqQuestion::DIFFICULTIES[$level]))) {
            $level = null;
        }

        $questions = McqQuestion::query()
            ->when($level !== null, fn ($query) => $query->difficulty($level))
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.soal-pilihan-ganda.index', [
            'questions' => $questions,
            'levels' => McqQuestion::DIFFICULTIES,
            'counts' => $this->difficultyCounts(),
            'activeLevel' => $level,
            'totalQuestions' => McqQuestion::count(),
            'durationMinutes' => SoalController::durationMinutes(),
            'description' => AppSetting::read('mcq_description', ''),
        ]);
    }

    /**
     * Show the form to create a new question.
     */
    public function create(): View
    {
        return view('admin.soal-pilihan-ganda.create', [
            'nextSortOrder' => (int) McqQuestion::max('sort_order') + 1,
            'levels' => McqQuestion::DIFFICULTIES,
            'defaultDifficulty' => McqQuestion::DEFAULT_DIFFICULTY,
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
        return view('admin.soal-pilihan-ganda.edit', [
            'question' => $soal_pilihan_ganda,
            'levels' => McqQuestion::DIFFICULTIES,
            'defaultDifficulty' => McqQuestion::DEFAULT_DIFFICULTY,
        ]);
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
     * List the quiz attempts submitted by students.
     */
    public function results(Request $request): View
    {
        $q = $request->query('q');

        $attempts = McqAttempt::with('user:id,name,email')
            ->when($q, fn ($query, $term) => $query->whereHas(
                'user',
                fn ($user) => $user->where('name', 'like', "%{$term}%")->orWhere('email', 'like', "%{$term}%")
            ))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.soal-pilihan-ganda.hasil', [
            'attempts' => $attempts,
            'q' => $q,
        ]);
    }

    /**
     * Show one attempt with the review of right and wrong answers.
     */
    public function showResult(McqAttempt $attempt): View
    {
        return view('admin.soal-pilihan-ganda.hasil-show', [
            'attempt' => $attempt->load('user:id,name,email'),
        ]);
    }

    /**
     * Save the description and working time shown to students.
     */
    public function updateSettings(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'duration_minutes' => ['required', 'integer', 'min:1', 'max:240'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        AppSetting::write('mcq_duration_minutes', (string) $validated['duration_minutes']);
        AppSetting::write('mcq_description', $validated['description'] ?? null);

        return back()->with('status', 'Pengaturan soal berhasil disimpan.');
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
            'difficulty' => ['required', Rule::in(array_keys(McqQuestion::DIFFICULTIES))],
            'options' => ['required', 'array', 'size:4'],
            'options.*' => ['required', 'string', 'max:500'],
            'correct_index' => ['required', 'integer', 'in:0,1,2,3'],
            'explanation' => ['nullable', 'string', 'max:1000'],
            'sort_order' => ['required', 'integer', 'min:1', 'max:100'],
        ]);
    }

    /**
     * Number of questions stored for every difficulty level, active or not.
     *
     * @return Collection<string, int>
     */
    private function difficultyCounts(): Collection
    {
        return McqQuestion::query()
            ->selectRaw('difficulty, COUNT(*) as total')
            ->groupBy('difficulty')
            ->get()
            ->pluck('total', 'difficulty');
    }
}
