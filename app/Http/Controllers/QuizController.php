<?php

namespace App\Http\Controllers;

use App\Models\QuizAttempt;
use App\Models\QuizPair;
use App\Models\UserActivity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class QuizController extends Controller
{
    /**
     * Show the matching quiz page.
     */
    public function index(): View
    {
        return view('quiz', [
            'pairCount' => QuizPair::active()->count(),
            'latestScore' => auth()->user()?->quizAttempts()->latest('created_at')->first(),
        ]);
    }

    /**
     * Provide a freshly shuffled round of three situations.
     *
     * The correct norms are intentionally excluded from the payload.
     */
    public function round(): JsonResponse
    {
        $pairs = QuizPair::active()
            ->inRandomOrder()
            ->take(3)
            ->get(['id', 'situation']);

        return response()->json([
            'pairs' => $pairs->values(),
            'norms' => collect(QuizPair::NORM_TYPES)->shuffle()->values(),
        ]);
    }

    /**
     * Score a submitted round server-side and store the attempt.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'answers' => ['required', 'array', 'min:1'],
            'answers.*' => ['required', 'string', Rule::in(QuizPair::NORM_TYPES)],
        ]);

        $answers = $validated['answers'];

        $pairs = QuizPair::active()->whereIn('id', array_keys($answers))->get();

        if ($pairs->count() !== count($answers)) {
            return response()->json([
                'message' => 'Pasangan soal tidak valid. Muat ulang ronde baru.',
            ], 422);
        }

        $results = [];
        $score = 0;

        foreach ($answers as $pairId => $chosenNorm) {
            $pair = $pairs->firstWhere('id', (int) $pairId);

            $isCorrect = $pair->correct_norm === $chosenNorm;
            $score += $isCorrect ? 1 : 0;

            $results[] = [
                'pair_id' => $pair->id,
                'situation' => $pair->situation,
                'chosen' => $chosenNorm,
                'correct' => $pair->correct_norm,
                'is_correct' => $isCorrect,
                'explanation' => $pair->explanation,
            ];
        }

        $total = count($results);

        DB::transaction(function () use ($request, $answers, $score, $total) {
            QuizAttempt::create([
                'user_id' => $request->user()->id,
                'score' => $score,
                'total' => $total,
                'answers' => $answers,
            ]);

            UserActivity::complete($request->user()->id, 'quiz');
        });

        return response()->json([
            'score' => $score,
            'total' => $total,
            'results' => $results,
        ]);
    }
}
