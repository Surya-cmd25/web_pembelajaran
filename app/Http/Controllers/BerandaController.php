<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BerandaController extends Controller
{
    /**
     * Show the student dashboard with learning progress.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        $completedKeys = $user->activities()
            ->whereNotNull('completed_at')
            ->pluck('feature_key');

        $totalActivities = count(UserActivity::FEATURES);

        $statuses = collect(UserActivity::FEATURES)
            ->mapWithKeys(fn (string $feature) => [$feature => $completedKeys->contains($feature)]);

        $doneCount = $statuses->filter()->count();

        $nextFeature = collect(UserActivity::FEATURES)
            ->first(fn (string $feature) => ! $statuses->get($feature));

        return view('beranda', [
            'statuses' => $statuses,
            'doneCount' => $doneCount,
            'totalActivities' => $totalActivities,
            'percent' => (int) round(($doneCount / $totalActivities) * 100),
            'nextFeature' => $nextFeature,
            'materiCount' => Materi::published()->count(),
            'pendingRecordings' => $user->recordings()->where('status', 'menunggu')->count(),
            'latestScore' => $user->quizAttempts()->latest('created_at')->value('score'),
        ]);
    }
}
