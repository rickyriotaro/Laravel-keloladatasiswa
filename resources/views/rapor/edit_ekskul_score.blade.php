<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Nilai Ekskul') }}
        </h2>
    </x-slot>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Edit Nilai Ekskul: {{ $siswa->nama_siswa }}</h1>

        <form method="POST" action="{{ route('rapor.updateEkskulScore', $score->id) }}" class="space-y-4 bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <!-- Ekskul Dropdown -->
            <div>
                <label for="ekskul_id" class="block text-sm font-medium text-gray-700">Ekskul</label>
                <select name="ekskul_id" id="ekskul_id" required class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    @foreach ($ekskuls as $ekskul)
                        <option value="{{ $ekskul->id }}" {{ $ekskul->id == $score->ekskul->id ? 'selected' : '' }}>
                            {{ $ekskul->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Semester Dropdown -->
            <div>
                <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
                <select id="semester" name="semester" required class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    <option value="Semester Ganjil" {{ $score->semester == 'Semester Ganjil' ? 'selected' : '' }}>Semester Ganjil</option>
                    <option value="Semester Genap" {{ $score->semester == 'Semester Genap' ? 'selected' : '' }}>Semester Genap</option>
                </select>
            </div>

            <!-- Score Input -->
            <div>
                <label for="score" class="block text-sm font-medium text-gray-700">Nilai</label>
                <input type="number" name="score" id="score" value="{{ $score->score }}" required
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Description Textarea -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Keterangan</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm">{{ $score->description }}</textarea>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
