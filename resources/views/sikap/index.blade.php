<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Sikap</h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{ route('rapor.index') }}"
        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mb-4 block w-fit">
         Kembali ke Halaman Rapor
     </a>
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Daftar Sikap</h1>
            <a href="{{ route('sikap.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Tambah Sikap
            </a>

        </div>

        <div class="overflow-x-auto shadow-md rounded-lg">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="text-left py-3 px-4 font-medium text-gray-600">Nama Siswa</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-600">Sikap Spiritual</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-600">Sikap Sosial</th>
                        <th class="text-center py-3 px-4 font-medium text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sikapList as $sikap)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $sikap->siswa->nama_siswa }}</td>
                            <td class="py-3 px-4">{{ $sikap->spiritual_desc }}</td>
                            <td class="py-3 px-4">{{ $sikap->social_desc }}</td>
                            <td class="py-3 px-4 text-center">
                                <div class="inline-flex">
                                    <a href="{{ route('sikap.edit', $sikap->id) }}"
                                       class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-1 px-3 rounded mr-2">
                                        Edit
                                    </a>
                                    <form action="{{ route('sikap.destroy', $sikap->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded"
                                                onclick="return confirm('Yakin ingin menghapus?')">
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

        <div class="mt-6">
            {{ $sikapList->links() }}
        </div>
    </div>
</x-app-layout>
