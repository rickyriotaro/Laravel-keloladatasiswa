<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Data Sikap</h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        @if (session('error'))
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
        @endif

        <form action="{{ route('sikap.update', $sikap->id) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="siswa_id" class="block text-gray-700 font-bold mb-2">Nama Siswa</label>
                <select id="siswa_id" name="siswa_id" class="block w-full border rounded py-2 px-3 text-gray-700" disabled>
                    <option value="{{ $sikap->siswa->id }}" selected>{{ $sikap->siswa->nama_siswa }}</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="spiritual_desc" class="block text-gray-700 font-bold mb-2">Deskripsi Spiritual</label>
                <textarea id="spiritual_desc" name="spiritual_desc" class="block w-full border rounded py-2 px-3 text-gray-700">{{ $sikap->spiritual_desc }}</textarea>
            </div>

            <div class="mb-4">
                <label for="social_desc" class="block text-gray-700 font-bold mb-2">Deskripsi Sosial</label>
                <textarea id="social_desc" name="social_desc" class="block w-full border rounded py-2 px-3 text-gray-700">{{ $sikap->social_desc }}</textarea>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Perbarui
                </button>
                <a href="{{ route('sikap.index') }}" class="text-gray-500 hover:underline">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
