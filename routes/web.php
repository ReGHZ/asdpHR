<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmployeeController;

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
    Route::delete('/employee/{id}/destroy', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('employee.destroy');
    Route::get('/employee/{id}/show', [App\Http\Controllers\EmployeeController::class, 'show'])->name('employee.show');
    Route::post('/employee/store', [App\Http\Controllers\EmployeeController::class, 'store'])->name('employee.store');
    Route::put('/employee/updatePegawai', [App\Http\Controllers\EmployeeController::class, 'updatePegawai'])->name('employee.updatePegawai');
    Route::put('/employee/updatePersonal', [App\Http\Controllers\EmployeeController::class, 'updatePersonal'])->name('employee.updatePersonal');
    Route::put('/employee/updateKantor', [App\Http\Controllers\EmployeeController::class, 'updateKantor'])->name('employee.updateKantor');
    Route::put('/employee/updateFotoPegawai/{id}', [App\Http\Controllers\EmployeeController::class, 'updateFotoPegawai'])->name('employee.updateFotoPegawai');
    // ----------------------------- departements ------------------------------//
    Route::get('/divisi', [App\Http\Controllers\DivisiController::class, 'index'])->name('divisi');
    Route::get('/divisi/{id}/edit', [App\Http\Controllers\DivisiController::class, 'edit'])->name('divisi.edit');
    Route::delete('/divisi/{id}/destroy', [App\Http\Controllers\DivisiController::class, 'destroy'])->name('divisi.destroy');
    Route::post('/divisi/store', [App\Http\Controllers\DivisiController::class, 'store'])->name('divisi.store');
    Route::put('/divisi/update', [App\Http\Controllers\DivisiController::class, 'update'])->name('divisi.update');
    // ----------------------------- positions ------------------------------//
    Route::get('/jabatan', [App\Http\Controllers\JabatanController::class, 'index'])->name('jabatan');
    Route::get('/jabatan/{id}/edit', [App\Http\Controllers\JabatanController::class, 'edit'])->name('jabatan.edit');
    Route::delete('/jabatan/{id}/destroy', [App\Http\Controllers\JabatanController::class, 'destroy'])->name('jabatan.destroy');
    Route::post('/jabatan/store', [App\Http\Controllers\JabatanController::class, 'store'])->name('jabatan.store');
    Route::put('/jabatan/update', [App\Http\Controllers\JabatanController::class, 'update'])->name('jabatan.update');
    // ----------------------------- pengajuan cuti ------------------------------//
    Route::get('/pengajuan-cuti', [App\Http\Controllers\PengajuanCutiController::class, 'index'])->name('pengajuan-cuti');
    Route::get('/pengajuan-cuti/{id}/show', [App\Http\Controllers\PengajuanCutiController::class, 'show'])->name('pengajuan-cuti.show');
    Route::post('/pengajuan-cuti/store', [App\Http\Controllers\PengajuanCutiController::class, 'store'])->name('pengajuan-cuti.store');
    Route::get('/pengajuan-cuti/mark-notif/{id}', [App\Http\Controllers\PengajuanCutiController::class, 'markNotif'])->name('pengajuan-cuti.mark-notif');
    Route::get('/pengajuan-cuti/mark-all', [App\Http\Controllers\PengajuanCutiController::class, 'markAll'])->name('pengajuan-cuti.mark-all');
    Route::get('/pengajuan-cuti/{pengajuan}/reject', [App\Http\Controllers\PengajuanCutiController::class, 'updateReject'])->name('pengajuan-cuti.reject');
    Route::get('/pengajuan-cuti/{pengajuan}/approve', [App\Http\Controllers\PengajuanCutiController::class, 'updateApprove'])->name('pengajuan-cuti.approve');
    Route::delete('/pengajuan-cuti/{id}/destroy', [App\Http\Controllers\PengajuanCutiController::class, 'destroy'])->name('pengajuan-cuti.destroy');
    // ----------------------------- pengajuan cuti ------------------------------//
    Route::get('/persetujuan-cuti', [App\Http\Controllers\PersetujuanCutiController::class, 'index'])->name('persetujuan-cuti');
    Route::get('/persetujuan-cuti/{persetujuan}/show', [App\Http\Controllers\PersetujuanCutiController::class, 'show'])->name('persetujuan-cuti.show');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
