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
    // Mengambil artikel aktif dengan paginasi
    $articles = Article::latest()->paginate(10);

    // Menghitung total artikel (aktif + yang dihapus)
    $totalArticles = Article::withTrashed()->count();

    // Menghitung jumlah artikel yang soft-deleted
    $deletedArticlesCount = Article::onlyTrashed()->count();

    // Mengirimkan data ke view
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

        // Upload image jika ada
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
    // Ambil beberapa artikel terbaru, kecuali artikel yang sedang dibuka
    $latestArticles = Article::latest()->where('id', '!=', $article->id)->take(3)->get();

    // Kirim kedua variabel ke view
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

        // Kalau ada gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama kalau ada
            if ($article->image && Storage::disk('public')->exists($article->image)) {
                Storage::disk('public')->delete($article->image);
            }

        // Simpan gambar baru
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
        if ($article->image && Storage::disk('public')->exists($article->image)) {
        Storage::disk('public')->delete($article->image);
    }

    $article->delete();

    return redirect()->route('articles.index')->with('success', 'Artikel berhasil dihapus.');
    }
}