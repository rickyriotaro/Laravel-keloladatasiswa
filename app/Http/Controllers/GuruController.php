<?php
namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $query = Guru::query();

        // Filter berdasarkan nama guru
        if ($request->filled('nama_guru')) {
            $query->where('nama_guru', 'like', '%' . $request->nama_guru . '%');
        }

        // Filter berdasarkan email
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        // Pagination
        $guru = $query->paginate(10);

        return view('guru.index', compact('guru'));
    }


    public function create()
    {
        return view('guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_guru' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
            'email' => 'required|email|unique:guru,email',
        ]);
        Guru::create($request->all());
        return redirect()->route('guru.index')->with('success', 'Guru berhasil ditambahkan');
    }

    public function edit(Guru $guru)
    {
        return view('guru.edit', compact('guru'));
    }

    public function update(Request $request, Guru $guru)
    {
        $request->validate([
            'nama_guru' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
            'email' => 'required|email|unique:guru,email,' . $guru->id,
        ]);
        $guru->update($request->all());
        return redirect()->route('guru.index')->with('success', 'Guru berhasil diubah');
    }

    public function destroy(Guru $guru)
    {
        $guru->delete();
        return redirect()->route('guru.index')->with('success', 'Guru berhasil dihapus');
    }
}
