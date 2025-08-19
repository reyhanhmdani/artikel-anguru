<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
         $articles = Article::latest()->take(3)->get();
        return view('public.home', compact('articles'));
    }

     public function articles()
    {
        // Ambil satu artikel terbaru sebagai "top article"
        $latestArticle = Article::latest()->first();

        // Ambil sisa artikel lainnya dengan paginasi, kecuali artikel terbaru
        $articles = Article::latest()
                            ->where('id', '!=', $latestArticle->id ?? null)
                            ->paginate(9); // Tampilkan 9 artikel per halaman

        return view('public.articles', compact('latestArticle', 'articles'));
    }

    public function showPublic(Article $article)
    {
        // Ambil artikel terbaru, kecuali artikel yang sedang dibuka
        $latestArticles = Article::latest()->where('id', '!=', $article->id)->take(3)->get();

        // Kirim data ke view public
        return view('public.show-article', compact('article', 'latestArticles'));
    }
}
