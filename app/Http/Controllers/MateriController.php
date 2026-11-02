<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\UserActivity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MateriController extends Controller
{
    /**
     * List the published learning materials.
     */
    public function index(Request $request): View
    {
        $materiList = Materi::published()
            ->orderBy('sort_order')
            ->get();

        $readSlugs = $request->user()
            ->materiReads()
            ->with('materi:id,slug')
            ->get()
            ->pluck('materi.slug');

        return view('materi.index', [
            'materiList' => $materiList,
            'readSlugs' => $readSlugs,
        ]);
    }

    /**
     * Show a single learning material with its audio narration.
     */
    public function show(Request $request, string $slug): View
    {
        $materi = Materi::published()
            ->where('slug', $slug)
            ->firstOrFail();

        $siblings = Materi::published()->orderBy('sort_order')->get();

        return view('materi.show', [
            'materi' => $materi,
            'siblings' => $siblings,
            'currentIndex' => $siblings->search(fn (Materi $item) => $item->id === $materi->id),
            'isRead' => $request->user()->hasRead($materi),
        ]);
    }

    /**
     * Mark a material as read by the student.
     */
    public function markRead(Request $request, string $slug): RedirectResponse
    {
        $materi = Materi::published()->where('slug', $slug)->firstOrFail();

        $request->user()->materiReads()->firstOrCreate(['materi_id' => $materi->id]);

        $totalMateri = Materi::published()->count();
        $readCount = $request->user()->materiReads()->count();

        if ($readCount >= $totalMateri) {
            UserActivity::complete($request->user()->id, 'materi');
        }

        return redirect()->route('materi.show', $materi->slug)->with('status', 'Materi ditandai sudah dibaca.');
    }
}
