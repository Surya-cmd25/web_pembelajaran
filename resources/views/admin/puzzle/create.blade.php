<x-admin-layout title="Tambah Level Puzzle" active="puzzle">
    <div>
        <h2 class="text-2xl font-extrabold text-[#0F172A] tracking-tight">Tambah Level Puzzle</h2>
        <p class="text-sm text-gray-500 font-medium mt-1">Unggah gambar, tentukan jumlah kotak, dan atur waktu pengerjaan.</p>
    </div>

    <form method="POST" action="{{ route('admin.puzzle.store') }}" enctype="multipart/form-data" class="mt-6">
        @csrf
        @include('admin.puzzle._form', ['submitLabel' => 'Simpan Level'])
    </form>
</x-admin-layout>
