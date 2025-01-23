<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Input Nilai') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">
            Input Nilai - {{ $pelajaran->nama_pelajaran }} ({{ $kelas->nama_kelas }})
        </h1>

        <form action="{{ route('rapor.inputNilai') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf

            <!-- Pilih Siswa -->
            <div class="mb-4">
                <label for="siswa_id" class="block text-sm font-medium text-gray-700">Pilih Siswa</label>
                <select name="siswa_id" id="siswa_id" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @foreach ($kelas->siswa as $siswa)
                        <option value="{{ $siswa->id }}">{{ $siswa->nama_siswa }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Pilih Semester -->
            <div class="mb-4">
                <label for="semester" class="block text-sm font-medium text-gray-700">Pilih Semester</label>
                <select name="semester" id="semester" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="Semester Ganjil">Semester Ganjil</option>
                        <option value="Semester Genap">Semester Genap</option>
                </select>
            </div>

            <!-- Nilai dan Prediket Pengetahuan -->
            <div class="mb-4 flex space-x-4">
                <div class="flex-1">
                    <label for="nilai" class="block text-sm font-medium text-gray-700">Nilai Pengetahuan</label>
                    <input type="number" name="nilai" id="nilai" required
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm"
                           oninput="calculatePrediket(this.value, 'prediket')">
                </div>
                <div class="flex-1">
                    <label for="prediket" class="block text-sm font-medium text-gray-700">Prediket Pengetahuan</label>
                    <input type="text" name="prediket" id="prediket" readonly
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50">
                </div>
            </div>

            <!-- Nilai dan Prediket Keterampilan -->
            <div class="mb-4 flex space-x-4">
                <div class="flex-1">
                    <label for="nilai_2" class="block text-sm font-medium text-gray-700">Nilai Keterampilan</label>
                    <input type="number" name="nilai_2" id="nilai_2" required
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm"
                           oninput="calculatePrediket(this.value, 'prediket_2')">
                </div>
                <div class="flex-1">
                    <label for="prediket_2" class="block text-sm font-medium text-gray-700">Prediket Keterampilan</label>
                    <input type="text" name="prediket_2" id="prediket_2" readonly
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50">
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4"
                          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm" required></textarea>
            </div>

            <input type="hidden" name="pelajaran_id" value="{{ $pelajaran->id }}">

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    <script>
        function calculatePrediket(nilai, targetId) {
            let prediket = '';
            nilai = parseFloat(nilai);

            if (nilai > 90) {
                prediket = 'Sangat Baik';
            } else if (nilai >= 81) {
                prediket = 'Baik';
            } else if (nilai >= 70) {
                prediket = 'Cukup';
            } else if (nilai < 70) {
                prediket = 'Kurang';
            }

            document.getElementById(targetId).value = prediket;
        }
    </script>
</x-app-layout>