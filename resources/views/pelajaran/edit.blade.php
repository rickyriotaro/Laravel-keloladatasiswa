<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pelajaran') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Edit Pelajaran</h1>

        <form action="{{ route('pelajaran.update', $pelajaran->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <!-- Nama Pelajaran -->
            <div class="mb-4">
                <label for="nama_pelajaran" class="block text-sm font-medium text-gray-700">Nama Pelajaran</label>
                <input type="text" name="nama_pelajaran" id="nama_pelajaran" value="{{ $pelajaran->nama_pelajaran }}"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                       required>
            </div>

            <!-- Pilih Guru -->
            <div class="mb-4">
                <label for="guru_id" class="block text-sm font-medium text-gray-700">Pilih Guru</label>
                <select name="guru_id" id="guru_id"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                    @foreach ($guru as $g)
                        <option value="{{ $g->id }}" {{ $pelajaran->guru_id == $g->id ? 'selected' : '' }}>
                            {{ $g->nama_guru }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="kelas_id" class="block text-sm font-medium text-gray-700">Pilih Kelas</label>
                <select name="kelas_id" id="kelas_id"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                    @foreach ($kelas as $k)
                        <option value="{{ $k->id }}" {{ $pelajaran->kelas_id == $k->id ? 'selected' : '' }}>
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
