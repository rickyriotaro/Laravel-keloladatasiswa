<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Siswa') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Edit Siswa</h1>

        <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <!-- Nama Siswa -->
            <div class="mb-4">
                <label for="nama_siswa" class="block text-sm font-medium text-gray-700">Nama Siswa</label>
                <input type="text" name="nama_siswa" id="nama_siswa" value="{{ $siswa->nama_siswa }}"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                       required>
            </div>

            <!-- NIS -->
            <div class="mb-4">
                <label for="nis" class="block text-sm font-medium text-gray-700">NIS</label>
                <input type="text" name="nis" id="nis" value="{{ $siswa->nis }}"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                       required>
            </div>

            <!-- Pilih Kelas -->
            <div class="mb-4">
                <label for="kelas_id" class="block text-sm font-medium text-gray-700">Pilih Kelas</label>
                <select name="kelas_id" id="kelas_id" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @foreach ($kelas as $k)
                        <option value="{{ $k->id }}" {{ $siswa->kelas_id == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kelas }}
                        </option>
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
