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
Route::get('/employee/{id}/edit', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('employee.edit');
Route::delete('/employee/{id}/destroy', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('employee.destroy');
Route::get('/employee/{id}/show', [App\Http\Controllers\EmployeeController::class, 'show'])->name('employee.show');
Route::post('/employee/store', [App\Http\Controllers\EmployeeController::class, 'store'])->name('employee.store');
Route::get('/employee/{id}/update', [App\Http\Controllers\EmployeeController::class, 'update'])->name('employee.update');
