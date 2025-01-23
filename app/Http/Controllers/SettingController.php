<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first(); // Fetch the first (and only) settings record
        return view('settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'kepsek_name' => 'required|string|max:255',
            'kepsek_nip' => 'required|string|max:255',
            'academic_year' => 'required|string|max:255',
            'telp' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'nama_sekolah' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);

        $setting = Setting::first();
        if (!$setting) {
            $setting = new Setting();
        }

        $setting->updateOrCreate([], $validated);

        return redirect()->route('settings.index')->with('success', 'Settings updated successfully.');
    }
}
