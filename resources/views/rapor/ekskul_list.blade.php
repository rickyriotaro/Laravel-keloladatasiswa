<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Nilai Ekskul') }}
        </h2>
    </x-slot>
    <div class="container mx-auto px-4 py-8">
        <a href="{{ route('rapor.index') }}"
        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mb-4 block w-fit">
         Kembali ke Halaman Rapor
     </a>
        <h1 class="text-3xl font-bold mb-6">Nilai Ekskul Kelas {{ $kelas->nama_kelas }}</h1>

        <a href="{{ route('rapor.createEkskulScore', ['kelas' => $kelas->id]) }}"
           class="bg-green-500 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded mb-4 inline-block">
            Tambah Nilai
        </a>

        @if ($ekskulScores->isEmpty())
            <p class="text-gray-500">Tidak ada data nilai ekskul untuk kelas ini.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto bg-white border border-gray-200 shadow-md rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Siswa</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Ekskul</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Nilai</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Keterangan</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ekskulScores as $score)
                            <tr class="border-b">
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $score->siswa->nama_siswa }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $score->ekskul->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $score->score }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $score->description }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('rapor.editEkskulScore', $score->id) }}"
                                           class="bg-blue-500 hover:bg-blue-700 text-white font-semibold px-3 py-1 rounded">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('rapor.deleteEkskulScore', $score->id) }}" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-red-500 hover:bg-red-700 text-white font-semibold px-3 py-1 rounded"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="mt-4">
                {{ $ekskulScores->links('pagination::tailwind') }}
            </div>
        @endif
    </div>
</x-app-layout>
