<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\ClubMemberController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view("welcome");
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Club Routes
Route::middleware('auth')->group(function () {
    Route::get('/clubs', [ClubController::class, 'index'])->name('clubs.index');
    Route::get('/clubs/create', [ClubController::class, 'create'])->name('clubs.create');
    Route::post('/clubs', [ClubController::class, 'store'])->name('clubs.store');
    Route::get('/clubs/{club}', [ClubController::class, 'show'])->name('clubs.show');
});

Route::post('/clubs/{id}/join', [ClubMemberController::class, 'join'])->name('clubs.join');
Route::post('/clubs/{id}/leave', [ClubMemberController::class, 'leave'])->name('clubs.leave');



Route::middleware(['auth'])->group(function () {
    // Show members
    Route::get('/clubs/{club}/members', [ClubController::class, 'members'])->name('clubs.members');

    // Remove a member
    Route::delete('/clubs/{club}/members/{user}', [ClubController::class, 'removeMember'])->name('clubs.members.remove');
});

Route::middleware('auth')->group(function () {
    Route::get('/clubs/{club}/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/clubs/{club}/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/clubs/{club}/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
});


Route::post('/posts/{post}/comments', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');




require __DIR__ . '/auth.php';
