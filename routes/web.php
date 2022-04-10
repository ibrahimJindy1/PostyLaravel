<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\UserPostController;

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
Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');


Route::get('/register',[RegisterController::class,'index'])->name('register');
Route::post('/register',[RegisterController::class,'store']);

Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'login']);

Route::post('/logout',[LogoutController::class,'logout'])->name('logout');

Route::get('/users/{user:username}/posts',[UserPostController::class,'index'])->name('users.posts');


Route::get('/posts',[PostController::class,'index'])->name('posts');
Route::post('/posts',[PostController::class,'post']);
Route::delete('/posts/{post}',[PostController::class,'destroy'])->name('posts.destroy');

Route::post('/posts/{post}/likes',[PostLikeController::class,'like'])->name('posts.like');
Route::delete('/posts/{post}/likes',[PostLikeController::class,'destroy'])->name('posts.like');

Route::get('/',function ()
{
    return view('home');
})->name('home');


