<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nilai') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">
            Nilai - {{ $pelajaran->nama_pelajaran }} - Kelas {{ $kelas->nama_kelas }}
        </h1>

        <!-- Tombol Kembali -->
        <a href="{{ route('rapor.mapelIndex', $kelas->id) }}"
           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mb-4 block w-fit">
            Kembali ke Halaman Mata Pelajaran
        </a>

        <!-- Tampilkan tombol hanya jika level pengguna adalah walikelas -->
        @if (Auth::user()->level === 'walikelas')
            <a href="{{ route('rapor.createInputNilai', [$kelas->id, $pelajaran->id]) }}"
               class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4 block w-fit">
                Tambah Nilai
            </a>
        @endif

        <!-- Filter -->
        <form method="GET" action="{{ route('rapor.nilaiIndex', [$kelas->id, $pelajaran->id]) }}"
              class="mb-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Filter Nama Siswa -->
            <div>
                <label for="nama_siswa" class="block text-sm font-medium text-gray-700">Nama Siswa</label>
                <input type="text" name="nama_siswa" id="nama_siswa" value="{{ request('nama_siswa') }}"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Filter Semester -->
            <div>
                <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
                <select name="semester" id="semester" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
                    <option value="">Semua Semester</option>
                    <option value="Semester Ganjil" {{ request('semester') == 'Semester Ganjil' ? 'selected' : '' }}>Semester Ganjil</option>
                    <option value="Semester Genap" {{ request('semester') == 'Semester Genap' ? 'selected' : '' }}>Semester Genap</option>
                </select>
            </div>

            <!-- Urutkan Berdasarkan Nilai -->
            <div>
                <label for="sort_nilai" class="block text-sm font-medium text-gray-700">Urutkan Nilai</label>
                <select name="sort_nilai" id="sort_nilai" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
                    <option value="">Default</option>
                    <option value="asc" {{ request('sort_nilai') == 'asc' ? 'selected' : '' }}>Nilai Terendah</option>
                    <option value="desc" {{ request('sort_nilai') == 'desc' ? 'selected' : '' }}>Nilai Tertinggi</option>
                </select>
            </div>

            <!-- Tombol Filter -->
            <div class="col-span-full">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Terapkan Filter
                </button>
            </div>
        </form>

        <!-- Tabel Nilai -->
        <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-6 text-left">Nama Siswa</th>
                    <th class="py-3 px-6 text-left">Nilai Pengetahuan</th>
                    <th class="py-3 px-6 text-left">prediket Pengetahuan</th>
                    <th class="py-3 px-6 text-left">Nilai Keterampilan</th>
                    <th class="py-3 px-6 text-left">Prediket Keterampilan</th>
                    <th class="py-3 px-6 text-left">Deskripsi</th>
                    <th class="py-3 px-6 text-left">Semester</th>
                    @if (Auth::user()->level === 'walikelas')
                        <th class="py-3 px-6 text-left">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($nilai as $n)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-6">{{ $n->siswa->nama_siswa }}</td>
                        <td class="py-3 px-6">{{ $n->nilai }}</td>
                        <td class="py-3 px-6">{{ $n->prediket }}</td>
                        <td class="py-3 px-6">{{ $n->nilai_2 }}</td>
                        <td class="py-3 px-6">{{ $n->prediket_2 }}</td>
                        <td class="py-3 px-6">{{ $n->deskripsi }}</td>
                        <td class="py-3 px-6">{{ $n->semester }}</td>
                        @if (Auth::user()->level === 'walikelas')
                            <td class="py-3 px-6 flex space-x-2">
                                <!-- Edit -->
                                <a href="{{ route('rapor.editNilai', $n->id) }}"
                                   class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                    Edit
                                </a>
                                <!-- Delete -->
                                <form method="POST" action="{{ route('rapor.deleteNilai', $n->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $nilai->appends(request()->query())->links() }}
        </div>
    </div>
</x-app-layout>
