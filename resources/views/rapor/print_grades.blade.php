<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nilai Pengetahuan dan Keterampilan Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .kop-sekolah {
            text-align: center;
            margin-bottom: 20px;
        }
        .kop-sekolah h1 {
            font-size: 24px;
            margin: 0;
        }
        .kop-sekolah p {
            margin: 5px 0;
            font-size: 14px;
        }
        .kop-sekolah hr {
            margin: 20px 0;
            border: 1px solid #000;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 2px solid black; /* Pertegas border dengan warna hitam */
        }
        th, td {
            text-align: center;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .container {
            margin: auto;
        }
        h4 {
            margin-top: 20px;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container">
        <!-- Kop Sekolah -->
        <div class="kop-sekolah">
            <h1>SEKOLAH DASAR (SD)</h1>
            <p>Jl. Pendidikan No. 123, Kota Pendidikan</p>
            <p>Telp: (021) 12345678 | Email: info@sekolah.edu</p>
            <hr>
        </div>

        <!-- Tabel Nilai Pengetahuan -->
        <center><h3>Nilai Pengetahuan dan Keterampilan Siswa</h3></center>
        @foreach ($kelas as $k)
            <!-- Tabel Pengetahuan -->
            <h4>Kelas {{ $k->nama_kelas }} - Pengetahuan</h4>
            <table>
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        @foreach ($k->subjects as $subject)
                            <th>{{ $subject->nama_pelajaran }}</th>
                        @endforeach
                        <th>Rata-rata</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($k->siswa as $siswa)
                        <tr>
                            <td>{{ $siswa->nama_siswa }}</td>
                            @foreach ($k->subjects as $subject)
                                <td>
                                    @php
                                        $grade = $siswa->nilai->firstWhere('pelajaran_id', $subject->id);
                                    @endphp
                                    {{ $grade->nilai ?? '-' }}
                                </td>
                            @endforeach
                            <td>{{ number_format($siswa->average, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Rata-rata Per Pelajaran</th>
                        @foreach ($k->subjects as $subject)
                            <td>{{ number_format($subject->average, 2) }}</td>
                        @endforeach
                        <td></td>
                    </tr>
                </tfoot>
            </table>

            <!-- Tabel Keterampilan -->
            <h4>Kelas {{ $k->nama_kelas }} - Keterampilan</h4>
            <table>
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        @foreach ($k->subjects as $subject)
                            <th>{{ $subject->nama_pelajaran }}</th>
                        @endforeach
                        <th>Rata-rata</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($k->siswa as $siswa)
                        <tr>
                            <td>{{ $siswa->nama_siswa }}</td>
                            @foreach ($k->subjects as $subject)
                                <td>
                                    @php
                                        $grade = $siswa->nilai->firstWhere('pelajaran_id', $subject->id);
                                    @endphp
                                    {{ $grade->nilai_2 ?? '-' }}
                                </td>
                            @endforeach
                            <td>{{ number_format($siswa->nilai->avg('nilai_2'), 2) ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Rata-rata Per Pelajaran</th>
                        @foreach ($k->subjects as $subject)
                            <td>{{ number_format(
                                $k->siswa->flatMap(fn($siswa) => $siswa->nilai->where('pelajaran_id', $subject->id))->avg('nilai_2'),
                                2
                            ) }}</td>
                        @endforeach
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        @endforeach
    </div>
</body>
</html>
