<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
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
Route::get('/comments/{id}', [CommentController::class, 'showComments'])->name('show-comments');

Route::get('/my-posts', [PostController::class, 'showMyPosts'])->name('my.posts');
Route::get('/my-themes', [ThemeController::class, 'showMyThemes'])->name('my.themes');
Route::get('/my-profile/', [UserController::class, 'showProfile'])->name('my.profile');
Route::get('/my-comments/', [CommentController::class, 'showMyComments'])->name('my.comments');

Route::match(['get', 'post'], '/theme/add/{id}', [ThemeController::class, 'formCreate'])->name('add.theme');
Route::match(['get', 'post'], '/update/theme/{id}', [ThemeController::class, 'update'])->name('update.theme');
Route::get('/theme/delete/{id}', [ThemeController::class, 'delete'])->name('delete.theme');

Route::match(['get', 'post'], '/comment/add/{id}', [CommentController::class, 'create'])->name('add.comment');
Route::match(['get', 'post'], '/update/comment/{id}', [CommentController::class, 'update'])->name('update.comment');
Route::get('/comment/delete/{id}', [CommentController::class, 'delete'])->name('delete.comment');

Route::get('/admin', [AdminController::class, 'show'])->middleware('auth')->name('admin.panel');
Route::get('/profile/user/{id}', [AdminController::class, 'showUserProfile'])->middleware('auth')->name('user.profile');
Route::get('/change/status/{id}', [AdminController::class, 'changeStatus'])->name('change.status');
Route::match(['get', 'post'], '/admin/update/post/{id}', [AdminController::class, 'update'])->name('admin.update.post');


