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
    Route::get('home', function () {
        return view('home');
    });
    Route::get('home', function () {
        return view('home');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// -----------------------------login----------------------------------------//
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
// ----------------------------- user profile ------------------------------//
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
// ----------------------------- user employee ------------------------------//
Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee');
Route::get('/employee/create', [App\Http\Controllers\EmployeeController::class, 'create'])->name('employee.create');
Route::get('/employee/{id}/edit/', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('employee.edit');
Route::delete('/employee/{id}/destroy', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('employee.destroy');
Route::get('/employee/{id}/show', [App\Http\Controllers\EmployeeController::class, 'show'])->name('employee.show');
Route::post('/employee/store', [App\Http\Controllers\EmployeeController::class, 'store'])->name('employee.store');
Route::put('/employee/updatePegawai', [App\Http\Controllers\EmployeeController::class, 'updatePegawai'])->name('employee.updatePegawai');
Route::put('/employee/updatePersonal', [App\Http\Controllers\EmployeeController::class, 'updatePersonal'])->name('employee.updatePersonal');
Route::put('/employee/updateKantor', [App\Http\Controllers\EmployeeController::class, 'updateKantor'])->name('employee.updateKantor');
// ----------------------------- departements ------------------------------//
Route::get('/divisi', [App\Http\Controllers\DivisiController::class, 'index'])->name('divisi');
Route::get('/divisi/create', [App\Http\Controllers\DivisiController::class, 'create'])->name('divisi.create');
Route::get('/divisi/{id}/edit', [App\Http\Controllers\DivisiController::class, 'edit'])->name('divisi.edit');
Route::delete('/divisi/{id}/destroy', [App\Http\Controllers\DivisiController::class, 'destroy'])->name('divisi.destroy');
Route::get('/divisi/{id}/show', [App\Http\Controllers\DivisiController::class, 'show'])->name('divisi.show');
Route::post('/divisi/store', [App\Http\Controllers\DivisiController::class, 'store'])->name('divisi.store');
Route::put('/divisi/update', [App\Http\Controllers\DivisiController::class, 'update'])->name('divisi.update');
// ----------------------------- positions ------------------------------//
Route::get('/jabatan', [App\Http\Controllers\JabatanController::class, 'index'])->name('jabatan');
Route::get('/jabatan/create', [App\Http\Controllers\JabatanController::class, 'create'])->name('jabatan.create');
Route::get('/jabatan/{id}/edit', [App\Http\Controllers\JabatanController::class, 'edit'])->name('jabatan.edit');
Route::delete('/jabatan/{id}/destroy', [App\Http\Controllers\JabatanController::class, 'destroy'])->name('jabatan.destroy');
Route::get('/jabatan/{id}/show', [App\Http\Controllers\JabatanController::class, 'show'])->name('jabatan.show');
Route::post('/jabatan/store', [App\Http\Controllers\JabatanController::class, 'store'])->name('jabatan.store');
Route::put('/jabatan/update', [App\Http\Controllers\JabatanController::class, 'update'])->name('jabatan.update');
