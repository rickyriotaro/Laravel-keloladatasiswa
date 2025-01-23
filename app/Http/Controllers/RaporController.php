<?php

namespace App\Http\Controllers;

use App\Models\AttendanceRecord;
use Illuminate\Http\Request;

use App\Models\{Kelas, Pelajaran, Guru, Walikelas, Siswa, Nilai, Ekskul, EkskulScore};
use PDF;

class RaporController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->level === 'walikelas') {
            // Fetch the class assigned to the logged-in walikelas
            $kelas = Kelas::whereHas('walikelas', function ($query) {
                $query->where('user_id', auth()->id());
            })->get();

            foreach ($kelas as $k) {
                $k->siswa = Siswa::where('kelas_id', $k->id)
                    ->when($request->filled('search'), function ($query) use ($request) {
                        $query->where('nama_siswa', 'like', '%' . $request->search . '%')
                            ->orWhere('nis', 'like', '%' . $request->search . '%');
                    })
                    ->paginate(10, ['*'], 'page_' . $k->id); // Paginate the results
            }
        } else if (auth()->user()->level === 'kepsek') {
            // For Kepsek, fetch all classes with paginated students
            $kelas = Kelas::with(['siswa' => function ($query) use ($request) {
                $query->when($request->filled('search'), function ($query) use ($request) {
                    $query->where('nama_siswa', 'like', '%' . $request->search . '%')
                        ->orWhere('nis', 'like', '%' . $request->search . '%');
                })->paginate(10); // Paginate the results
            }])->get();
        } else {
            // Handle other levels if necessary
            $kelas = collect(); // Return an empty collection
        }
        $kelasTujuan = Kelas::all();
        return view('rapor.index',  compact('kelas', 'kelasTujuan'));
    }

    public function attendanceList($kelas_id)
    {
        $kelas = Kelas::with(['siswa.attendanceRecords'])->findOrFail($kelas_id);

        return view('rapor.attendance_list', compact('kelas'));
    }

    public function storeAttendance(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'semester' => 'required|string|in:Semester Ganjil,Semester Genap',
            'sakit' => 'required|integer|min:0',
            'alpha' => 'required|integer|min:0',
            'izin' => 'required|integer|min:0',
        ]);

        AttendanceRecord::updateOrCreate(
            ['siswa_id' => $validated['siswa_id'], 'semester' => $validated['semester']],
            ['sakit' => $validated['sakit'], 'alpha' => $validated['alpha'], 'izin' => $validated['izin']]
        );

        return redirect()->back()->with('success', 'Data kehadiran berhasil disimpan.');
    }
    public function editAttendance($siswa_id, $semester)
    {
        $attendance = AttendanceRecord::where('siswa_id', $siswa_id)
            ->where('semester', $semester)
            ->firstOrFail();

        $siswa = Siswa::findOrFail($siswa_id);

        return view('rapor.edit_attendance', compact('attendance', 'siswa', 'semester'));
    }

    public function createInputNilai($kelas_id, $pelajaran_id)
    {
        $kelas = Kelas::with('siswa')->findOrFail($kelas_id); // Ambil kelas dan siswa terkait
        $pelajaran = Pelajaran::findOrFail($pelajaran_id); // Ambil pelajaran terkait

        return view('rapor.create', compact('kelas', 'pelajaran'));
    }


    public function inputNilai(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'pelajaran_id' => 'required|exists:pelajaran,id',
            'nilai' => 'required|integer',
            'nilai_2' => 'required|integer',
            'prediket' => 'required|string',
            'prediket_2' => 'required|string',
            'deskripsi' => 'required|string',
            'semester' => 'required|string|in:Semester Ganjil,Semester Genap', // Validasi semester
        ]);

        Nilai::create($validated);

        return redirect()->route('rapor.index')->with('success', 'Nilai berhasil ditambahkan');
    }


    public function mapelIndex($kelas_id)
    {
        $kelas = Kelas::with('pelajaran')->findOrFail($kelas_id); // Fetch class and its subjects
        $pelajaran = $kelas->pelajaran; // Subjects associated with the class

        return view('rapor.mapel_index', compact('kelas', 'pelajaran')); // Pass data to the view
    }


    public function nilaiIndex(Request $request, $kelas_id, $pelajaran_id)
    {
        $kelas = Kelas::findOrFail($kelas_id);
        $pelajaran = Pelajaran::findOrFail($pelajaran_id);

        $query = Nilai::whereHas('siswa', function ($query) use ($kelas_id, $request) {
            $query->where('kelas_id', $kelas_id);

            // Filter berdasarkan nama siswa
            if ($request->filled('nama_siswa')) {
                $query->where('nama_siswa', 'like', '%' . $request->query('nama_siswa') . '%');
            }
        })
            ->where('pelajaran_id', $pelajaran_id)
            ->with('siswa');

        // Filter berdasarkan semester
        if ($request->filled('semester')) {
            $query->where('semester', $request->query('semester'));
        }

        // Urutkan berdasarkan nilai
        if ($request->filled('sort_nilai')) {
            $query->orderBy('nilai', $request->query('sort_nilai') === 'asc' ? 'asc' : 'desc');
        }

        // Pagination
        $nilai = $query->paginate(10);

        return view('rapor.nilai_index', compact('kelas', 'pelajaran', 'nilai'));
    }

    public function editNilai($id)
    {
        $nilai = Nilai::with('siswa', 'pelajaran')->findOrFail($id);
        return view('rapor.edit', compact('nilai'));
    }

    public function updateNilai(Request $request, $id)
    {
        $validated = $request->validate([
            'nilai' => 'required|integer',
            'nilai_2' => 'required|integer',
            'prediket' => 'required|string',
            'prediket_2' => 'required|string',
            'deskripsi' => 'required|string',
            'semester' => 'required|string|in:Semester Ganjil,Semester Genap',
        ]);

        $nilai = Nilai::findOrFail($id);
        $nilai->update($validated);

        return redirect()->route('rapor.nilaiIndex', [$nilai->siswa->kelas_id, $nilai->pelajaran_id])
            ->with('success', 'Nilai berhasil diperbarui');
    }
    public function deleteNilai($id)
    {
        $nilai = Nilai::findOrFail($id);
        $kelas_id = $nilai->siswa->kelas_id;
        $pelajaran_id = $nilai->pelajaran_id;

        $nilai->delete();

        return redirect()->route('rapor.nilaiIndex', [$kelas_id, $pelajaran_id])
            ->with('success', 'Nilai berhasil dihapus');
    }

    public function cetakRaporPerSiswa(Request $request, $kelas_id)
    {
        $validated = $request->validate([
            'semester' => 'required|string|in:Semester Ganjil,Semester Genap',
        ]);
        $user = auth()->user();

        // Check if the user is a "walikelas"
        if ($user->level !== 'walikelas') {
            abort(403, 'Anda tidak memiliki akses ke laporan ini.');
        }
        $kelas = Kelas::with(['kkm', 'walikelas.user'])->findOrFail($kelas_id);
        $semester = $validated['semester'];

        $siswaList = Siswa::where('kelas_id', $kelas_id)
            ->with([
                'nilai' => function ($query) use ($semester) {
                    $query->where('semester', $semester)->with('pelajaran');
                },
                'attendanceRecords' => function ($query) use ($semester) {
                    $query->where('semester', $semester);
                },
                'ekskulScores' => function ($query) use ($semester) {
                    $query->where('semester', $semester)->with('ekskul');
                },
            ])
            ->get();

        if ($siswaList->isEmpty()) {
            return response()->json(['error' => 'Tidak ada siswa di kelas ini.'], 404);
        }
        // Logika kenaikan kelas
        $statusKenaikan = null;
        if ($semester === 'Semester Genap') {
            $statusKenaikan = $siswa->status_kenaikan ?? 'Belum ditentukan';
        }
        $walikelas = $kelas->walikelas;
        if (!$walikelas || $walikelas->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses untuk mencetak rapor siswa ini.');
        }
        // Fetch settings (kepsek and academic year)
        $settings = \DB::table('settings')->first();
        $kepsekName = $settings->kepsek_name ?? 'Nama Kepala Sekolah';
        $kepsekNIP = $settings->kepsek_nip ?? 'NIP Kepala Sekolah';
        $academicYear = $settings->academic_year ?? 'Tahun Ajaran';
        $alamat = $settings->alamat ?? 'Alamat';
        $namaSekolah = $settings->nama_sekolah ?? 'Nama Sekolah';
        $telp = $settings->telp ?? '0999';
        $email = $settings->email ?? 'asa@sas.s';
        $pdfUrls = [];
        $waliKelasName = $walikelas->guru->nama_guru ?? 'Nama Wali Kelas';
        $waliKelasNIP = $walikelas->guru->nip ?? 'NIP Wali Kelas';
        foreach ($siswaList as $siswa) {
            $kkm = $kelas->kkm->kkm_value ?? null;

            $pdf = \PDF::loadView('rapor.per_siswa', compact(
                'siswa',
                'kelas',
                'semester',
                'kkm',
                'waliKelasName',
                'waliKelasNIP',
                'alamat',
                'namaSekolah',
                'kepsekName',
                'kepsekNIP',
                'academicYear',
                'telp',
                'email',
                'statusKenaikan'
            ));

            $fileName = "rapor_{$siswa->nama_siswa}_{$semester}.pdf";
            $filePath = public_path("storage/{$fileName}");

            $pdf->save($filePath);
            $pdfUrls[] = asset("storage/{$fileName}");
        }

        return response()->json([
            'message' => 'PDF berhasil dibuat untuk semua siswa.',
            'pdfUrls' => $pdfUrls,
        ]);
    }

    public function cetakRaporPerSiswaIndividu(Request $request, $siswa_id)
    {
        $validated = $request->validate([
            'semester' => 'required|string|in:Semester Ganjil,Semester Genap',
        ]);

        $semester = $validated['semester'];

        // Get the authenticated user
        $user = auth()->user();

        // Check if the user is a "walikelas"
        if ($user->level !== 'walikelas') {
            abort(403, 'Anda tidak memiliki akses ke laporan ini.');
        }

        // Verify that the student belongs to the class handled by the walikelas
        $siswa = Siswa::with([
            'kelas.kkm',
            'kelas.walikelas.user',
            'nilai' => function ($query) use ($semester) {
                $query->where('semester', $semester)->with('pelajaran');
            },
            'attendanceRecords' => function ($query) use ($semester) {
                $query->where('semester', $semester);
            },
            'ekskulScores' => function ($query) use ($semester) {
                $query->where('semester', $semester)->with('ekskul');
            },
            'sikap',
        ])->findOrFail($siswa_id);
        $kelas = $siswa->kelas;
        $walikelas = $kelas->walikelas;
        if (!$walikelas || $walikelas->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses untuk mencetak rapor siswa ini.');
        }

        $kkm = $kelas->kkm->kkm_value ?? null;
        $waliKelasName = $walikelas->guru->nama_guru ?? 'Nama Wali Kelas';
        $waliKelasNIP = $walikelas->guru->nip ?? 'NIP Wali Kelas';
        // Logika kenaikan kelas
        $statusKenaikan = null;
        if ($semester === 'Semester Genap') {
            $statusKenaikan = $siswa->status_kenaikan ?? 'Belum ditentukan';
        }

        // Fetch settings (kepsek and academic year)
        $settings = \DB::table('settings')->first();
        $kepsekName = $settings->kepsek_name ?? 'Nama Kepala Sekolah';
        $kepsekNIP = $settings->kepsek_nip ?? 'NIP Kepala Sekolah';
        $academicYear = $settings->academic_year ?? 'Tahun Ajaran';
        $alamat = $settings->alamat ?? 'Alamat';
        $namaSekolah = $settings->nama_sekolah ?? 'Sekolah';
        $telp = $settings->telp ?? '0999';
        $email = $settings->email ?? 'asa@sas.s';

        $pdf = \PDF::loadView('rapor.per_siswa', compact(
            'siswa',
            'kelas',
            'semester',
            'kkm',
            'waliKelasName',
            'waliKelasNIP',
            'alamat',
            'namaSekolah',
            'kepsekName',
            'kepsekNIP',
            'academicYear',
            'telp',
            'email',
            'statusKenaikan'
        ));

        return $pdf->download("rapor_{$siswa->nama_siswa}_{$semester}.pdf");
    }

    public function updatePromotion(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'status_kenaikan' => 'required|string|in:Naik,Tinggal',
            'next_kelas_id' => 'nullable|exists:kelas,id',
        ]);

        $siswa = Siswa::findOrFail($validated['siswa_id']);
        $siswa->status_kenaikan = $validated['status_kenaikan'];

        if ($validated['status_kenaikan'] === 'Naik') {
            $siswa->next_kelas_id = $validated['next_kelas_id'];
        } else {
            $siswa->next_kelas_id = null; // Jika tinggal kelas, kosongkan next_kelas_id
        }

        $siswa->save();

        return redirect()->back()->with('success', 'Keputusan kenaikan kelas berhasil disimpan.');
    }


    public function ekskulList($kelas_id)
    {
        $kelas = Kelas::with(['siswa.ekskulScores.ekskul'])
            ->whereHas('walikelas', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->findOrFail($kelas_id);

        $ekskulScores = EkskulScore::whereHas('siswa', function ($query) use ($kelas_id) {
            $query->where('kelas_id', $kelas_id);
        })->with(['siswa', 'ekskul'])->paginate(10);

        $ekskuls = Ekskul::all();

        return view('rapor.ekskul_list', compact('kelas', 'ekskuls', 'ekskulScores'));
    }

    public function createEkskulScore($kelas_id)
    {
        // Ensure the logged-in user is wali kelas of the given class
        $kelas = Kelas::whereHas('walikelas', function ($query) {
            $query->where('user_id', auth()->id());
        })->with('siswa')->findOrFail($kelas_id);

        $ekskuls = Ekskul::all();

        return view('rapor.create_ekskul_score', compact('kelas', 'ekskuls'));
    }


    public function storeEkskulScore(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'ekskul_id' => 'required|exists:ekskul,id',
            'score' => 'required|integer|min:0|max:100',
            'description' => 'nullable|string',
            'semester' => 'required|in:Semester Ganjil,Semester Genap',
        ]);

        // Retrieve the class ID associated with the student
        $siswa = Siswa::findOrFail($validated['siswa_id']);
        $kelas_id = $siswa->kelas_id;

        // Save the extracurricular score along with the semester
        EkskulScore::create([
            'siswa_id' => $validated['siswa_id'],
            'ekskul_id' => $validated['ekskul_id'],
            'score' => $validated['score'],
            'description' => $validated['description'],
            'semester' => $validated['semester'], // Include the semester
        ]);

        return redirect()->route('rapor.ekskulList', ['kelas_id' => $kelas_id])
            ->with('success', 'Nilai ekskul berhasil ditambahkan.');
    }

    public function editEkskulScore($id)
    {
        // Fetch the score and related student and extracurricular data
        $score = EkskulScore::with(['siswa.kelas', 'ekskul'])->findOrFail($id);

        // Fetch all extracurricular activities for the dropdown
        $ekskuls = Ekskul::all();

        // Extract the related student
        $siswa = $score->siswa;

        // Pass the score, extracurriculars, and student to the view
        return view('rapor.edit_ekskul_score', compact('score', 'ekskuls', 'siswa'));
    }

    public function updateEkskulScore(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'ekskul_id' => 'required|exists:ekskul,id',
            'score' => 'required|integer|min:0|max:100',
            'description' => 'nullable|string',
            'semester' => 'required|in:Semester Ganjil,Semester Genap', // Include semester validation
        ]);

        // Find the existing score record
        $score = EkskulScore::findOrFail($id);

        // Update the score record with the validated data
        $score->update([
            'ekskul_id' => $validated['ekskul_id'],
            'score' => $validated['score'],
            'description' => $validated['description'],
            'semester' => $validated['semester'], // Update the semester
        ]);

        return redirect()->route('rapor.ekskulList', ['kelas_id' => $score->siswa->kelas_id])
            ->with('success', 'Nilai ekskul berhasil diperbarui.');
    }

    public function deleteEkskulScore($id)
    {
        $score = EkskulScore::findOrFail($id);

        // Get the class ID associated with the student
        $kelas_id = $score->siswa->kelas_id;

        $score->delete();

        return redirect()->route('rapor.ekskulList', ['kelas_id' => $kelas_id])
            ->with('success', 'Nilai ekskul berhasil dihapus.');
    }
    public function allGradesByWaliKelas()
    {
        // Check the user's level
        if (auth()->user()->level === 'walikelas') {
            // Fetch classes associated with the walikelas
            $kelas = Kelas::whereHas('walikelas', function ($query) {
                $query->where('user_id', auth()->id());
            })->with([
                'siswa.nilai' => function ($query) {
                    $query->with('pelajaran'); // Load related subjects for grades
                },
            ])->get();
        } elseif (auth()->user()->level === 'kepsek') {
            // Fetch all classes for kepsek
            $kelas = Kelas::with([
                'siswa.nilai' => function ($query) {
                    $query->with('pelajaran'); // Load related subjects for grades
                },
            ])->get();
        } else {
            // Abort for unauthorized levels
            abort(403, 'Unauthorized access');
        }

        // Calculate averages
        $kelas->each(function ($k) {
            $k->subjects = $k->siswa->flatMap(function ($siswa) {
                return $siswa->nilai->pluck('pelajaran');
            })->unique('id');

            $k->subjects->each(function ($subject) use ($k) {
                $subject->average = $k->siswa
                    ->flatMap(fn($siswa) => $siswa->nilai->where('pelajaran_id', $subject->id))
                    ->avg('nilai');
            });

            $k->siswa->each(function ($siswa) {
                $siswa->average = $siswa->nilai->avg('nilai');
            });
        });

        return view('rapor.all_grades', compact('kelas'));
    }
    public function printAllGrades()
    {
        if (auth()->user()->level === 'walikelas') {
            $kelas = Kelas::whereHas('walikelas', function ($query) {
                $query->where('user_id', auth()->id());
            })->with([
                'siswa.nilai' => function ($query) {
                    $query->with('pelajaran');
                },
            ])->get();
        } elseif (auth()->user()->level === 'kepsek') {
            $kelas = Kelas::with([
                'siswa.nilai' => function ($query) {
                    $query->with('pelajaran');
                },
            ])->get();
        } else {
            abort(403, 'Unauthorized access');
        }

        $kelas->each(function ($k) {
            $k->subjects = $k->siswa->flatMap(function ($siswa) {
                return $siswa->nilai->pluck('pelajaran');
            })->unique('id');

            $k->subjects->each(function ($subject) use ($k) {
                $subject->average = $k->siswa
                    ->flatMap(fn($siswa) => $siswa->nilai->where('pelajaran_id', $subject->id))
                    ->avg('nilai');
            });

            $k->siswa->each(function ($siswa) {
                $siswa->average = $siswa->nilai->avg('nilai');
            });
        });

        return view('rapor.print_grades', compact('kelas'));
    }
}
