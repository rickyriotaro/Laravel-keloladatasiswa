<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Data Sikap</h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('sikap.store') }}" method="POST" class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
            @csrf

            <div class="mb-4">
                <label for="siswa_id" class="block text-gray-700 text-sm font-bold mb-2">Pilih Siswa</label>
                <select id="siswa_id" name="siswa_id" class="block w-full bg-white border border-gray-300 rounded-lg py-2 px-3 text-gray-700 focus:outline-none focus:ring focus:ring-blue-500" required>
                    <option value="">Pilih Siswa</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->nama_siswa }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="spiritual_desc" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Spiritual</label>
                <textarea id="spiritual_desc" name="spiritual_desc" rows="4" class="block w-full bg-white border border-gray-300 rounded-lg py-2 px-3 text-gray-700 focus:outline-none focus:ring focus:ring-blue-500"></textarea>
            </div>

            <div class="mb-4">
                <label for="social_desc" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Sosial</label>
                <textarea id="social_desc" name="social_desc" rows="4" class="block w-full bg-white border border-gray-300 rounded-lg py-2 px-3 text-gray-700 focus:outline-none focus:ring focus:ring-blue-500"></textarea>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Simpan
                </button>
                <a href="{{ route('sikap.index') }}" class="text-gray-500 hover:underline">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
