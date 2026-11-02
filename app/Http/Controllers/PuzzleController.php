<?php

namespace App\Http\Controllers;

use App\Models\PuzzleProgress;
use App\Models\UserActivity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PuzzleController extends Controller
{
    /**
     * The Durkheim puzzle is available in three levels.
     *
     * @var list<int>
     */
    private const array LEVELS = [1, 2, 3];

    /**
     * Show the puzzle board with the saved progress of the student.
     */
    public function index(Request $request): View
    {
        $progress = PuzzleProgress::where('user_id', $request->user()->id)
            ->get()
            ->keyBy('level');

        return view('puzzle', [
            'progress' => $progress,
            'levels' => self::LEVELS,
        ]);
    }

    /**
     * Persist the placed pieces of the current level.
     */
    public function save(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'level' => ['required', 'integer', 'in:1,2,3'],
            'placed' => ['required', 'array', 'min:0', 'max:10'],
            'placed.*' => ['required', 'integer', 'min:0', 'max:9'],
            'is_completed' => ['required', 'boolean'],
        ]);

        $placed = array_values($validated['placed']);
        $isCompleted = $validated['is_completed'] && count($placed) === PuzzleProgress::PIECE_COUNT;

        PuzzleProgress::updateOrCreate(
            ['user_id' => $request->user()->id, 'level' => $validated['level']],
            [
                'placed' => $placed,
                'is_completed' => $isCompleted,
            ],
        );

        if ($isCompleted) {
            UserActivity::complete($request->user()->id, 'puzzle');
        }

        return response()->json([
            'saved' => true,
            'is_completed' => $isCompleted,
        ]);
    }
}
