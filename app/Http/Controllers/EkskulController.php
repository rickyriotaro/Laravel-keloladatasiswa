<?php
namespace App\Http\Controllers;

use App\Models\Ekskul;
use Illuminate\Http\Request;

class EkskulController extends Controller
{
    public function index(Request $request)
    {
        // Query dasar
        $query = Ekskul::query();

        // Filter berdasarkan nama
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Pagination
        $ekskul = $query->paginate(10);

        return view('ekskul.index', compact('ekskul'));
    }

    public function create()
    {
        return view('ekskul.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Ekskul::create($request->all());
        return redirect()->route('ekskul.index')->with('success', 'Ekskul berhasil ditambahkan');
    }

    public function edit(Ekskul $ekskul)
    {
        return view('ekskul.edit', compact('ekskul'));
    }

    public function update(Request $request, Ekskul $ekskul)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $ekskul->update($request->all());
        return redirect()->route('ekskul.index')->with('success', 'Ekskul berhasil diubah');
    }

    public function destroy(Ekskul $ekskul)
    {
        $ekskul->delete();
        return redirect()->route('ekskul.index')->with('success', 'Ekskul berhasil dihapus');
    }
}
