<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Middleware\CheckUserLevel;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SikapController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    KelasController,
    PelajaranController,
    GuruController,
    EkskulController,
    UserController,
    KkmController,
    WalikelasController,
    SiswaController,
    RaporController
};
Route::get('/', function () {
    return redirect('/login');
});
Route::get('/dashboard', [AuthenticatedSessionController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    // Rute khusus admin
    Route::middleware([CheckUserLevel::class . ':admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('guru', GuruController::class);
        Route::resource('siswa', SiswaController::class);
        Route::resource('ekskul', EkskulController::class);
        Route::resource('walikelas', WalikelasController::class)->parameters([
            'walikelas' => 'walikelas', // Pastikan parameter menggunakan nama yang benar
        ]);
        Route::resource('kelas', KelasController::class)->parameters([
            'kelas' => 'kelas', // Pastikan parameter menggunakan nama yang benar
        ]);
        Route::resource('kkm', KkmController::class)->middleware('auth');

        Route::resource('pelajaran', PelajaranController::class);
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    });


    // Rute khusus kepsek dan walikelas untuk melihat nilai
    Route::middleware([CheckUserLevel::class . ':kepsek,walikelas'])->group(function () {
        Route::get('/rapor/{kelas}/mapel/{pelajaran}/nilai', [RaporController::class, 'nilaiIndex'])->name('rapor.nilaiIndex');
    });

    // Rute khusus walikelas untuk operasi CRUD pada nilai

        Route::get('/rapor/cetak/siswa/{siswa}', [RaporController::class, 'cetakRaporPerSiswaIndividu'])->name('rapor.cetakRaporPerSiswaIndividu');
        Route::post('/rapor/attendance', [RaporController::class, 'storeAttendance'])->name('rapor.storeAttendance');
        Route::get('/rapor/attendance/edit/{siswa_id}/{semester}', [RaporController::class, 'editAttendance'])
        ->name('attendance.edit');
        Route::get('/rapor/attendance/{kelas_id}', [RaporController::class, 'attendanceList'])->name('rapor.attendanceList');
        Route::get('/rapor/ekskul/{kelas}/create', [RaporController::class, 'createEkskulScore'])->name('rapor.createEkskulScore');
        Route::get('/rapor/ekskul/{id}/edit', [RaporController::class, 'editEkskulScore'])->name('rapor.editEkskulScore');
        Route::put('/rapor/ekskul/{id}', [RaporController::class, 'updateEkskulScore'])->name('rapor.updateEkskulScore');
        Route::post('/rapor/ekskul/store', [RaporController::class, 'storeEkskulScore'])->name('rapor.storeEkskulScore');
        Route::delete('/rapor/ekskul/{id}', [RaporController::class, 'deleteEkskulScore'])->name('rapor.deleteEkskulScore');
        Route::get('/rapor/ekskul/{kelas_id}', [RaporController::class, 'ekskulList'])->name('rapor.ekskulList');
        Route::resource('sikap', SikapController::class);

        Route::get('/rapor', [RaporController::class, 'index'])->name('rapor.index');
        Route::get('/rapor/{kelas}/mapel', [RaporController::class, 'mapelIndex'])->name('rapor.mapelIndex');
        Route::get('/rapor/nilai/{id}/edit', [RaporController::class, 'editNilai'])->name('rapor.editNilai');
        Route::put('/rapor/nilai/{id}', [RaporController::class, 'updateNilai'])->name('rapor.updateNilai');
        Route::delete('/rapor/nilai/{id}', [RaporController::class, 'deleteNilai'])->name('rapor.deleteNilai');
        Route::get('/rapor/{kelas}/mapel/{pelajaran}/input', [RaporController::class, 'createInputNilai'])->name('rapor.createInputNilai');
        Route::post('/rapor/input', [RaporController::class, 'inputNilai'])->name('rapor.inputNilai');
        Route::get('/rapor/cetak/{kelas}', [RaporController::class, 'cetakRaporPerSiswa'])->name('rapor.cetakRaporPerSiswa');
        Route::get('/rapor/all-grades', [RaporController::class, 'allGradesByWaliKelas'])
        ->name('rapor.allGrades')
        ->middleware('auth');
        Route::get('/rapor/print-all-grades', [RaporController::class, 'printAllGrades'])->name('rapor.printAllGrades');
        Route::post('/rapor/promotion', [RaporController::class, 'updatePromotion'])->name('rapor.updatePromotion');

    // Rute umum untuk semua pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
