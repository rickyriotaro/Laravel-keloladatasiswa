<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapor Kelas {{ $kelas->nama_kelas }} - {{ $semester }}</title>
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
            font-size: 20px;
            margin: 0;
        }
        .kop-sekolah p {
            font-size: 14px;
            margin: 5px 0;
        }
        .rapor {
            margin-bottom: 20px;
        }
        .rapor h2 {
            margin: 0 0 10px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            text-align: center;
            padding: 8px;
        }
        th {
            background-color: #f0f0f0;
        }
        .footer {
            margin-top: 40px;
            text-align: right;
        }
    </style>
</head>
<body>
    <!-- Kop Sekolah -->
    <div class="kop-sekolah">
        <h1>SEKOLAH DASAR (SD)</h1>
        <p>Jl. Pendidikan No. 123, Kota Pendidikan</p>
        <p>Telp: (021) 12345678 | Email: info@sekolah.edu</p>
        <hr>
    </div>

    <!-- Rapor Per Siswa -->
    @foreach ($siswaList as $siswa)
        <div class="rapor">
            <h2>Rapor Siswa: {{ $siswa->nama_siswa }}</h2>
            <p><strong>Kelas:</strong> {{ $kelas->nama_kelas }}</p>
            <p><strong>Semester:</strong> {{ $semester }}</p>
            <p><strong>NIS:</strong> {{ $siswa->nis }}</p>

            <!-- Tabel Nilai -->
            <table>
                <thead>
                    <tr>
                        <th>Pelajaran</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswa->nilai as $nilai)
                        <tr>
                            <td>{{ $nilai->pelajaran->nama_pelajaran }}</td>
                            <td>{{ $nilai->nilai }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <hr>
    @endforeach

    <!-- Footer -->
    <div class="footer">
        <p><strong>Kepala Sekolah</strong></p>
        <br><br><br>
        <p><u>(Nama Kepala Sekolah)</u></p>
    </div>
</body>
</html>
