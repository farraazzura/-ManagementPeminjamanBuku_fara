<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {

//    return view('welcome');
//});
Route::get('/', function () {return view('welcome');});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form'); // Menampilkan form login
Route::post('/login', [AuthController::class, 'login'])->name('login'); // Proses login

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('users/print/{id}', [UserController::class, 'print'])->name('users.print');
Route::get('bukus/print/{id}', [BukuController::class, 'print'])->name('bukus.print');

Route::middleware(['auth'])->group(function () {
    Route::resource('transaksis', TransaksiController::class);
    Route::get('transaksis/print/{id}', [TransaksiController::class, 'print'])->name('transaksis.print');
});


Route::resource('bukus', BukuController::class);

Route::resource('users', UserController::class);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // Logout