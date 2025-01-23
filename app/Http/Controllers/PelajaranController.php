<?php
    namespace App\Http\Controllers;

    use App\Models\Pelajaran;
    use Illuminate\Http\Request;
    use App\Models\Guru;
    use App\Models\Kelas;
    class PelajaranController extends Controller
    {
        public function index(Request $request)
        {
            // Query dasar
            $query = Pelajaran::with(['guru', 'kelas']); // Relasi

            // Filter berdasarkan nama pelajaran
            if ($request->filled('nama_pelajaran')) {
                $query->where('nama_pelajaran', 'like', '%' . $request->nama_pelajaran . '%');
            }

            // Filter berdasarkan guru
            if ($request->filled('guru_id')) {
                $query->where('guru_id', $request->guru_id);
            }
            if ($request->filled('kelas_id')) {
                $query->where('kelas_id', $request->kelas_id);
            }
            // Pagination
            $pelajaran = $query->paginate(10);

            $guru = Guru::all(); // Untuk dropdown filter guru
            $kelas = Kelas::all(); // Untuk dropdown filter guru

            return view('pelajaran.index', compact('pelajaran', 'guru','kelas'));
        }

        public function create()
        {
            $guru = Guru::all(); // Fetch all Guru records
            $kelas = Kelas::all();
            return view('pelajaran.create', compact('guru','kelas'));
        }

        public function store(Request $request)
        {
            $request->validate([
                'nama_pelajaran' => 'required|string|max:255',
                'guru_id' => 'required|exists:guru,id', // Validate Guru selection
                'kelas_id' => 'required|exists:kelas,id', // Validate Guru selection
            ]);

            Pelajaran::create($request->all());
            return redirect()->route('pelajaran.index')->with('success', 'Pelajaran berhasil ditambahkan');
        }

        public function edit(Pelajaran $pelajaran)
        {
            $kelas = Kelas::all();
            $guru = Guru::all();
            return view('pelajaran.edit', compact('pelajaran', 'guru','kelas'));
        }

        public function update(Request $request, Pelajaran $pelajaran)
        {
            $request->validate([
                'nama_pelajaran' => 'required|string|max:255',
                'guru_id' => 'required|exists:guru,id',
                'kelas_id' => 'required|exists:kelas,id',
            ]);

            $pelajaran->update($request->all());
            return redirect()->route('pelajaran.index')->with('success', 'Pelajaran berhasil diubah');
        }

        public function destroy(Pelajaran $pelajaran)
        {
            $pelajaran->delete();
            return redirect()->route('pelajaran.index')->with('success', 'Pelajaran berhasil dihapus');
        }
    }
