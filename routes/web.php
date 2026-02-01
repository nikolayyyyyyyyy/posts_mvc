<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::controller(PostController::class)->group(function () {
    Route::get('/posts-create', function() {
        $categories = Category::orderBy('id')
            ->get();
        $tags = Tag::orderBy('id')
            ->get();

        return Inertia::render('User/CreatePost', ['categories' => $categories, 'tags' => $tags]);
    })->name('post-create');
    Route::post('/posts', 'store');

    Route::post('/posts-category', 'getPostsByCategorySlug');
    Route::get('/posts-category', function() {
        return Inertia::render('User/Lists/PostByCategory');
    });

    Route::post('/posts-tag', 'getPostsByTagSlug');
    Route::get('/posts-tag', function() {
        return Inertia::render('User/Lists/PostByTagSlug');
    });

    Route::post('/posts-author', 'getUserPosts');
    Route::get('/posts-author', function() {
        return Inertia::render('User/Lists/PostByAuthor',[
            'users' => User::orderBy('id', 'desc')->get()
        ]);
    });

    Route::get('/most-readed-post', function() {
        $posts = Post::orderBy('count_likes', 'desc')->get();
        return Inertia::render('MostReadedPost', ['posts' => $posts]);
    });

    Route::post('/last-comments-for-page', 'getLastestCommentsForPost');
    Route::get('/last-comments-for-page', function() {
        $posts = Post::all()->select(['id', 'title', 'slug']);
        return Inertia::render('LastCommentsForPage', ['posts' => $posts]); 
    });

    Route::get('/count-posts-user', function () {
        $users = User::with('posts')
            ->get()
            ->map(fn ($user) => [
                'email' => $user->email,
                'post_count' => $user->posts()->count()
            ]);
        return Inertia::render('CountPostOfUsers', [ 'users' => $users ]);
    });
})->middleware('auth');

Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories-create', function () {
        return Inertia::render('User/CreateCategory');
    })->name('category-create');

    Route::post('/categories', 'store');
})->middleware('auth');


Route::controller(TagController::class)->group(function () {
    Route::get('/tag-create', function() {
        return Inertia::render('User/CreateTag');
    })->name('tag-create');

    Route::post('/tags', 'store');
})->middleware('auth');

Route::controller(CommentController::class)->group(function () {
    Route::get('/comment-create', function() {
        $posts = Post::all()->select(['id','slug']);
        $users = User::all()->select(['id', 'email']);

        return Inertia::render('User/CreateComment',[
            'posts' => $posts,
            'users' => $users
        ]);
    })->name('comment-create');

    Route::post('/comments', 'store');
})->middleware('auth');

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
