<x-admin-layout title="Edit Materi" active="materi">
    <div>
        <h2 class="text-2xl sm:text-[28px] font-extrabold text-gray-900 tracking-tight">Edit Materi</h2>
        <p class="text-xs sm:text-sm text-gray-500 mt-1">Perbarui isi materi: <span class="font-bold text-gray-700">{{ $materi->title }}</span></p>
    </div>

    <form method="POST" action="{{ route('admin.materi.update', $materi) }}">
        @csrf
        @method('PUT')
        @include('admin.materi.form', ['submitLabel' => 'Perbarui Materi'])
    </form>
</x-admin-layout>
