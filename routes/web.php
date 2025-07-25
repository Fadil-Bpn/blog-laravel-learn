<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\AdminPostsController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

Route::get('/private-post-images/{filename}', function ($filename, Request $request) {
    $post = \App\Models\Post::where('image', 'like', "%$filename")->first();

    if (!$post) {
        abort(404, 'Post cannot be found.');
    }

    // Harus login
    if (!Auth::check()) {
        abort(403, 'You need to login first!.');
    }

    // ✅ Validasi referer agar tidak bisa akses langsung dari URL
    $referer = $request->headers->get('referer');
    if (!$referer || !str_contains($referer, url('/'))) {
        abort(403, 'Straight access to image URL is Forbidden!.');
    }

    // 🟢 Tidak perlu cek pemilik lagi
    $path = storage_path('app/' . $post->image);
    if (!file_exists($path)) {
        abort(404, 'Image cannot be found.');
    }

    return response()->file($path);
})->name('secure.image')->middleware('auth');



Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth');

Route::get('/dashboard/posts/datatable', [DashboardPostController::class, 'datatable'])->name('posts.datatable');
Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

Route::get('/dashboard/categories/datatable', [AdminCategoryController::class, 'datatable'])->name('categories.datatable');
Route::get('/dashboard/categories/checkSlug', [AdminCategoryController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/categories', AdminCategoryController::class)
    ->middleware(['auth', 'role:admin'])
    ->parameters(['categories' => 'category:slug']);


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('/dashboard/admin-posts', AdminPostsController::class)->parameters([
        'admin-posts' => 'admin_post:slug'
    ]);
});

Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
});

Route::get('/about', function () {
    return view('about', ['name' => 'Nama Saya', 'title' => 'About Page']);
});

Route::get('/posts', function () {

    // $posts = Post::with(['author', 'category'])->latest()->get();
    return view('posts', ['title' => 'Blog Page', 'posts' => Post::filter(request(['search', 'category', 'author']))->latest()->simplePaginate(9)->withQueryString()]);
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact Page']);
});

Route::get('/posts/{post:slug}', function (Post $post) {

    return view('post', ['title' => 'Single Post', 'post' => $post]);
});
Route::get('/authors/{user:username}', function (User $user) {
    // $posts = $user->posts->load('category', 'author');
    return view('posts', ['title' => $user->posts()->count() . ' Articles by ' . $user->name, 'posts' => $user->posts]);
});
Route::get('/categories/{category:slug}', function (Category $category) {
    // $posts = $category->posts->load('category', 'author');
    return view('posts', ['title' => ' Articles in ' . $category->name, 'posts' => $category->posts]);
});
