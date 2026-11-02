<?php

namespace App\Http\Controllers;

use App\Models\McqAttempt;
use App\Models\McqQuestion;
use App\Models\UserActivity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SoalController extends Controller
{
    /**
     * Show the multiple-choice quiz without revealing the answers.
     */
    public function index(Request $request): View
    {
        $questions = McqQuestion::active()
            ->orderBy('sort_order')
            ->get()
            ->map(fn (McqQuestion $question) => [
                'id' => $question->id,
                'question' => $question->question,
                'options' => $question->options,
            ]);

        return view('soal', [
            'questions' => $questions,
            'latestAttempt' => $request->user()->mcqAttempts()->latest('created_at')->first(),
        ]);
    }

    /**
     * Score the submitted answers server-side and store the attempt.
     */
    public function submit(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'answers' => ['required', 'array', 'min:1'],
            'answers.*' => ['required', 'integer', 'min:0', 'max:3'],
        ]);

        $answers = $validated['answers'];

        $questions = McqQuestion::active()->whereIn('id', array_keys($answers))->get();

        if ($questions->count() !== count($answers)) {
            return response()->json([
                'message' => 'Jawaban tidak valid. Muat ulang halaman lalu coba lagi.',
            ], 422);
        }

        $results = [];
        $score = 0;

        foreach ($answers as $questionId => $chosenIndex) {
            $question = $questions->firstWhere('id', (int) $questionId);

            $isCorrect = (int) $chosenIndex === $question->correct_index;
            $score += $isCorrect ? 1 : 0;

            $results[] = [
                'question_id' => $question->id,
                'chosen_index' => (int) $chosenIndex,
                'correct_index' => $question->correct_index,
                'is_correct' => $isCorrect,
                'explanation' => $question->explanation,
            ];
        }

        $total = count($results);

        DB::transaction(function () use ($request, $answers, $score, $total) {
            McqAttempt::create([
                'user_id' => $request->user()->id,
                'score' => $score,
                'total' => $total,
                'answers' => $answers,
            ]);

            UserActivity::complete($request->user()->id, 'soal');
        });

        return response()->json([
            'score' => $score,
            'total' => $total,
            'results' => $results,
        ]);
    }
}
