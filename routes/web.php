<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('layouts.home');
    });


    // -----------------------------login----------------------------------------//
    Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
    // -----------------------------dashboard----------------------------------------//
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // Route::get('/dashboard', [App\Http\Controllers\Auth\HomeController::class, 'employeeDashboard'])->name('dashboard');
    // ----------------------------- user profile ------------------------------//
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/{id}/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/updateProfile', [App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('profile.updateProfile');
    Route::put('/profile/updatePersonal', [App\Http\Controllers\ProfileController::class, 'updatePersonal'])->name('profile.updatePersonal');
    Route::put('/profile/updateKantor', [App\Http\Controllers\ProfileController::class, 'updateKantor'])->name('profile.updateKantor');
    Route::put('/profile/updateFotoProfile/{id}', [App\Http\Controllers\ProfileController::class, 'updateFotoPegawai'])->name('profile.updateFotoProfile');
    // ----------------------------- user employee ------------------------------//
    Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee');
    Route::get('/employee/{id}/edit/', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('employee.edit');
    Route::delete('/employee/destroy', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('employee.destroy');
    Route::get('/employee/{id}/show', [App\Http\Controllers\EmployeeController::class, 'show'])->name('employee.show');
    Route::post('/employee/store', [App\Http\Controllers\EmployeeController::class, 'store'])->name('employee.store');
    Route::put('/employee/updatePegawai', [App\Http\Controllers\EmployeeController::class, 'updatePegawai'])->name('employee.updatePegawai');
    Route::put('/employee/updatePersonal', [App\Http\Controllers\EmployeeController::class, 'updatePersonal'])->name('employee.updatePersonal');
    Route::put('/employee/updateKantor', [App\Http\Controllers\EmployeeController::class, 'updateKantor'])->name('employee.updateKantor');
    Route::put('/employee/updateFotoPegawai/{id}', [App\Http\Controllers\EmployeeController::class, 'updateFotoPegawai'])->name('employee.updateFotoPegawai');
    // ----------------------------- departements ------------------------------//
    Route::get('/divisi', [App\Http\Controllers\DivisiController::class, 'index'])->name('divisi');
    Route::get('/divisi/{id}/edit', [App\Http\Controllers\DivisiController::class, 'edit'])->name('divisi.edit');
    Route::delete('/divisi/destroy', [App\Http\Controllers\DivisiController::class, 'destroy'])->name('divisi.destroy');
    Route::post('/divisi/store', [App\Http\Controllers\DivisiController::class, 'store'])->name('divisi.store');
    Route::put('/divisi/update', [App\Http\Controllers\DivisiController::class, 'update'])->name('divisi.update');
    // ----------------------------- positions ------------------------------//
    Route::get('/jabatan', [App\Http\Controllers\JabatanController::class, 'index'])->name('jabatan');
    Route::get('/jabatan/{id}/edit', [App\Http\Controllers\JabatanController::class, 'edit'])->name('jabatan.edit');
    Route::delete('/jabatan/destroy', [App\Http\Controllers\JabatanController::class, 'destroy'])->name('jabatan.destroy');
    Route::post('/jabatan/store', [App\Http\Controllers\JabatanController::class, 'store'])->name('jabatan.store');
    Route::put('/jabatan/update', [App\Http\Controllers\JabatanController::class, 'update'])->name('jabatan.update');
    // ----------------------------- pengajuan cuti ------------------------------//
    Route::get('/pengajuan-cuti-admin', [App\Http\Controllers\PengajuanCutiController::class, 'indexAdmin'])->name('pengajuan-cuti-admin');
    Route::get('/pengajuan-cuti-user', [App\Http\Controllers\PengajuanCutiController::class, 'indexUser'])->name('pengajuan-cuti-user');
    Route::get('/pengajuan-cuti/{pengajuan}/show', [App\Http\Controllers\PengajuanCutiController::class, 'show'])->name('pengajuan-cuti.show');
    Route::post('/pengajuan-cuti/store', [App\Http\Controllers\PengajuanCutiController::class, 'store'])->name('pengajuan-cuti.store');
    Route::get('/pengajuan-cuti/{id}/getPengajuan', [App\Http\Controllers\PengajuanCutiController::class, 'getPengajuan'])->name('pengajuan-cuti.getPengajuan');
    Route::put('/pengajuan-cuti/reject', [App\Http\Controllers\PengajuanCutiController::class, 'updateReject'])->name('pengajuan-cuti.reject');
    Route::post('/pengajuan-cuti/approve', [App\Http\Controllers\PengajuanCutiController::class, 'updateApprove'])->name('pengajuan-cuti.approve');
    Route::delete('/pengajuan-cuti/destroy', [App\Http\Controllers\PengajuanCutiController::class, 'destroy'])->name('pengajuan-cuti.destroy');
    Route::get('/pengajuan-cuti/{id}/download', [App\Http\Controllers\PengajuanCutiController::class, 'downloadFile'])->name('pengajuan-cuti.download');
    // ----------------------------- persetujuan cuti ------------------------------//
    Route::get('/persetujuan-cuti-admin', [App\Http\Controllers\PersetujuanCutiController::class, 'indexAdmin'])->name('persetujuan-cuti-admin');
    Route::get('/persetujuan-cuti-user', [App\Http\Controllers\PersetujuanCutiController::class, 'indexUser'])->name('persetujuan-cuti-user');
    Route::get('/persetujuan-cuti/{persetujuan}/show', [App\Http\Controllers\PersetujuanCutiController::class, 'show'])->name('persetujuan-cuti.show');
    // ----------------------------- perjalanan dinas ------------------------------//
    Route::get('/perjalanan-dinas', [App\Http\Controllers\PerjalananDinasController::class, 'index'])->name('perjalanan-dinas');
    Route::post('/perjalanan-dinas/store', [App\Http\Controllers\PerjalananDinasController::class, 'store'])->name('perjalanan-dinas.store');
    Route::get('/perjalanan-dinas/{penugasan}/show', [App\Http\Controllers\PerjalananDinasController::class, 'show'])->name('perjalanan-dinas.show');
    Route::delete('/perjalanan-dinas/destroy', [App\Http\Controllers\PerjalananDinasController::class, 'destroy'])->name('perjalanan-dinas.destroy');
    // -----------------------------RAB perjalanan dinas ------------------------------//
    Route::get('/perjalanan-dinas/{penugasan}/createRab', [App\Http\Controllers\PerjalananDinasController::class, 'createRab'])->name('perjalanan-dinas.createRab');
    Route::post('/perjalanan-dinas/storeRab', [App\Http\Controllers\PerjalananDinasController::class, 'storeRab'])->name('perjalanan-dinas.storeRab');
    // Route::put('/perjalanan-dinas/editRab', [App\Http\Controllers\PerjalananDinasController::class, 'editRab'])->name('perjalanan-dinas.editRab');
    Route::get('/perjalanan-dinas/{rab}/rab', [App\Http\Controllers\PerjalananDinasController::class, 'rabForm'])->name('perjalanan-dinas.rab');
    Route::delete('/perjalanan-dinas/destroyRab', [App\Http\Controllers\PerjalananDinasController::class, 'destroyRab'])->name('perjalanan-dinas.destroyRab');
    // ----------------------------- Realisasi RAB perjalanan dinas ------------------------------//
    Route::post('/perjalanan-dinas/realisasiRab', [App\Http\Controllers\PerjalananDinasController::class, 'realisasiRab'])->name('perjalanan-dinas.realisasiRab');
    Route::get('/perjalanan-dinas/{rab}/realisasiForm', [App\Http\Controllers\PerjalananDinasController::class, 'realisasiForm'])->name('perjalanan-dinas.realisasiForm');
    Route::get('/perjalanan-dinas/{rab}/laporanRealisasiForm', [App\Http\Controllers\PerjalananDinasController::class, 'laporanRealisasiForm'])->name('perjalanan-dinas.laporanRealisasiForm');
    // ----------------------------- Laporan perjalanan dinas ------------------------------//
    Route::get('/laporan-dinas', [App\Http\Controllers\PerjalananDinasController::class, 'indexLaporan'])->name('laporan-dinas');
    Route::put('/laporan-dinas/tandai-selesai', [App\Http\Controllers\PerjalananDinasController::class, 'tandaiSelesai'])->name('laporan-dinas.tandai-selesai');
    Route::get('/laporan-dinas/{rab}/kebenaran', [App\Http\Controllers\PerjalananDinasController::class, 'kebenaran'])->name('laporan-dinas.kebenaran');
    // ----------------------------- Nortifications ------------------------------//
    Route::get('/notifications/mark-notif/{id}', [App\Http\Controllers\NotificationsController::class, 'markNotif'])->name('notifications.mark-notif');
    Route::get('/notifications/mark-all', [App\Http\Controllers\NotificationsController::class, 'markAll'])->name('notifications.mark-all');
});

Auth::routes(['register' => false]);
