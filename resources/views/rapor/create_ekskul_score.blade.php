<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Nilai Ekskul') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Tambah Nilai Ekskul untuk Kelas {{ $kelas->nama_kelas }}</h1>

        <form method="POST" action="{{ route('rapor.storeEkskulScore') }}" class="space-y-4 bg-white shadow-md rounded-lg p-6">
            @csrf

            <!-- Siswa Dropdown -->
            <div>
                <label for="siswa_id" class="block text-sm font-medium text-gray-700">Siswa</label>
                <select id="siswa_id" name="siswa_id" required class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    <option value="">Pilih Siswa</option>
                    @foreach ($kelas->siswa as $siswa)
                        <option value="{{ $siswa->id }}">{{ $siswa->nama_siswa }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Ekskul Dropdown -->
            <div>
                <label for="ekskul_id" class="block text-sm font-medium text-gray-700">Ekskul</label>
                <select id="ekskul_id" name="ekskul_id" required class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    <option value="">Pilih Ekskul</option>
                    @foreach ($ekskuls as $ekskul)
                        <option value="{{ $ekskul->id }}">{{ $ekskul->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Semester Dropdown -->
            <div>
                <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
                <select id="semester" name="semester" required class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    <option value="Semester Ganjil">Semester Ganjil</option>
                    <option value="Semester Genap">Semester Genap</option>
                </select>
            </div>

            <!-- Score Input -->
            <div>
                <label for="score" class="block text-sm font-medium text-gray-700">Nilai</label>
                <input type="number" id="score" name="score" required class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Description Textarea -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Keterangan</label>
                <textarea id="description" name="description" class="w-full mt-1 border-gray-300 rounded-md shadow-sm"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
