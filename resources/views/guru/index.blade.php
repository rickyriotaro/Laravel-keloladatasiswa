<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Guru') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Daftar Guru</h1>
            <a href="{{ route('guru.create') }}"
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Guru
            </a>
        </div>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('guru.index') }}" class="mb-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Filter Nama Guru -->
            <div>
                <label for="nama_guru" class="block text-sm font-medium text-gray-700">Nama Guru</label>
                <input type="text" name="nama_guru" id="nama_guru" value="{{ request('nama_guru') }}"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Filter Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="text" name="email" id="email" value="{{ request('email') }}"
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

        <!-- Tabel Guru -->
        <div class="overflow-hidden border border-gray-200 rounded-lg shadow">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-6 py-3 font-medium text-gray-600 uppercase tracking-wider">Nama Guru</th>
                        <th class="text-left px-6 py-3 font-medium text-gray-600 uppercase tracking-wider">Email</th>
                        <th class="text-left px-6 py-3 font-medium text-gray-600 uppercase tracking-wider">NIP</th>
                        <th class="text-center px-6 py-3 font-medium text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($guru as $g)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-gray-700">{{ $g->nama_guru }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $g->email }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $g->nip }}</td>
                            <td class="px-6 py-4 text-center flex justify-center items-center space-x-2">
                                <!-- Tombol Edit -->
                                <a href="{{ route('guru.edit', $g->id) }}"
                                   class="bg-indigo-500 hover:bg-indigo-700 text-white font-medium px-4 py-2 rounded-lg shadow flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-4-4m0 0l4-4m-4 4h12" />
                                    </svg>
                                    Edit
                                </a>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('guru.destroy', $g->id) }}" method="POST" class="inline-block">
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
            {{ $guru->links() }}
        </div>
    </div>

</x-app-layout>
