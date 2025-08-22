<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BiographyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\SearchController;
use App\Models\Article;
use Illuminate\Support\Facades\Route;

Route::get('/search', [SearchController::class, 'search'])->name('public.search_result');

Route::get('/', [PublicController::class, 'index'])->name('public.home');
Route::get('/articles', [PublicController::class, 'articles'])->name('public.articles');
Route::get('/articles/{article}', [PublicController::class, 'showPublic'])->name('public.show-article');
Route::get('/bioghraphy', [BiographyController::class, 'show'])->name('public.biography');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('admin/biography', [BiographyController::class, 'manage'])->name('admin.biography.manage');
    Route::post('admin/biography', [BiographyController::class, 'storeOrUpdate'])->name('admin.biography.storeOrUpdate');


   // Rute untuk mengelola soft deletes (harus di atas rute resource)
    Route::get('admin/articles/trash', [ArticleController::class, 'trash'])->name('articles.trash');
    Route::post('admin/articles/{article}/restore', [ArticleController::class, 'restore'])->name('articles.restore');
    Route::delete('admin/articles/{article}/force-delete', [ArticleController::class, 'forceDelete'])->name('articles.force-delete');

    // Rute untuk aksi massal (restore dan delete)
    Route::post('admin/articles/bulk-restore', [ArticleController::class, 'bulkRestore'])->name('articles.bulk-restore');
    Route::delete('admin/articles/bulk-delete', [ArticleController::class, 'bulkDelete'])->name('articles.bulk-delete');


    // Rute untuk Article
    Route::resource('admin/articles', ArticleController::class);

});

require __DIR__.'/auth.php';
