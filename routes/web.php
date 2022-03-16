<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;

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

Route::get('/', [PageController::class, "index"])->name('index');
Route::get('/detail/{slug}', [PageController::class, "detail"])->name('post.detail');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('/post', PostController::class);
Route::resource('/comment', CommentController::class);
Route::resource('/gallery', GalleryController::class);

Route::get('/edit-profile', [HomeController::class, 'editProfile'])->name('edit-profile');
Route::post('/edit-profile', [HomeController::class, 'updateProfile'])->name('update-profile');
Route::get('/change-password', [HomeController::class, 'changePassword'])->name('change-password');
Route::post('/update-password', [HomeController::class, 'updatePassword'])->name('update-password');
