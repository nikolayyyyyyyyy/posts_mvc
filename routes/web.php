<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    if(Auth::check())
    {
        Route::inertia('/dashboard', 'Dashboard');
    }

    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::controller(PostController::class)->group(function () {
    Route::get('/posts-create', function() {
        $categories = Category::orderBy('id')
            ->get();

        return Inertia::render('User/CreatePost', ['categories' => $categories]);
    })->name('post-create');

    Route::post('/posts', 'store');
})->middleware('auth');

Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories-create', function () {
        return Inertia::render('User/CreateCategory');
    })->name('category-create');

    Route::post('/categories', 'store');
})->middleware('auth');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
