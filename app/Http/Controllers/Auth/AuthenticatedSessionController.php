<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Pelajaran;
use App\Models\Walikelas;
class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function dashboard()
{
    $jumlahKelas = Kelas::count();
    $jumlahSiswa = Siswa::count();
    $jumlahGuru = Guru::count();
    $jumlahPelajaran = Pelajaran::count();
    $jumlahWaliKelas = Walikelas::count();

    return view('dashboard', compact(
        'jumlahKelas',
        'jumlahSiswa',
        'jumlahGuru',
        'jumlahPelajaran',
        'jumlahWaliKelas'
    ));
}
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
