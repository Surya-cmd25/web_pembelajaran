<x-admin-layout title="Review Setor Hafalan" active="hafalan">
    <div>
        <h2 class="text-2xl sm:text-[28px] font-extrabold text-gray-900 tracking-tight">Review Setor Hafalan</h2>
        <p class="text-xs sm:text-sm text-gray-500 mt-1">Dengarkan rekaman siswa, lalu berikan status dan umpan balik.</p>
    </div>

    @if (session('status'))
        <div class="rounded-2xl bg-emerald-50 text-emerald-700 border border-emerald-200/80 px-4 py-3 text-sm font-bold">
            {{ session('status') }}
        </div>
    @endif

    {{-- Filter --}}
    <form method="GET" action="{{ route('admin.hafalan.index') }}" class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs p-5">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-[1fr_1fr_auto] gap-4 items-end">
            <div>
                <label for="status" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">Status</label>
                <select name="status" id="status" class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua status</option>
                    @foreach ($statusOptions as $value => $label)
                        <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="kartu" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">Kartu Hafalan</label>
                <select name="kartu" id="kartu" class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua kartu</option>
                    @foreach ($cards as $card)
                        <option value="{{ $card->id }}" @selected((string) request('kartu') === (string) $card->id)>{{ $card->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm transition-colors shadow-md shadow-blue-500/20">
                    Filter
                </button>
                <a href="{{ route('admin.hafalan.index') }}" class="px-5 py-2.5 rounded-xl bg-white border border-gray-200 text-gray-600 hover:text-gray-900 hover:border-gray-300 font-bold text-sm transition-colors">
                    Reset
                </a>
            </div>
        </div>
    </form>

    {{-- Daftar rekaman --}}
    @if ($recordings->isEmpty())
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs p-10 text-center text-sm text-gray-500">
            Tidak ada rekaman hafalan yang cocok dengan filter.
        </div>
    @else
        <div class="space-y-5">
            @foreach ($recordings as $recording)
                @php
                    $badgeClass = match ($recording->status) {
                        'diterima' => 'bg-emerald-50 text-emerald-700',
                        'perlu_percobaan' => 'bg-rose-50 text-rose-700',
                        default => 'bg-amber-50 text-amber-700',
                    };
                    $minutes = intdiv((int) $recording->duration, 60);
                    $seconds = (int) $recording->duration % 60;
                @endphp
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs p-5">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-4 justify-between">
                        <div class="min-w-0">
                            <div class="flex items-center gap-2 flex-wrap">
                                <p class="font-bold text-gray-900">{{ $recording->user->name ?? 'Siswa' }}</p>
                                <span class="px-2 py-1 rounded-md text-[11px] font-extrabold uppercase tracking-wider {{ $badgeClass }}">
                                    {{ $recording->statusLabel() }}
                                </span>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $recording->user->email ?? '-' }} · {{ $recording->conceptCard->name ?? '—' }}
                            </p>
                        </div>
                        <div class="text-xs text-gray-500 sm:text-right shrink-0">
                            <p class="font-bold text-gray-700">Durasi {{ sprintf('%d:%02d', $minutes, $seconds) }}</p>
                            <p>Dikirim {{ $recording->created_at->locale('id')->translatedFormat('d M Y, H:i') }}</p>
                        </div>
                    </div>

                    <audio controls preload="none" src="{{ asset('storage/'.$recording->audio_path) }}" class="w-full mt-4"></audio>

                    @if ($recording->feedback)
                        <p class="mt-3 text-xs text-gray-600 bg-gray-50 border border-gray-100 rounded-xl px-4 py-2.5">
                            <span class="font-bold text-gray-700">Umpan balik sebelumnya:</span> {{ $recording->feedback }}
                        </p>
                    @endif

                    <form method="POST" action="{{ route('admin.hafalan.update', $recording) }}" class="mt-4 pt-4 border-t border-gray-100 grid grid-cols-1 lg:grid-cols-[240px_1fr_auto] gap-4 items-start">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label for="status-{{ $recording->id }}" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">Status Review</label>
                            <select
                                name="status"
                                id="status-{{ $recording->id }}"
                                required
                                class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            >
                                @foreach ($statusOptions as $value => $label)
                                    <option value="{{ $value }}" @selected($recording->status === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="feedback-{{ $recording->id }}" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">Umpan Balik</label>
                            <textarea
                                name="feedback"
                                id="feedback-{{ $recording->id }}"
                                rows="2"
                                maxlength="1000"
                                placeholder="Tulis catatan atau koreksi untuk siswa (opsional)"
                                class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            >{{ old('feedback.'.$recording->id, $recording->feedback) }}</textarea>
                        </div>

                        <div class="lg:pt-6">
                            <button type="submit" class="w-full lg:w-auto px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm transition-colors shadow-md shadow-blue-500/20">
                                Simpan Review
                            </button>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>

        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs px-5 py-4">
            {{ $recordings->links() }}
        </div>
    @endif
</x-admin-layout>
