<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah/Edit User') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">{{ isset($user) ? 'Edit' : 'Tambah' }} User</h1>

        <form method="POST" action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}">
            @csrf
            @if(isset($user)) @method('PUT') @endif

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" id="name" value="{{ $user->name ?? '' }}" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ $user->email ?? '' }}" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
                @if(isset($user))
                    <p class="text-sm text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah password.</p>
                @endif
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="mb-4">
                <label for="level" class="block text-sm font-medium text-gray-700">Level</label>
                <select name="level" id="level" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
                    <option value="admin" {{ isset($user) && $user->level === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="kepsek" {{ isset($user) && $user->level === 'kepsek' ? 'selected' : '' }}>Kepsek</option>
                    <option value="walikelas" {{ isset($user) && $user->level === 'walikelas' ? 'selected' : '' }}>Walikelas</option>
                </select>
            </div>

            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Simpan
            </button>
        </form>
    </div>
</x-app-layout>
