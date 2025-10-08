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

    public function articles(Request $request)
{
    // Ambil parameter tahun dan bulan dari URL
    $year = $request->get('year');
    // KONVERSI $month MENJADI INTEGER (jika ada, jika tidak ada, biarkan null)
    $month = $request->get('month') ? (int) $request->get('month') : null;

    // Mulai query
    $query = Article::latest();

    // Logika Filter Tahun
    if ($year) {
        $query->whereYear('created_at', $year);
    }

     if ($month) {
        $query->whereMonth('created_at', $month);
    }   

    // Ambil hasil paginasi
    $articles = $query->paginate(21);

    // Dapatkan daftar tahun unik yang ada untuk filter
    $availableYears = Article::selectRaw('YEAR(created_at) as year')
        ->distinct()
        ->orderBy('year', 'desc')
        ->pluck('year');

    // Dapatkan daftar bulan yang ada di tahun yang dipilih (jika ada)
    $availableMonths = [];
    if ($year) {
        $availableMonths = Article::selectRaw('MONTH(created_at) as month_num, MONTHNAME(created_at) as month_name')
            ->whereYear('created_at', $year)
            ->distinct()
            ->orderBy('month_num', 'asc')
            ->get();
    }


    // Kirim data artikel, tahun yang tersedia, dan filter yang aktif ke View
    return view('public.articles', compact('articles', 'availableYears', 'availableMonths', 'year', 'month'));
}

    public function showPublic(Article $article)
    {
        $latestArticles = Article::latest()->where('id', '!=', $article->id)->take(3)->get();

        return view('public.show-article', compact('article', 'latestArticles'));
    }

}
