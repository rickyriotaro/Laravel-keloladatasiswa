<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Kehadiran') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <a href="{{ route('rapor.index') }}"
        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mb-4 block w-fit">
         Kembali ke Halaman Rapor Index
     </a>
        <h1 class="text-3xl font-bold mb-6">Kehadiran - Kelas {{ $kelas->nama_kelas }}</h1>
        <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Nama Siswa</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Semester</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Sakit</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Alpha</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Izin</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($kelas->siswa as $siswa)
                    @foreach ($siswa->attendanceRecords as $attendance)
                        <tr>
                            <td class="px-6 py-4">{{ $siswa->nama_siswa }}</td>
                            <td class="px-6 py-4">{{ $attendance->semester }}</td>
                            <td class="px-6 py-4">{{ $attendance->sakit }}</td>
                            <td class="px-6 py-4">{{ $attendance->alpha }}</td>
                            <td class="px-6 py-4">{{ $attendance->izin }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('attendance.edit', ['siswa_id' => $siswa->id, 'semester' => $attendance->semester]) }}"
                                   class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
<br>

</div>
</x-app-layout>
