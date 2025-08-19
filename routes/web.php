<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\SearchController;
use App\Models\Article;
use Illuminate\Support\Facades\Route;

Route::get('/search', [SearchController::class, 'search'])->name('public.search_result');

Route::get('/', [PublicController::class, 'index'])->name('public.home');
Route::get('/articles', [PublicController::class, 'articles'])->name('public.articles');
Route::get('/articles/{article}', [PublicController::class, 'showPublic'])->name('public.show-article');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

     // Rute untuk Article
    Route::resource('admin/articles', ArticleController::class);
});

require __DIR__.'/auth.php';
