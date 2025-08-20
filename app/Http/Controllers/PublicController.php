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

    $articles = Article::latest()->paginate(10);

    return view('public.articles', compact('articles'));
    }

    public function showPublic(Article $article)
    {
        $latestArticles = Article::latest()->where('id', '!=', $article->id)->take(3)->get();

        return view('public.show-article', compact('article', 'latestArticles'));
    }
}
