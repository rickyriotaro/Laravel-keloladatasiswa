<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Wali Kelas') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Tambah Wali Kelas</h1>

        <form action="{{ route('walikelas.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf

            <!-- Pilih Guru -->
            <div class="mb-4">
                <label for="guru_id" class="block text-sm font-medium text-gray-700">Pilih Guru</label>
                <select name="guru_id" id="guru_id" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @foreach ($guru as $g)
                        <option value="{{ $g->id }}">{{ $g->nama_guru }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Pilih Kelas -->
            <div class="mb-4">
                <label for="kelas_id" class="block text-sm font-medium text-gray-700">Pilih Kelas</label>
                <select name="kelas_id" id="kelas_id" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @foreach ($kelas as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Pilih User -->
            <div class="mb-4">
                <label for="user_id" class="block text-sm font-medium text-gray-700">Pilih User</label>
                <select name="user_id" id="user_id" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
