<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UsersController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

    // POSTS
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/{id}/show', [PostController::class, 'show'])->name('post.show');
    Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::patch('/post/{id}/edit', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/{id}/destroy', [PostController::class, 'destroy'])->name('post.destroy');

    // COMMENTS
    Route::post('/comment/{post_id}/store', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('/comment/{post_id}/delete', [CommentController::class, 'destroy'])->name('comment.destroy');

    // PROFILE
    Route::get('/profile/{id}/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/{id}/followers', [ProfileController::class, 'followers'])->name('profile.followers');
    Route::get('/profile/{id}/following', [ProfileController::class, 'following'])->name('profile.following');

    // LIKE
    Route::post('/like/{post_id}/store', [LikeController::class, 'store'])->name('like.store');
    Route::delete('/like/{post_id}/destroy', [LikeController::class, 'destroy'])->name('like.destroy');

    // FOLLOW
    Route::post('/follow/{user_id}/store', [FollowController::class, 'store'])->name('follow.store');
    Route::delete('/follow/{user_id}/destroy', [FollowController::class, 'destroy'])->name('follow.destroy');
    
    // SUGGESTIONS
    Route::get('/suggestions', [HomeController::class, 'suggestions'])->name('suggestions');

    // ADMIN ROUTES/CONTROLS
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){
        /* USERS */
        Route::get('/users', [UsersController::class, 'index'])->name('users'); // admin.users
        Route::delete('/users/{id}/deactivate', [UsersController::class, 'deactivate'])->name('users.deactivate'); // admin.users.deactivate
        Route::patch('/users/{id}/activate', [UsersController::class, 'activate'])->name('users.activate'); // admin.users.activate
    });
});

