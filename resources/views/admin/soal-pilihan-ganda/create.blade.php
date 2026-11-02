<x-admin-layout title="Tambah Soal Pilihan Ganda" active="soal">
    <div class="max-w-3xl mx-auto space-y-6">
        <!-- Page Header -->
        <div>
            <a href="{{ route('admin.soal-pilihan-ganda.index') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-gray-500 hover:text-blue-600 transition-colors mb-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali ke daftar soal
            </a>
            <h2 class="text-2xl font-extrabold text-[#0F172A] tracking-tight">Tambah Soal Pilihan Ganda</h2>
            <p class="text-sm text-gray-500 font-medium mt-1">Buat soal baru dengan empat pilihan jawaban.</p>
        </div>

        @include('admin.soal-pilihan-ganda._form', [
            'action' => route('admin.soal-pilihan-ganda.store'),
            'method' => 'POST',
            'question' => null,
            'nextSortOrder' => $nextSortOrder,
        ])
    </div>
</x-admin-layout>
