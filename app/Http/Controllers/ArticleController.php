<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Http\Requests\StoreArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::latest()->paginate(10);

        $totalArticles = Article::withTrashed()->count();

        $deletedArticlesCount = Article::onlyTrashed()->count();

        return view('admin.articles.index', compact('articles', 'totalArticles', 'deletedArticlesCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        // Set kategori otomatis
        $data['category'] = (date('Y', strtotime($data['created_at'])) == now()->year) ? 'Terbaru' : null;

        Article::create($data);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
{
    $latestArticles = Article::latest()->where('id', '!=', $article->id)->take(3)->get();

    return view('admin.articles.show', compact('article', 'latestArticles'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
         return view('admin.articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($article->image && Storage::disk('public')->exists($article->image)) {
                Storage::disk('public')->delete($article->image);
            }

            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $data['category'] = $request->input('category');


        $article->update($data);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil dihapus.');
    }


    public function trash()
    {
        $articles = Article::onlyTrashed()->latest()->paginate(10);
        return view('admin.articles.trash', compact('articles'));
    }

    public function restore($id)
    {
        $article = Article::onlyTrashed()->findOrFail($id);
        $article->restore();

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil di restore.');
    }

    public function forceDelete($id)
    {
        $article = Article::onlyTrashed()->findOrFail($id);
        if ($article->image && Storage::disk('public')->exists($article->image)) {
        Storage::disk('public')->delete($article->image);
        }

        $article->forceDelete();

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil dihapus permanen.');
    }
}
