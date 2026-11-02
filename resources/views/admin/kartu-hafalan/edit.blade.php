<x-admin-layout title="Edit Kartu Hafalan" active="kartu">
    <div class="max-w-3xl mx-auto space-y-6">
        <!-- Page Header -->
        <div>
            <a href="{{ route('admin.kartu-hafalan.index') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-gray-500 hover:text-blue-600 transition-colors mb-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali ke daftar kartu
            </a>
            <h2 class="text-2xl font-extrabold text-[#0F172A] tracking-tight">Edit Kartu Hafalan</h2>
            <p class="text-sm text-gray-500 font-medium mt-1">Perbarui data kartu <span class="font-bold text-gray-700">{{ $card->name }}</span>.</p>
        </div>

        @include('admin.kartu-hafalan._form', [
            'action' => route('admin.kartu-hafalan.update', $card),
            'method' => 'PUT',
            'card' => $card,
            'icons' => $icons,
            'colors' => $colors,
        ])
    </div>
</x-admin-layout>
