<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StorageFileController;

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
    return view('welcome');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::prefix('dashboard')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function() {
        Route::get('/', [BeritaController::class, 'index'])->name('dashboard');
    });
    
Route::resource('beritas', BeritaController::class);
Route::get('/createpost', [BeritaController::class, 'create']);
Route::post('save', [BeritaController::class, 'store']);

// Route::get('images/{filename}', [StorageFileController::class,'getPubliclyStorgeFile'])->name('image.displayImage');