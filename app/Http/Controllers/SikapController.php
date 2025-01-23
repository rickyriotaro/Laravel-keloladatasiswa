<?php

namespace App\Http\Controllers;
use App\Models\Kelas;

use App\Models\Siswa;
use App\Models\Sikap;
use Illuminate\Http\Request;

class SikapController extends Controller
{
    public function index()
    {
        $sikapList = Sikap::with('siswa')->paginate(10);
        return view('sikap.index', compact('sikapList'));
    }

    public function create()
    {
        // Fetch the class assigned to the logged-in wali kelas
        $kelas = Kelas::whereHas('walikelas', function ($query) {
            $query->where('user_id', auth()->id());
        })->first();

        if (!$kelas) {
            return redirect()->route('sikap.index')->with('error', 'Anda tidak memiliki akses ke kelas ini.');
        }

        // Fetch students of the class
        $students = Siswa::where('kelas_id', $kelas->id)->get();

        return view('sikap.create', compact('students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'spiritual_desc' => 'nullable|string',
            'social_desc' => 'nullable|string',
        ]);

        // Validate that the selected student belongs to the logged-in wali kelas's class
        $kelas = Kelas::whereHas('walikelas', function ($query) {
            $query->where('user_id', auth()->id());
        })->first();

        if (!$kelas || !Siswa::where('id', $validated['siswa_id'])->where('kelas_id', $kelas->id)->exists()) {
            return redirect()->route('sikap.create')->with('error', 'Siswa tidak ditemukan atau tidak berada di kelas Anda.');
        }

        Sikap::create($validated);

        return redirect()->route('sikap.index')->with('success', 'Data sikap berhasil disimpan.');
    }

    public function edit($id)
    {
        $sikap = Sikap::with('siswa')->findOrFail($id);

        // Restrict access to the students of the logged-in wali kelas's class
        $kelas = Kelas::whereHas('walikelas', function ($query) {
            $query->where('user_id', auth()->id());
        })->first();

        if (!$kelas || $sikap->siswa->kelas_id != $kelas->id) {
            return redirect()->route('sikap.index')->with('error', 'Anda tidak memiliki akses ke data ini.');
        }

        $students = Siswa::where('kelas_id', $kelas->id)->get();

        return view('sikap.edit', compact('sikap', 'students'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'spiritual_desc' => 'nullable|string',
            'social_desc' => 'nullable|string',
        ]);

        $sikap = Sikap::findOrFail($id);
        $sikap->update($validated);

        return redirect()->route('sikap.index')->with('success', 'Data sikap berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $sikap = Sikap::findOrFail($id);
        $sikap->delete();

        return redirect()->route('sikap.index')->with('success', 'Data sikap berhasil dihapus.');
    }
}
