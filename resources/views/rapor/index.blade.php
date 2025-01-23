<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rapor') }}
        </h2>
    </x-slot>

    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: '{{ session('success.title') }}',
                    text: '{{ session('success.text') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Rapor</h1>

        @foreach ($kelas as $k)
            <div class="bg-white shadow-md rounded-lg p-6 mb-8">
                <h3 class="text-xl font-semibold mb-4">Kelas {{ $k->nama_kelas }}</h3>
                <div class="grid gap-4 mb-6">
                    <a href="{{ route('rapor.mapelIndex', $k->id) }}"
                       class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Lihat Mata Pelajaran
                    </a>
                    <a href="{{ route('rapor.allGrades', $k->id) }}"
                       class="mt-2 bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                        Lihat Nilai
                    </a>
                    @if (Auth::user()->level === 'walikelas')
                    <div>
                        <label for="semester-{{ $k->id }}" class="block text-sm font-medium text-gray-700">Pilih Semester:</label>
                        <select id="semester-{{ $k->id }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
                            <option value="Semester Ganjil">Semester Ganjil</option>
                            <option value="Semester Genap">Semester Genap</option>
                        </select>
                        <button onclick="downloadAllPdfs({{ $k->id }}, document.getElementById('semester-{{ $k->id }}').value)"
                                class="mt-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Cetak Semua Rapor
                        </button>
                    </div>
                    @endif
                </div>


                <!-- Tabel Siswa -->
                <!-- Tabel Siswa -->
                <div class="flex justify-between items-center mb-4">
                    <form method="GET" action="{{ route('rapor.index') }}" class="flex space-x-2">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama atau NIS"
                               class="border border-gray-300 rounded-md px-4 py-2">
                        <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Cari</button>
                    </form>
                </div>

                <div>
                    <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Nama Siswa</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">NIS</th>
                                @if (Auth::user()->level === 'walikelas')
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($k->siswa as $s)
                                <tr>
                                    <td class="px-6 py-4">{{ $s->nama_siswa }}</td>
                                    <td class="px-6 py-4">{{ $s->nis }}</td>
                                    <td class="px-12 py-4">
                                        <!-- Cetak Rapor -->


                                        <!-- Button Container -->
                                        @if (Auth::user()->level === 'walikelas')
                                        <div class="flex space-x-2 mt-2">
                                            <form method="GET" action="{{ url('rapor/cetak/siswa/' . $s->id) }}" class="inline-block">
                                                <select name="semester" required class="border border-gray-300 rounded-md">
                                                    <option value="Semester Ganjil">Semester Ganjil</option>
                                                    <option value="Semester Genap">Semester Genap</option>
                                                </select>
                                                <button type="submit" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                                                    Cetak Rapor
                                                </button>
                                            </form>

                                            <!-- Isi Data Kehadiran -->
                                            <button onclick="openAttendanceModal({{ $s->id }})"
                                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                                Isi Kehadiran
                                            </button>

                                            <!-- Edit Kehadiran -->
                                            <a href="{{ route('rapor.attendanceList', $k->id) }}"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                Edit Kehadiran
                                            </a>

                                            <a href="{{ route('rapor.ekskulList', $k->id) }}"
                                                class="bg-pink-500 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded">
                                                Kelola Ekskul
                                            </a>
                                            <a href="{{ route('sikap.index', $k->id) }}"
                                            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                            Kelola Sikap
                                         </a>
                                         <button onclick="openPromotionModal({{ $s->id }})"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Atur Kenaikan Kelas
                                        </button>


                                        </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    @if ($k->siswa instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        {{ $k->siswa->links('pagination::tailwind') }}
                    @endif
                </div>


            </div>
        @endforeach
    </div>
    <div id="promotionModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
                <h3 class="text-lg font-bold mb-4">Keputusan Kenaikan Kelas</h3>
                <form id="promotionForm" method="POST" action="{{ route('rapor.updatePromotion') }}">
                    @csrf
                    <input type="hidden" name="siswa_id" id="promotion_siswa_id">
                    <label for="status_kenaikan" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status_kenaikan" id="status_kenaikan" required class="mb-4 border border-gray-300 rounded-md w-full">
                        <option value="Naik">Naik Kelas</option>
                        <option value="Tinggal">Tinggal Kelas</option>
                    </select>

                    <label for="next_kelas_id" class="block text-sm font-medium text-gray-700">Naik ke Kelas</label>
                    <select name="next_kelas_id" id="next_kelas_id" class="mb-4 border border-gray-300 rounded-md w-full">
                        @foreach ($kelasTujuan as $kelas)
                            <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                        @endforeach
                    </select>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Simpan
                    </button>
                    <button type="button" onclick="closePromotionModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Batal
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div id="attendanceModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
                <h3 class="text-lg font-bold mb-4">Isi Data Kehadiran</h3>
                <form id="attendanceForm" method="POST" action="{{ url('rapor/attendance') }}">
                    @csrf
                    <input type="hidden" name="siswa_id" id="siswa_id">
                    <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
                    <select name="semester" id="semester" required class="mb-4 border border-gray-300 rounded-md w-full">
                        <option value="Semester Ganjil">Semester Ganjil</option>
                        <option value="Semester Genap">Semester Genap</option>
                    </select>

                    <label for="sakit" class="block text-sm font-medium text-gray-700">Jumlah Sakit</label>
                    <input type="number" name="sakit" id="sakit" class="mb-4 border border-gray-300 rounded-md w-full">

                    <label for="alpha" class="block text-sm font-medium text-gray-700">Jumlah Alpha</label>
                    <input type="number" name="alpha" id="alpha" class="mb-4 border border-gray-300 rounded-md w-full">

                    <label for="izin" class="block text-sm font-medium text-gray-700">Jumlah Izin</label>
                    <input type="number" name="izin" id="izin" class="mb-4 border border-gray-300 rounded-md w-full">

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Simpan
                    </button>
                    <button type="button" onclick="closeAttendanceModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Batal
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openPromotionModal(siswaId) {
            document.getElementById('promotion_siswa_id').value = siswaId;
            document.getElementById('promotionModal').classList.remove('hidden');
        }

        function closePromotionModal() {
            document.getElementById('promotionModal').classList.add('hidden');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function openAttendanceModal(siswaId) {
            document.getElementById('siswa_id').value = siswaId;
            document.getElementById('attendanceModal').classList.remove('hidden');
        }

        function closeAttendanceModal() {
            document.getElementById('attendanceModal').classList.add('hidden');
        }
    </script>

    <script>
        async function downloadRapor(kelasId, semester) {
    try {
        Swal.fire({
            title: 'Mengunduh...',
            text: 'Harap tunggu, sedang mengunduh semua PDF.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        const response = await fetch(`/rapor/cetak/${kelasId}?semester=${semester}`);
        const data = await response.json();

        if (data.pdfUrls && data.pdfUrls.length > 0) {
            for (const url of data.pdfUrls) {
                const anchor = document.createElement('a');
                anchor.href = url;
                anchor.download = url.split('/').pop(); // Nama file
                document.body.appendChild(anchor);
                anchor.click();
                document.body.removeChild(anchor);
            }

            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Semua PDF berhasil diunduh.',
            });
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Tidak Ada File',
                text: 'Tidak ada file PDF untuk diunduh.',
            });
        }
    } catch (error) {
        console.error('Error downloading PDFs:', error);
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Terjadi kesalahan saat mengunduh PDF. Silakan coba lagi.',
        });
    }
}


        async function downloadStudentRapor(studentId) {
            try {
                Swal.fire({
                    title: 'Mengunduh...',
                    text: 'Harap tunggu, sedang mengunduh PDF.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                const response = await fetch(`/rapor/cetak/siswa/${studentId}`);
                const data = await response.json();

                if (data.pdfUrl) {
                    const anchor = document.createElement('a');
                    anchor.href = data.pdfUrl;
                    anchor.download = data.pdfUrl.split('/').pop();
                    document.body.appendChild(anchor);
                    anchor.click();
                    document.body.removeChild(anchor);

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'PDF berhasil diunduh.',
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tidak Ada File',
                        text: 'Tidak ada file PDF untuk diunduh.',
                    });
                }
            } catch (error) {
                console.error('Error downloading PDF:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat mengunduh PDF. Silakan coba lagi.',
                });
            }
        }
        async function downloadAllPdfs(kelasId, semester) {
    try {
        Swal.fire({
            title: 'Mengunduh...',
            text: 'Harap tunggu, sedang memproses file PDF.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Ambil daftar URL PDF dari backend
        const response = await fetch(`/rapor/cetak/${kelasId}?semester=${semester}`);
        const data = await response.json();

        if (data.error) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: data.error,
            });
            return;
        }

        if (data.pdfUrls && data.pdfUrls.length > 0) {
            for (const url of data.pdfUrls) {
                // Buat elemen unduhan untuk setiap file
                const anchor = document.createElement('a');
                anchor.href = url;
                anchor.download = url.split('/').pop(); // Nama file
                document.body.appendChild(anchor);
                anchor.click();
                document.body.removeChild(anchor);
            }

            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Semua file PDF telah berhasil diunduh.',
            });
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Tidak Ada File',
                text: 'Tidak ada file PDF untuk diunduh.',
            });
        }
    } catch (error) {
        console.error('Error downloading PDFs:', error);
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Terjadi kesalahan saat memproses file PDF.',
        });
    }
}

async function downloadStudentRapor(siswaId, semester) {
    try {
        const response = await fetch(`/rapor/cetak/siswa/${siswaId}?semester=${semester}`);
        const blob = await response.blob();
        const url = window.URL.createObjectURL(blob);
        const anchor = document.createElement('a');
        anchor.href = url;

        // Nama file sesuai dengan siswa dan semester
        anchor.download = `rapor_siswa_${siswaId}_${semester}.pdf`;
        anchor.click();

        window.URL.revokeObjectURL(url);
    } catch (error) {
        console.error(`Error downloading PDF for siswa ${siswaId}:`, error);
    }
}

    </script>
</x-app-layout>
