<x-admin-layout title="Kelola Galeri Norma" active="norma">
    @php
        $colorChip = [
            'blue' => 'bg-blue-50 text-blue-700 border-blue-200',
            'rose' => 'bg-rose-50 text-rose-700 border-rose-200',
            'emerald' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            'amber' => 'bg-amber-50 text-amber-700 border-amber-200',
        ];
        $colorDot = [
            'blue' => 'bg-blue-500',
            'rose' => 'bg-rose-500',
            'emerald' => 'bg-emerald-500',
            'amber' => 'bg-amber-500',
        ];
    @endphp

    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-extrabold text-[#0F172A] tracking-tight">Galeri Norma</h2>
                <p class="text-sm text-gray-500 font-medium mt-1">Kelola empat norma sosial beserta contoh dan sanksinya.</p>
            </div>
            <a href="{{ route('admin.norma.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2.5 rounded-xl shadow-lg shadow-blue-500/20 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.4" d="M12 4v16m8-8H4"/></svg>
                Tambah Norma
            </a>
        </div>

        @if (session('status'))
            <div class="rounded-xl bg-emerald-50 border border-emerald-100 px-4 py-3 text-sm font-semibold text-emerald-700">{{ session('status') }}</div>
        @endif

        <!-- Norms Table -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50/80 border-b border-gray-200/80 text-left text-xs font-bold text-gray-500 uppercase tracking-wide">
                            <th class="px-5 py-3.5">Norma</th>
                            <th class="px-5 py-3.5">Deskripsi</th>
                            <th class="px-5 py-3.5 text-center">Contoh</th>
                            <th class="px-5 py-3.5 text-center">Sanksi</th>
                            <th class="px-5 py-3.5">Ilustrasi</th>
                            <th class="px-5 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($norms as $norm)
                            <tr class="hover:bg-gray-50/60 transition-colors">
                                <td class="px-5 py-4">
                                    <span class="inline-flex items-center gap-2 rounded-full border px-3 py-1 text-xs font-bold {{ $colorChip[$norm->color] ?? $colorChip['blue'] }}">
                                        {{ $norm->name }}
                                    </span>
                                    <p class="mt-1 text-xs text-gray-400 font-medium">{{ $norm->slug }}</p>
                                </td>
                                <td class="px-5 py-4 text-gray-600 max-w-[260px]"><p class="truncate" title="{{ $norm->description }}">{{ $norm->description }}</p></td>
                                <td class="px-5 py-4 text-center">
                                    <span class="inline-flex items-center justify-center min-w-8 h-8 px-2 rounded-lg bg-blue-50 text-blue-700 text-xs font-bold">{{ count($norm->examples ?? []) }}</span>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <span class="inline-flex items-center justify-center min-w-8 h-8 px-2 rounded-lg bg-rose-50 text-rose-700 text-xs font-bold">{{ count($norm->sanctions ?? []) }}</span>
                                </td>
                                <td class="px-5 py-4">
                                    @if ($norm->illustration_path)
                                        <img src="{{ asset('storage/'.$norm->illustration_path) }}" alt="{{ $norm->name }}" class="w-14 h-14 rounded-xl object-cover border border-gray-200">
                                    @else
                                        <span class="text-xs text-gray-400 font-medium">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.norma.edit', $norm) }}" class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-bold text-gray-700 hover:border-blue-300 hover:text-blue-600 transition-all">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('admin.norma.destroy', $norm) }}" onsubmit="return confirm('Hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-1.5 rounded-lg border border-rose-200 bg-white px-3 py-1.5 text-xs font-bold text-rose-600 hover:bg-rose-50 transition-all">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-12 text-center text-gray-400 font-medium">Belum ada norma. Klik "Tambah Norma" untuk membuat yang pertama.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
