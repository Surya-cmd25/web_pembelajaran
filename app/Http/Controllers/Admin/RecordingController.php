<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConceptCard;
use App\Models\Recording;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RecordingController extends Controller
{
    /**
     * List student memorisation recordings with filters.
     */
    public function index(Request $request): View
    {
        $statusOptions = [
            Recording::STATUS_MENUNGGU => 'Menunggu Review',
            Recording::STATUS_DITERIMA => 'Diterima',
            Recording::STATUS_PERLU_PERCOBAAN => 'Perlu Percobaan',
        ];

        $recordings = Recording::with(['user:id,name,email', 'conceptCard:id,name'])
            ->latest()
            ->when($request->filled('status'), fn ($q, $status) => $q->where('status', $status))
            ->when($request->filled('kartu'), fn ($q, $cardId) => $q->where('concept_card_id', $cardId))
            ->paginate(10)
            ->withQueryString();

        return view('admin.hafalan.index', [
            'recordings' => $recordings,
            'statusOptions' => $statusOptions,
            'cards' => ConceptCard::orderBy('sort_order')->get(),
        ]);
    }

    /**
     * Save the teacher review of a recording.
     */
    public function update(Request $request, Recording $recording): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:menunggu,diterima,perlu_percobaan'],
            'feedback' => ['nullable', 'string', 'max:1000'],
        ]);

        $recording->update([
            'status' => $validated['status'],
            'feedback' => $validated['feedback'] ?? null,
            'reviewed_at' => now(),
        ]);

        return back()->with('status', 'Review rekaman disimpan.');
    }
}
