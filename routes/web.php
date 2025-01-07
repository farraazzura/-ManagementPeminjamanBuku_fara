<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;
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

Route::middleware(['auth'])->group(function () {
    Route::resource('transaksis', TransaksiController::class);
    Route::get('transaksis/print/{id}', [TransaksiController::class, 'print'])->name('transaksis.print');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // Logout