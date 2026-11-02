<x-admin-layout title="Tambah Materi" active="materi">
    <div>
        <h2 class="text-2xl sm:text-[28px] font-extrabold text-gray-900 tracking-tight">Tambah Materi</h2>
        <p class="text-xs sm:text-sm text-gray-500 mt-1">Buat materi pembelajaran baru untuk siswa.</p>
    </div>

    <form method="POST" action="{{ route('admin.materi.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.materi.form', ['submitLabel' => 'Simpan Materi'])
    </form>
</x-admin-layout>
