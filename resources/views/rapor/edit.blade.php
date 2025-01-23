<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Nilai') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Edit Nilai</h1>

        <form action="{{ route('rapor.updateNilai', $nilai->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <!-- Nilai 1 -->
            <div class="mb-4">
                <label for="nilai" class="block text-sm font-medium text-gray-700">Nilai Pengetahuan</label>
                <input type="number" name="nilai" id="nilai" value="{{ $nilai->nilai }}" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
            </div>

            <!-- Prediket 1 -->
            <div class="mb-4">
                <label for="prediket" class="block text-sm font-medium text-gray-700">Prediket Pengetahuan</label>
                <input type="text" name="prediket" id="prediket" value="{{ $nilai->prediket }}" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
            </div>

            <!-- Nilai 2 -->
            <div class="mb-4">
                <label for="nilai_2" class="block text-sm font-medium text-gray-700">Nilai Keterampilan</label>
                <input type="number" name="nilai_2" id="nilai_2" value="{{ $nilai->nilai_2 }}" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
            </div>

            <!-- Prediket 2 -->
            <div class="mb-4">
                <label for="prediket_2" class="block text-sm font-medium text-gray-700">Prediket Keterampilan</label>
                <input type="text" name="prediket_2" id="prediket_2" value="{{ $nilai->prediket_2 }}" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" required
                          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">{{ $nilai->deskripsi }}</textarea>
            </div>

            <!-- Semester -->
            <div class="mb-4">
                <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
                <select name="semester" id="semester" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
                    <option value="Semester Ganjil" {{ $nilai->semester == 'Semester Ganjil' ? 'selected' : '' }}>Semester Ganjil</option>
                    <option value="Semester Genap" {{ $nilai->semester == 'Semester Genap' ? 'selected' : '' }}>Semester Genap</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                Simpan
            </button>
        </form>
    </div>
</x-app-layout>
