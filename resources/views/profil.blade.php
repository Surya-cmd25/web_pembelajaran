<x-dashboard-layout title="Profil Saya">
    <div>
        <h2 class="text-2xl sm:text-[28px] font-extrabold text-gray-900 tracking-tight">Profil Saya</h2>
        <p class="text-xs sm:text-sm text-gray-500 mt-1">Perbarui data akun dan kata sandimu.</p>
    </div>

    @if (session('status'))
        <div class="rounded-2xl bg-emerald-50 text-emerald-700 border border-emerald-200/80 px-4 py-3 text-sm font-bold">
            {{ session('status') }}
        </div>
    @endif

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 items-start">
        <form method="POST" action="{{ route('profil.update') }}" class="bg-white rounded-3xl border border-gray-200/80 shadow-2xs p-6 space-y-5">
            @csrf
            @method('PATCH')
            <h3 class="text-base font-extrabold text-gray-900">Data Akun</h3>

            <div>
                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                    class="w-full rounded-xl border px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 {{ $errors->has('name') ? 'border-rose-400' : 'border-gray-200' }}">
                @error('name')<p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                    class="w-full rounded-xl border px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 {{ $errors->has('email') ? 'border-rose-400' : 'border-gray-200' }}">
                @error('email')<p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>@enderror
            </div>

            <button type="submit" class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold shadow-lg shadow-blue-500/25 transition-colors">
                Simpan Perubahan
            </button>
        </form>

        <form method="POST" action="{{ route('profil.password') }}" class="bg-white rounded-3xl border border-gray-200/80 shadow-2xs p-6 space-y-5">
            @csrf
            @method('PUT')
            <h3 class="text-base font-extrabold text-gray-900">Ganti Kata Sandi</h3>

            @foreach ([['current_password', 'Kata Sandi Saat Ini', 'current-password'], ['password', 'Kata Sandi Baru', 'new-password'], ['password_confirmation', 'Konfirmasi Kata Sandi Baru', 'new-password']] as [$field, $label, $autocomplete])
                <div>
                    <label for="{{ $field }}" class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-1.5">{{ $label }}</label>
                    <input type="password" name="{{ $field }}" id="{{ $field }}" autocomplete="{{ $autocomplete }}" required
                        class="w-full rounded-xl border px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 {{ $errors->has($field) ? 'border-rose-400' : 'border-gray-200' }}">
                    @error($field)<p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>@enderror
                </div>
            @endforeach

            <button type="submit" class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold shadow-lg shadow-blue-500/25 transition-colors">
                Ganti Kata Sandi
            </button>
        </form>
    </div>
</x-dashboard-layout>
