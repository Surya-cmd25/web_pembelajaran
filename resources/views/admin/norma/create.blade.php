<x-admin-layout title="Tambah Norma" active="norma">
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Page Header -->
        <div>
            <a href="{{ route('admin.norma.index') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-gray-500 hover:text-blue-600 transition-colors mb-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali ke daftar norma
            </a>
            <h2 class="text-2xl font-extrabold text-[#0F172A] tracking-tight">Tambah Norma</h2>
            <p class="text-sm text-gray-500 font-medium mt-1">Tambahkan norma sosial baru ke dalam galeri.</p>
        </div>

        @include('admin.norma._form', [
            'action' => route('admin.norma.store'),
            'method' => 'POST',
            'norm' => null,
            'colors' => $colors,
            'nextSortOrder' => $nextSortOrder,
        ])
    </div>
</x-admin-layout>
