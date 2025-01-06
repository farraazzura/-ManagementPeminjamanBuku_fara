<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;
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
Route::get('/', [ProductController::class,'index']);
Route::get('/', function () {return view('welcome');});
Route::get('/peminjaman', [TransaksiController::class, 'create']);
Route::post('/peminjaman', [TransaksiController::class, 'store']);
Route::get('/pengembalian', [TransaksiController::class, 'returnForm']);
Route::post('/peminjaman', [TransaksiController::class, 'processReturn']);
Route::get('/cetak/{id}', [TransaksiController::class, 'printCard']);