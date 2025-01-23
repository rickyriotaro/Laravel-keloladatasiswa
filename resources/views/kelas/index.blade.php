<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelas') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Daftar Kelas</h1>
            <a href="{{ route('kelas.create') }}"
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Kelas
            </a>
        </div>

        <!-- Filter -->
        <form method="GET" action="{{ route('kelas.index') }}" class="mb-4 grid grid-cols-1 sm:grid-cols-3 gap-4">
            <!-- Filter Nama Kelas -->
            <div>
                <label for="nama_kelas" class="block text-sm font-medium text-gray-700">Nama Kelas</label>
                <input type="text" name="nama_kelas" id="nama_kelas" value="{{ request('nama_kelas') }}"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Tombol Terapkan -->
            <div class="flex items-end">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow w-full">
                    Terapkan
                </button>
            </div>
        </form>

        <!-- Tabel Kelas -->
        <div class="overflow-hidden border border-gray-200 rounded-lg shadow">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-6 py-3 font-medium text-gray-600 uppercase tracking-wider">Nama Kelas</th>
                        <th class="text-center px-6 py-3 font-medium text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($kelas as $k)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-gray-700">{{ $k->nama_kelas }}</td>
                            <td class="px-6 py-4 text-center flex justify-center items-center space-x-2">
                                <!-- Tombol Edit -->
                                <a href="{{ route('kelas.edit', $k->id) }}"
                                   class="bg-indigo-500 hover:bg-indigo-700 text-white font-medium px-4 py-2 rounded-lg shadow flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-4-4m0 0l4-4m-4 4h12" />
                                    </svg>
                                    Edit
                                </a>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('kelas.destroy', $k->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-lg shadow flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $kelas->links() }}
        </div>
    </div>
</x-app-layout>
