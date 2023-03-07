<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('home');
});*/

Auth::routes();

/*Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');*/

Route::match(['get', 'post'],'/', [PostController::class, 'show'])->name('home');
Route::match(['get', 'post'],'/home', [PostController::class, 'show'])->name('home');

Route::match(['get', 'post'], '/post/add', [PostController::class, 'formCreate'])->name('add.post');
Route::match(['get', 'post'], '/update/post/{id}', [PostController::class, 'update'])->name('update.post');
Route::get('/post/delete/{id}', [PostController::class, 'delete'])->name('delete.post');

Route::get('/post/{id}', [ThemeController::class, 'showThemes'])->name('show-themes');

Route::get('/my-posts', [PostController::class, 'showMyPosts'])->name('my.posts');
Route::get('/my-themes', [ThemeController::class, 'showMyThemes'])->name('my.themes');

Route::match(['get', 'post'], '/theme/add/{id}', [ThemeController::class, 'formCreate'])->name('add.theme');
Route::match(['get', 'post'], '/update/theme/{id}', [ThemeController::class, 'update'])->name('update.theme');

Route::get('/my-profile/', [UserController::class, 'showProfile'])->name('my.profile');
