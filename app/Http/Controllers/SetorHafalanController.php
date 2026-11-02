<?php

namespace App\Http\Controllers;

use App\Models\ConceptCard;
use App\Models\Recording;
use App\Models\User;
use App\Models\UserActivity;
use App\Notifications\RecordingSubmitted;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\View\View;

class SetorHafalanController extends Controller
{
    /**
     * Show the concept cards and the recording simulator.
     */
    public function index(Request $request): View
    {
        $cards = ConceptCard::orderBy('sort_order')->get();

        $myRecordings = $request->user()
            ->recordings()
            ->with('conceptCard:id,name')
            ->latest()
            ->get();

        return view('setor-hafalan', [
            'cards' => $cards,
            'myRecordings' => $myRecordings,
        ]);
    }

    /**
     * Store a student recording for the chosen concept card.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'concept_card_id' => ['required', 'integer', 'exists:concept_cards,id'],
            'audio' => ['required', 'file', 'mimes:webm,weba,ogg,mp4,m4a,wav,mp3', 'max:15360'],
            'duration' => ['nullable', 'integer', 'min:1', 'max:180'],
        ]);

        $path = $request->file('audio')->store('audio/hafalan', 'public');

        $recording = Recording::create([
            'user_id' => $request->user()->id,
            'concept_card_id' => $validated['concept_card_id'],
            'audio_path' => $path,
            'duration' => $validated['duration'] ?? 0,
            'status' => Recording::STATUS_MENUNGGU,
        ]);

        UserActivity::complete($request->user()->id, 'hafalan');

        $recording->load('user', 'conceptCard');
        Notification::send(User::where('role', 'guru')->get(), new RecordingSubmitted($recording));

        return response()->json([
            'message' => 'Rekaman berhasil dikirim. Guru akan segera meninjau penjelasanmu.',
            'recording' => [
                'id' => $recording->id,
                'concept' => $recording->conceptCard->name,
                'status' => $recording->statusLabel(),
            ],
        ]);
    }
}
