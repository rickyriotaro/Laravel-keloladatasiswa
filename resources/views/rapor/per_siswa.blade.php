<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapor Siswa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body { 
            font-family: Arial, sans-serif; 
            margin: 40px auto;
            max-width: 1200px;
            padding: 0 20px;
            line-height: 1.6;
        }

        /* Header Styles */
        .kop-sekolah { 
            text-align: center; 
            margin-bottom: 30px; 
        }

        .kop-sekolah h1 { 
            font-size: 24px; 
            margin: 0; 
            font-weight: bold;
        }

        .kop-sekolah p { 
            margin: 5px 0; 
            font-size: 14px; 
        }

        .kop-sekolah hr {
            margin: 15px 0;
            border: none;
            border-top: 2px solid #000;
        }

        /* Student Info Styles */
        .info-siswa {
            margin: 20px 0;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        .info-siswa p {
            margin: 5px 0;
            font-size: 14px;
        }

        /* Section Headers */
        h3 {
            color: #333;
            margin-top: 30px;
            padding-bottom: 5px;
            border-bottom: 2px solid #dee2e6;
            font-size: 18px;
            font-weight: bold;
        }

        /* Table Styles */
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin: 20px 0;
            font-size: 14px;
        }

        table, th, td { 
            border: 1px solid #dee2e6; 
        }

        th, td { 
            padding: 12px 8px; 
            text-align: center; 
        }

        th { 
            background-color: #f8f9fa;
            font-weight: bold;
            vertical-align: middle;
        }

        /* Decision Section Styles */
        .keputusan {
            margin: 20px 0;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        .keputusan p {
            margin: 10px 0;
        }

        /* Date Styles */
        .date { 
            text-align: right; 
            margin: 20px 0;
            font-style: italic; 
        }

        /* Signature Styles */
        .signatures {
            margin-top: 60px;
            width: 100%;
        }

        /* Table for top signatures (Wali Murid & Wali Kelas) */
        table.top-signatures {
            width: 100%;
            border: none;
            margin-bottom: 40px;
        }

        table.top-signatures td {
            width: 50%;
            border: none;
            text-align: center;
            padding: 10px;
            vertical-align: top;
        }

        /* Table for bottom signature (Kepala Sekolah) */
        table.bottom-signature {
            width: 100%;
            border: none;
            margin-top: 40px;
        }

        table.bottom-signature td {
            border: none;
            text-align: center;
            padding: 10px;
        }

        /* Signature spacing */
        .signature-space {
            height: 80px;
        }

        /* Signature lines and text */
        .signature-line {
            display: inline-block;
            min-width: 200px;
            border-bottom: 1px solid #000;
        }

        .signature-name {
            margin-top: 5px;
            font-weight: bold;
        }

        .signature-nip {
            font-size: 14px;
            margin-top: 5px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            body {
                padding: 0 10px;
            }

            table {
                font-size: 12px;
            }

            th, td {
                padding: 8px 4px;
            }
        }
    </style>
</head>
<body>
    <div class="kop-sekolah">
        <h1>{{ $namaSekolah }}</h1>
        <p>{{ $alamat }}</p>  
        <p>Telp: {{ $telp }} | Email: {{ $email }}</p>
        <p><strong>Tahun Ajaran:</strong> {{ $academicYear }}</p>
        <hr>
    </div>

    <div class="info-siswa">
        <p><strong>Kelas:</strong> {{ $kelas->nama_kelas }}</p>
        <p><strong>Nama Siswa:</strong> {{ $siswa->nama_siswa }}</p>
        <p><strong>NIS:</strong> {{ $siswa->nis }}</p>
        <p><strong>Semester:</strong> {{ $semester }}</p>
    </div>

    <h3>A. Penilaian Sikap</h3>
    <table>
        <thead>
            <tr>
                <th width="25%">Jenis Sikap</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Sikap Spiritual</td>
                <td>{{ $siswa->sikap->spiritual_desc ?? 'Belum ada deskripsi' }}</td>
            </tr>
            <tr>
                <td>Sikap Sosial</td>
                <td>{{ $siswa->sikap->social_desc ?? 'Belum ada deskripsi' }}</td>
            </tr>
        </tbody>
    </table>

    <h3>B. Daftar Nilai Akademik</h3>
    <table>
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Pelajaran</th>
                <th colspan="2">Pengetahuan</th>
                <th colspan="2">Keterampilan</th>
                <th rowspan="2">Deskripsi</th>
            </tr>
            <tr>
                <th>Nilai</th>
                <th>Predikat</th>
                <th>Nilai</th>
                <th>Predikat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($siswa->nilai as $index => $nilai)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $nilai->pelajaran->nama_pelajaran }}</td>
                    <td>{{ $nilai->nilai }}</td>
                    <td>{{ $nilai->prediket }}</td>
                    <td>{{ $nilai->nilai_2 }}</td>
                    <td>{{ $nilai->prediket_2 }}</td>
                    <td>{{ $nilai->deskripsi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if ($kkm)
        <h3>C. Kriteria Ketuntasan Minimal (KKM)</h3>
        <table>
            <thead>
                <tr>
                    <th width="25%">Kurang</th>
                    <th width="25%">Cukup</th>
                    <th width="25%">Baik</th>
                    <th width="25%">Sangat Baik</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>&lt; {{ $kkm }}</td>
                    <td>{{ $kkm }} - {{ min($kkm + 10, 100) }}</td>
                    <td>{{ min($kkm + 11, 100) }} - {{ min($kkm + 20, 100) }}</td>
                    <td>> {{ min($kkm + 21, 100) }}</td>
                </tr>
            </tbody>
        </table>
    @endif

    <h3>D. Nilai Ekstrakurikuler</h3>
    <table>
        <thead>
            <tr>
                <th width="30%">Ekskul</th>
                <th width="20%">Nilai</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($siswa->ekskulScores as $ekskulScore)
                <tr>
                    <td>{{ $ekskulScore->ekskul->name }}</td>
                    <td>{{ $ekskulScore->score }}</td>
                    <td>{{ $ekskulScore->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>E. Kehadiran</h3>
    <table>
        <thead>
            <tr>
                <th width="25%">Semester</th>
                <th width="25%">Sakit</th>
                <th width="25%">Alpha</th>
                <th width="25%">Izin</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($siswa->attendanceRecords as $attendance)
                <tr>
                    <td>{{ $attendance->semester }}</td>
                    <td>{{ $attendance->sakit }}</td>
                    <td>{{ $attendance->alpha }}</td>
                    <td>{{ $attendance->izin }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if ($semester === 'Semester 2')
    <div class="keputusan">
        <h3>F. Keputusan</h3>
        <p>Berdasarkan pencapaian kompetensi semester ganjil dan semester genap, peserta didik:</p>
        @if ($siswa->status_kenaikan === 'Naik')
            <p><strong>Status Kenaikan:</strong> Naik ke Kelas {{ $siswa->nextKelas->nama_kelas ?? 'Belum ditentukan' }}</p>
        @elseif ($siswa->status_kenaikan === 'Tinggal')
            <p><strong>Status Kenaikan:</strong> Tinggal di Kelas {{ $siswa->kelas->nama_kelas }}</p>
        @endif
    </div>
    @endif

    <div class="date">
        <p>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
    </div>

    <div class="signatures">
        <!-- Top signatures: Wali Murid & Wali Kelas -->
        <table class="top-signatures">
            <tr>
                <td><strong>Wali Murid</strong></td>
                <td><strong>Wali Kelas</strong></td>
            </tr>
            <tr>
                <td class="signature-space"></td>
                <td class="signature-space"></td>
            </tr>
            <tr>
                <td>
                    <div class="signature-line">&nbsp;</div>
                </td>
                <td>
                    <div class="signature-name"><u>{{ $waliKelasName }}</u></div>
                    <div class="signature-nip"><strong>NIP:</strong> {{ $waliKelasNIP }}</div>
                </td>
            </tr>
        </table>

        <!-- Bottom signature: Kepala Sekolah -->
        <table class="bottom-signature">
            <tr>
                <td><strong>Kepala Sekolah</strong></td>
            </tr>
            <tr>
                <td class="signature-space"></td>
            </tr>
            <tr>
                <td>
                    <div class="signature-name"><u>{{ $kepsekName }}</u></div>
                    <div class="signature-nip"><strong>NIP:</strong> {{ $kepsekNIP }}</div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>