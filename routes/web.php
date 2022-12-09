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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('draw', [App\Http\Controllers\DrawController::class, 'drawPage'])->name('draw');

Route::get('/gallery', [App\Http\Controllers\GalleryController::class, 'index'])->name('gallery');

Route::post('draw', [App\Http\Controllers\DrawController::class, 'newUpload'])->name('upload');
