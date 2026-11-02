<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConceptCard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConceptCardController extends Controller
{
    /**
     * The icons available for a concept card.
     *
     * @var list<string>
     */
    private const array ICONS = ['star', 'document', 'users', 'home', 'heart', 'smile', 'scale', 'user-group'];

    /**
     * The colors available for a concept card.
     *
     * @var list<string>
     */
    private const array COLORS = ['amber', 'blue', 'cyan', 'orange', 'rose', 'emerald', 'yellow', 'indigo'];

    /**
     * List every concept card ordered by sort order.
     */
    public function index(): View
    {
        $cards = ConceptCard::orderBy('sort_order')->orderBy('name')->get();

        return view('admin.kartu-hafalan.index', compact('cards'));
    }

    /**
     * Show the form to create a new concept card.
     */
    public function create(): View
    {
        return view('admin.kartu-hafalan.create', [
            'icons' => self::ICONS,
            'colors' => self::COLORS,
            'nextSortOrder' => (int) ConceptCard::max('sort_order') + 1,
        ]);
    }

    /**
     * Persist a new concept card.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'front_text' => ['required', 'string', 'max:1000'],
            'back_text' => ['required', 'string', 'max:2000'],
            'icon' => ['required', 'in:'.implode(',', self::ICONS)],
            'color' => ['required', 'in:'.implode(',', self::COLORS)],
            'sort_order' => ['required', 'integer', 'min:1', 'max:100'],
        ]);

        ConceptCard::create($validated);

        return redirect()
            ->route('admin.kartu-hafalan.index')
            ->with('status', 'Kartu hafalan berhasil ditambahkan.');
    }

    /**
     * Show the form to edit an existing concept card.
     */
    public function edit(ConceptCard $kartu_hafalan): View
    {
        return view('admin.kartu-hafalan.edit', [
            'card' => $kartu_hafalan,
            'icons' => self::ICONS,
            'colors' => self::COLORS,
        ]);
    }

    /**
     * Update an existing concept card.
     */
    public function update(Request $request, ConceptCard $kartu_hafalan): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'front_text' => ['required', 'string', 'max:1000'],
            'back_text' => ['required', 'string', 'max:2000'],
            'icon' => ['required', 'in:'.implode(',', self::ICONS)],
            'color' => ['required', 'in:'.implode(',', self::COLORS)],
            'sort_order' => ['required', 'integer', 'min:1', 'max:100'],
        ]);

        $kartu_hafalan->update($validated);

        return redirect()
            ->route('admin.kartu-hafalan.index')
            ->with('status', 'Kartu hafalan berhasil diperbarui.');
    }

    /**
     * Delete a concept card (and detach its recordings).
     */
    public function destroy(ConceptCard $kartu_hafalan): RedirectResponse
    {
        $kartu_hafalan->recordings()->delete();
        $kartu_hafalan->delete();

        return redirect()
            ->route('admin.kartu-hafalan.index')
            ->with('status', 'Kartu hafalan berhasil dihapus.');
    }
}
