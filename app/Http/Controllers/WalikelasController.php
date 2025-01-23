<?php

namespace App\Http\Controllers;

use App\Models\Walikelas;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;

class WalikelasController extends Controller
{
    public function index(Request $request)
{
    $query = Walikelas::with(['guru', 'kelas', 'user']); // Relasi

    // Filter berdasarkan nama guru
    if ($request->filled('guru')) {
        $query->whereHas('guru', function ($q) use ($request) {
            $q->where('nama_guru', 'like', '%' . $request->guru . '%');
        });
    }

    // Filter berdasarkan kelas
    if ($request->filled('kelas')) {
        $query->whereHas('kelas', function ($q) use ($request) {
            $q->where('nama_kelas', 'like', '%' . $request->kelas . '%');
        });
    }

    // Pagination
    $walikelas = $query->paginate(10);

    return view('walikelas.index', compact('walikelas'));
}


    public function create()
    {
        $guru = Guru::all();
        $kelas = Kelas::all();
        $users = User::where('level', 'walikelas')->get(); // Hanya ambil user dengan level walikelas

        return view('walikelas.create', compact('guru', 'kelas', 'users')); // Pastikan $users diteruskan
    }

    public function store(Request $request)
    {
        $request->validate([
            'guru_id' => 'required|exists:guru,id',
            'kelas_id' => 'required|exists:kelas,id',
            'user_id' => 'required|exists:users,id', // Validasi user_id
        ]);

        Walikelas::create($request->all());

        return redirect()->route('walikelas.index')->with('success', 'Wali Kelas berhasil ditambahkan');
    }

    public function edit(Walikelas $walikelas)
    {
        $guru = Guru::all();
        $kelas = Kelas::all();
        $users = User::where('level', 'walikelas')->get(); // Hanya ambil user dengan level walikelas

        return view('walikelas.edit', compact('walikelas', 'guru', 'kelas', 'users')); // Pastikan $users diteruskan
    }

    public function update(Request $request, Walikelas $walikelas)
    {
        $request->validate([
            'guru_id' => 'required|exists:guru,id',
            'kelas_id' => 'required|exists:kelas,id',
            'user_id' => 'required|exists:users,id', // Validasi user_id
        ]);

        $walikelas->update($request->all());

        return redirect()->route('walikelas.index')->with('success', 'Wali Kelas berhasil diubah');
    }

    public function destroy(Walikelas $walikelas)
    {
        $walikelas->delete();

        return redirect()->route('walikelas.index')->with('success', 'Wali Kelas berhasil dihapus');
    }
}
