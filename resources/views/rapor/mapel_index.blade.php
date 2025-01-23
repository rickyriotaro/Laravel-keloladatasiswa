<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mata Pelajaran') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <!-- Button to go back to Rapor Index -->
        <a href="{{ route('rapor.index') }}"
           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mb-4 block w-fit">
            Kembali ke Halaman Rapor
        </a>

        <!-- Button to go to Sikap -->


        <h1 class="text-3xl font-bold mb-6">Mata Pelajaran - Kelas {{ $kelas->nama_kelas }}</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($pelajaran as $p)
                <div class="bg-white shadow-md rounded-lg p-4">
                    <h3 class="text-lg font-semibold">{{ $p->nama_pelajaran }}</h3>
                    <a href="{{ route('rapor.nilaiIndex', [$kelas->id, $p->id]) }}"
                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4 block text-center">
                        Lihat Nilai
                    </a>
                </div>
            @endforeach
        </div>
        <br>

    </div>
</x-app-layout>
