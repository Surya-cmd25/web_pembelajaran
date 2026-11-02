<?php

namespace App\Http\Controllers;

use App\Models\PuzzleLevel;
use App\Models\PuzzleProgress;
use App\Models\UserActivity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PuzzleController extends Controller
{
    /**
     * Show the puzzle board with the levels configured by the teacher.
     */
    public function index(Request $request): View
    {
        $levels = PuzzleLevel::active()->get()->map(fn (PuzzleLevel $level) => [
            'level' => $level->level,
            'title' => $level->title,
            'description' => $level->description,
            'image' => $level->imageUrl(),
            'rows' => $level->rows,
            'cols' => $level->cols,
            'time_limit' => $level->time_limit,
        ])->values();

        $progress = PuzzleProgress::where('user_id', $request->user()->id)
            ->get()
            ->keyBy('level');

        return view('puzzle', [
            'levels' => $levels,
            'progress' => $progress,
        ]);
    }

    /**
     * Persist the result of a level.
     */
    public function save(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'level' => ['required', 'integer', Rule::exists('puzzle_levels', 'level')->where('is_active', true)],
            'placed' => ['nullable', 'array', 'max:36'],
            'placed.*' => ['required', 'integer', 'min:0', 'max:35'],
            'is_completed' => ['required', 'boolean'],
            'seconds' => ['nullable', 'integer', 'min:0', 'max:7200'],
        ]);

        $level = PuzzleLevel::where('level', $validated['level'])->firstOrFail();
        $placed = array_values($validated['placed'] ?? []);
        $isCompleted = $validated['is_completed'] && count($placed) === $level->pieceCount();

        $progress = PuzzleProgress::firstOrNew([
            'user_id' => $request->user()->id,
            'level' => $level->level,
        ]);

        $progress->placed = $placed;
        $progress->is_completed = $progress->is_completed || $isCompleted;

        if ($isCompleted && isset($validated['seconds'])) {
            $progress->best_seconds = $progress->best_seconds === null
                ? $validated['seconds']
                : min($progress->best_seconds, $validated['seconds']);
        }

        $progress->save();

        if ($isCompleted) {
            UserActivity::complete($request->user()->id, 'puzzle');
        }

        return response()->json([
            'saved' => true,
            'is_completed' => $isCompleted,
            'best_seconds' => $progress->best_seconds,
        ]);
    }
}
