<x-admin-layout title="Edit Level Puzzle" active="puzzle">
    <div>
        <h2 class="text-2xl font-extrabold text-[#0F172A] tracking-tight">Edit Level {{ $level->level }}</h2>
        <p class="text-sm text-gray-500 font-medium mt-1">Perbarui gambar, jumlah kotak, atau waktu pengerjaan.</p>
    </div>

    <form method="POST" action="{{ route('admin.puzzle.update', $level) }}" enctype="multipart/form-data" class="mt-6">
        @csrf
        @method('PUT')
        @include('admin.puzzle._form', ['level' => $level, 'submitLabel' => 'Perbarui Level'])
    </form>
</x-admin-layout>
