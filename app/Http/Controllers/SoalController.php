<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use App\Models\McqAttempt;
use App\Models\McqQuestion;
use App\Models\UserActivity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SoalController extends Controller
{
    /**
     * Default working time in minutes when the teacher has not set one.
     */
    public const int DEFAULT_DURATION_MINUTES = 15;

    /**
     * Show the quiz card per difficulty level; the details open in a popup before the student starts.
     */
    public function index(Request $request): View
    {
        return view('soal', [
            'levels' => McqQuestion::DIFFICULTIES,
            'counts' => $this->questionCounts(),
            'durationMinutes' => self::durationMinutes(),
            'description' => AppSetting::read('mcq_description', 'Jawab soal situasi sosial seputar nilai dan norma, lalu periksa pembahasannya.'),
            'attempts' => $request->user()->mcqAttempts()->latest('created_at')->take(5)->get(),
        ]);
    }

    /**
     * Show the timed exam page without revealing the answers.
     *
     * The optional level query parameter narrows the exam to one difficulty level.
     */
    public function start(Request $request): View|RedirectResponse
    {
        $level = $request->query('level');

        if ($level !== null && (! is_string($level) || ! isset(McqQuestion::DIFFICULTIES[$level]))) {
            return redirect()->route('soal')->with('status', 'Level soal tidak tersedia.');
        }

        $questions = McqQuestion::active()
            ->when($level !== null, fn ($query) => $query->difficulty($level))
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->map(fn (McqQuestion $question) => [
                'id' => $question->id,
                'question' => $question->question,
                'options' => $question->options,
            ]);

        if ($questions->isEmpty()) {
            return redirect()
                ->route('soal')
                ->with('status', $level !== null ? 'Belum ada soal pada level ini.' : 'Belum ada soal tersedia.');
        }

        $request->session()->put('mcq_started_at', now()->timestamp);

        return view('soal-kerjakan', [
            'questions' => $questions,
            'durationMinutes' => self::durationMinutes(),
            'level' => $level,
        ]);
    }

    /**
     * Score the submitted answers server-side and store the attempt.
     *
     * Unanswered questions (for example when the timer runs out) count as wrong.
     */
    public function submit(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'answers' => ['nullable', 'array'],
            'answers.*' => ['nullable', 'integer', 'min:0', 'max:3'],
            'level' => ['nullable', 'string', Rule::in(array_keys(McqQuestion::DIFFICULTIES))],
        ]);

        $level = $validated['level'] ?? null;

        $answers = collect($validated['answers'] ?? [])
            ->filter(fn ($value) => $value !== null && $value !== '');

        $questions = McqQuestion::active()
            ->when($level !== null, fn ($query) => $query->difficulty($level))
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        if ($answers->keys()->diff($questions->pluck('id'))->isNotEmpty()) {
            return response()->json([
                'message' => 'Jawaban tidak valid. Muat ulang halaman lalu coba lagi.',
            ], 422);
        }

        if ($questions->isEmpty()) {
            return response()->json(['message' => 'Belum ada soal tersedia.'], 422);
        }

        $review = [];
        $score = 0;

        foreach ($questions as $question) {
            $chosen = $answers->has($question->id) ? (int) $answers[$question->id] : null;
            $isCorrect = $chosen === $question->correct_index;
            $score += $isCorrect ? 1 : 0;

            $review[] = [
                'question_id' => $question->id,
                'question' => $question->question,
                'options' => $question->options,
                'chosen_index' => $chosen,
                'correct_index' => $question->correct_index,
                'is_correct' => $isCorrect,
                'explanation' => $question->explanation,
            ];
        }

        $startedAt = $request->session()->pull('mcq_started_at');
        $duration = $startedAt
            ? min(max(now()->timestamp - (int) $startedAt, 0), 65535)
            : null;

        $attempt = DB::transaction(function () use ($request, $answers, $score, $review, $duration, $level) {
            $attempt = McqAttempt::create([
                'user_id' => $request->user()->id,
                'score' => $score,
                'total' => count($review),
                'difficulty' => $level,
                'answers' => $answers->all(),
                'duration_seconds' => $duration,
                'review' => $review,
            ]);

            UserActivity::complete($request->user()->id, 'soal');

            return $attempt;
        });

        return response()->json([
            'score' => $score,
            'total' => count($review),
            'results' => $review,
            'redirect' => route('soal.hasil', $attempt),
        ]);
    }

    /**
     * Show the score and the review of one attempt of the signed-in student.
     */
    public function result(Request $request, McqAttempt $attempt): View
    {
        abort_unless($attempt->user_id === $request->user()->id, 404);

        return view('soal-hasil', ['attempt' => $attempt]);
    }

    /**
     * The working time of the quiz in minutes.
     */
    public static function durationMinutes(): int
    {
        return max(1, (int) AppSetting::read('mcq_duration_minutes', (string) self::DEFAULT_DURATION_MINUTES));
    }

    /**
     * Number of active questions available for every difficulty level.
     *
     * @return Collection<string, int>
     */
    private function questionCounts(): Collection
    {
        return McqQuestion::active()
            ->selectRaw('difficulty, COUNT(*) as total')
            ->groupBy('difficulty')
            ->get()
            ->pluck('total', 'difficulty');
    }
}
