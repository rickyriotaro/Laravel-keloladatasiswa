<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Kehadiran') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Edit Kehadiran - {{ $siswa->nama_siswa }} - {{ $semester }}</h1>

        <form method="POST" action="{{ url('rapor/attendance') }}">
            @csrf
            <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
            <input type="hidden" name="semester" value="{{ $semester }}">

            <label for="sakit" class="block text-sm font-medium text-gray-700">Jumlah Sakit</label>
            <input type="number" name="sakit" id="sakit" value="{{ $attendance->sakit }}"
                   class="mb-4 border border-gray-300 rounded-md w-full" required>

            <label for="alpha" class="block text-sm font-medium text-gray-700">Jumlah Alpha</label>
            <input type="number" name="alpha" id="alpha" value="{{ $attendance->alpha }}"
                   class="mb-4 border border-gray-300 rounded-md w-full" required>

            <label for="izin" class="block text-sm font-medium text-gray-700">Jumlah Izin</label>
            <input type="number" name="izin" id="izin" value="{{ $attendance->izin }}"
                   class="mb-4 border border-gray-300 rounded-md w-full" required>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Simpan Perubahan
            </button>
            <a href="{{ url()->previous() }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Batal
            </a>
        </form>
    </div>
</x-app-layout>
