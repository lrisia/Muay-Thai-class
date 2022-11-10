<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('muay_thai_class.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('muay_thai_class/{id}/attendance', [\App\Http\Controllers\MuayThaiClassController::class, 'attendance'])->name('class.attendance');
Route::get('muay_thai_class/{id}/pay', [\App\Http\Controllers\MuayThaiClassController::class, 'buyCourse'])->name('class.pay');
Route::get('muay_thai_class/check', [\App\Http\Controllers\MuayThaiClassController::class, 'saveAttendance'])->name('class.check');
Route::get('muay_thai_class/receipt', [\App\Http\Controllers\MuayThaiClassController::class, 'receipt'])->name('class.receipt');
Route::get('muay_thai_class/{id}/receipt', [\App\Http\Controllers\MuayThaiClassController::class, 'showReceipt'])->name('receipt.show');

Route::resource('/muay_thai_class', \App\Http\Controllers\MuayThaiClassController::class);
Route::resource('/manager', \App\Http\Controllers\ManagerController::class);
