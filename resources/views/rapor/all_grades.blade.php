<x-app-layout>  
    <x-slot name="header">  
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">  
            {{ __('Nilai Pengetahuan dan Keterampilan Siswa') }}  
        </h2>  
    </x-slot>  
  
    <div class="container mx-auto px-4 py-8">  
        <a href="{{ route('rapor.index') }}"  
           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mb-4 block w-fit">  
            Kembali ke Halaman Rapor  
        </a>  
        <a href="{{ route('rapor.printAllGrades') }}" target="_blank"  
           class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4 block w-fit">  
            Print Nilai  
        </a>  
  
        <!-- Search Input -->  
        <div class="mb-4">  
            <input type="text" id="searchInput" placeholder="Cari Kelas..." class="border border-gray-300 rounded-md px-4 py-2 w-full" onkeyup="filterClasses()" />  
        </div>  
  
        <h1 class="text-3xl font-bold mb-6">Nilai Pengetahuan dan Keterampilan Siswa</h1>  
  
        @foreach ($kelas as $k)  
            <!-- Table for Pengetahuan -->  
            <div class="bg-white shadow-md rounded-lg p-6 mb-8 class-item" data-class-name="{{ $k->nama_kelas }}">  
                <h3 class="text-xl font-semibold mb-4">Kelas {{ $k->nama_kelas }} - Pengetahuan</h3>  
  
                <div class="overflow-x-auto">  
                    <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">  
                        <!-- Table Header -->  
                        <thead class="bg-gray-100">  
                            <tr>  
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Nama Siswa</th>  
                                @foreach ($k->subjects as $subject)  
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">  
                                        {{ $subject->nama_pelajaran }}  
                                    </th>  
                                @endforeach  
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Rata-rata</th>  
                            </tr>  
                        </thead>  
  
                        <!-- Table Body -->  
                        <tbody class="divide-y divide-gray-200">  
                            @foreach ($k->siswa as $siswa)  
                                <tr>  
                                    <td class="px-6 py-4">{{ $siswa->nama_siswa }}</td>  
                                    @foreach ($k->subjects as $subject)  
                                        <td class="px-6 py-4">  
                                            @php  
                                                $grade = $siswa->nilai->firstWhere('pelajaran_id', $subject->id);  
                                            @endphp  
                                            {{ $grade->nilai ?? '-' }}  
                                        </td>  
                                    @endforeach  
                                    <td class="px-6 py-4 font-bold text-blue-500">  
                                        {{ number_format($siswa->average, 2) }}  
                                    </td>  
                                </tr>  
                            @endforeach  
                        </tbody>  
  
                        <!-- Averages Row -->  
                        <tfoot class="bg-gray-50">  
                            <tr>  
                                <td class="px-6 py-4 font-bold text-gray-700">Rata-rata Per Pelajaran</td>  
                                @foreach ($k->subjects as $subject)  
                                    <td class="px-6 py-4 font-bold text-blue-500">  
                                        {{ number_format($subject->average, 2) }}  
                                    </td>  
                                @endforeach  
                                <td class="px-6 py-4"></td> <!-- Empty cell for averages row -->  
                            </tr>  
                        </tfoot>  
                    </table>  
                </div>  
            </div>  
  
            <!-- Table for Keterampilan -->  
            <div class="bg-white shadow-md rounded-lg p-6 mb-8 class-item" data-class-name="{{ $k->nama_kelas }}">  
                <h3 class="text-xl font-semibold mb-4">Kelas {{ $k->nama_kelas }} - Keterampilan</h3>  
  
                <div class="overflow-x-auto">  
                    <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">  
                        <!-- Table Header -->  
                        <thead class="bg-gray-100">  
                            <tr>  
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Nama Siswa</th>  
                                @foreach ($k->subjects as $subject)  
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">  
                                        {{ $subject->nama_pelajaran }}  
                                    </th>  
                                @endforeach  
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Rata-rata</th>  
                            </tr>  
                        </thead>  
  
                        <!-- Table Body -->  
                        <tbody class="divide-y divide-gray-200">  
                            @foreach ($k->siswa as $siswa)  
                                <tr>  
                                    <td class="px-6 py-4">{{ $siswa->nama_siswa }}</td>  
                                    @foreach ($k->subjects as $subject)  
                                        <td class="px-6 py-4">  
                                            @php  
                                                $grade = $siswa->nilai->firstWhere('pelajaran_id', $subject->id);  
                                            @endphp  
                                            {{ $grade->nilai_2 ?? '-' }}  
                                        </td>  
                                    @endforeach  
                                    <td class="px-6 py-4 font-bold text-blue-500">  
                                        {{ number_format($siswa->nilai->avg('nilai_2'), 2) ?? '-' }}  
                                    </td>  
                                </tr>  
                            @endforeach  
                        </tbody>  
  
                        <!-- Averages Row -->  
                        <tfoot class="bg-gray-50">  
                            <tr>  
                                <td class="px-6 py-4 font-bold text-gray-700">Rata-rata Per Pelajaran</td>  
                                @foreach ($k->subjects as $subject)  
                                    <td class="px-6 py-4 font-bold text-blue-500">  
                                        {{ number_format(  
                                            $k->siswa->flatMap(fn($siswa) => $siswa->nilai->where('pelajaran_id', $subject->id))->avg('nilai_2'),  
                                            2  
                                        ) }}  
                                    </td>  
                                @endforeach  
                                <td class="px-6 py-4"></td> <!-- Empty cell for averages row -->  
                            </tr>  
                        </tfoot>  
                    </table>  
                </div>  
            </div>  
        @endforeach  
    </div>  
  
    <script>  
        function filterClasses() {  
            const input = document.getElementById('searchInput');  
            const filter = input.value.toLowerCase();  
            const classItems = document.querySelectorAll('.class-item');  
  
            classItems.forEach(item => {  
                const className = item.getAttribute('data-class-name').toLowerCase();  
                if (className.includes(filter)) {  
                    item.style.display = ''; // Show item  
                } else {  
                    item.style.display = 'none'; // Hide item  
                }  
            });  
        }  
    </script>  
</x-app-layout>  
