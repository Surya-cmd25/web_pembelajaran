<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MateriController extends Controller
{
    /**
     * List all materi with their read counts.
     */
    public function index(): View
    {
        $materis = Materi::withCount('reads')
            ->orderBy('sort_order')
            ->paginate(10)
            ->withQueryString();

        return view('admin.materi.index', [
            'materis' => $materis,
        ]);
    }

    /**
     * Show the form to create a new materi.
     */
    public function create(): View
    {
        return view('admin.materi.create');
    }

    /**
     * Persist a newly created materi.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:materis,slug'],
            'summary' => ['nullable', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'quote' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:1'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $validated['is_published'] = $request->boolean('is_published');

        Materi::create($validated);

        return redirect()->route('admin.materi.index')
            ->with('status', 'Materi berhasil ditambahkan.');
    }

    /**
     * Show the form to edit an existing materi.
     */
    public function edit(Materi $materi): View
    {
        return view('admin.materi.edit', [
            'materi' => $materi,
        ]);
    }

    /**
     * Update an existing materi.
     */
    public function update(Request $request, Materi $materi): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('materis', 'slug')->ignore($materi),
            ],
            'summary' => ['nullable', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'quote' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:1'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $validated['is_published'] = $request->boolean('is_published');

        $materi->update($validated);

        return redirect()->route('admin.materi.index')
            ->with('status', 'Materi berhasil diperbarui.');
    }

    /**
     * Upload or replace the audio explanation of a materi.
     */
    public function uploadAudio(Request $request, Materi $materi): RedirectResponse
    {
        $validated = $request->validate([
            'audio' => ['required', 'file', 'mimes:mp3,m4a,wav,ogg,webm', 'max:20480'],
            'audio_duration' => ['nullable', 'integer', 'min:0', 'max:3600'],
        ]);

        if ($materi->audio_path) {
            Storage::disk('public')->delete($materi->audio_path);
        }

        $materi->update([
            'audio_path' => $request->file('audio')->store('audio/materi', 'public'),
            'audio_duration' => $validated['audio_duration'] ?? $materi->audio_duration ?? 0,
        ]);

        return back()->with('status', 'Audio penjelasan berhasil diunggah.');
    }

    /**
     * Remove the audio explanation of a materi.
     */
    public function destroyAudio(Materi $materi): RedirectResponse
    {
        if ($materi->audio_path) {
            Storage::disk('public')->delete($materi->audio_path);
        }

        $materi->update([
            'audio_path' => null,
            'audio_duration' => null,
        ]);

        return back()->with('status', 'Audio penjelasan berhasil dihapus.');
    }

    /**
     * Delete a materi and its audio file.
     */
    public function destroy(Materi $materi): RedirectResponse
    {
        if ($materi->audio_path) {
            Storage::disk('public')->delete($materi->audio_path);
        }

        $materi->delete();

        return redirect()->route('admin.materi.index')
            ->with('status', 'Materi berhasil dihapus.');
    }
}
