<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/setup', [App\Http\Controllers\SetupController::class, 'setupPage'])->name('setup')->middleware('auth');
Route::post('/form', [App\Http\Controllers\SetupController::class, 'formFilled'])->name('form')->middleware('auth');

Route::get('/profile/{user}', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile');
Route::post('/bio', [App\Http\Controllers\ProfileController::class, 'edit_bio'])->name('bio');


Route::get('/draw', [App\Http\Controllers\DrawController::class, 'drawPage'])->name('draw')->middleware('auth');
Route::post('/upload', [App\Http\Controllers\DrawController::class, 'newUpload'])->name('upload')->middleware('auth');

Route::get('/gallery/{user}', [App\Http\Controllers\GalleryController::class, 'index'])->name('gallery');

Route::get('/posts/{upload:upload_id}', [App\Http\Controllers\UploadController::class, 'show'])->name('posts');
Route::post('/comment', [App\Http\Controllers\UploadController::class, 'submitComment'])->name('post_comment')->middleware('auth');
Route::post('/delete', [App\Http\Controllers\UploadController::class, 'deleteUpload'])->name('delete_upload')->middleware('auth');
