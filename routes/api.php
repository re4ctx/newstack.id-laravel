<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\BeritaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('beritas', [BeritaController::class, 'beritasListing']);

Route::get("berita/{id}", [BeritaController::class, 'beritaDetail']);

Route::get("berita/kategori/{kategori}", [BeritaController::class, 'categoryBerita']);

Route::get("berita/kategori/{kategori}/{limit}", [BeritaController::class, 'relatedPost']);