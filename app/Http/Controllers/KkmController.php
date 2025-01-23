<?php

namespace App\Http\Controllers;

use App\Models\{Kkm, Kelas};
use Illuminate\Http\Request;

class KkmController extends Controller
{
    public function index()
    {
        $kkms = Kkm::with('kelas')->get();
        return view('kkm.index', compact('kkms'));
    }

    public function create()
    {
        $classes = Kelas::all(); // Fetch all classes
        return view('kkm.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'kkm_value' => 'required|integer|min:0|max:100',
        ]);

        $kkm = Kkm::create($validated);

        return redirect()->route('kkm.index')->with('success', 'KKM berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kkm = Kkm::findOrFail($id);
        $classes = Kelas::all();

        return view('kkm.edit', compact('kkm', 'classes'));
    }

    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'kelas_id' => 'required|exists:kelas,id',
        'kkm_value' => 'required|integer|min:0|max:100',
    ]);

    $kkm = Kkm::findOrFail($id);
    $kkm->update($validated);

    return redirect()->route('kkm.index')->with('success', 'KKM berhasil diperbarui.');
}
public function interpretGrade($kkmValue, $score)
{
    // Define grade ranges dynamically with an upper limit of 100
    $cukupMax = min($kkmValue + 10, 100);
    $baikMax = min($kkmValue + 20, 100);

    if ($score < $kkmValue) {
        return 'Kurang';
    } elseif ($score >= $kkmValue && $score <= $cukupMax) {
        return 'Cukup';
    } elseif ($score > $cukupMax && $score <= $baikMax) {
        return 'Baik';
    } elseif ($score > $baikMax && $score <= 100) {
        return 'Sangat Baik';
    }

    // Fallback for invalid values
    return 'Invalid';
}

    public function destroy($id)
    {
        $kkm = Kkm::findOrFail($id);
        $kkm->delete();

        return redirect()->route('kkm.index')->with('success', 'KKM berhasil dihapus.');
    }
}
