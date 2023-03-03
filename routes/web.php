<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ThemeController;
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

Route::get('/post/{id}', [PostController::class, 'showThemes']);

Route::match(['get', 'post'], '/theme/add', [ThemeController::class, 'formCreate'])->name('add.theme');
