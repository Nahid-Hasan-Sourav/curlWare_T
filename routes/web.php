<?php

use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Reply\ReplyController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/blog/index',[BlogController::class,'index'])->name('blog.index');
    Route::get('/blog/create',[BlogController::class,'create'])->name('blog.create');
    Route::post('/blog/store',[BlogController::class,'store'])->name('blog.store');
    Route::post('/upload-image',[BlogController::class,'uploadImages'])->name('blog.uploadImages');
    Route::get('/blog/edit/{blog}',[BlogController::class,'edit'])->name('blog.edit');
    Route::post('/blog/update/{id}',[BlogController::class,'update'])->name('blog.update');
    Route::get('/blog/delete/{id}',[BlogController::class,'destroy'])->name('blog.destroy');
    Route::get('/blog/details/{id}',[BlogController::class,'details'])->name('blog.details');
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/reply', [ReplyController::class, 'store'])->name('replies.store');






});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
