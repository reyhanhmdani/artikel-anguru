<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $articles = Article::where('title', 'like', '%' . $query . '%')
                               ->orWhere('content', 'like', '%' . $query . '%')
                               ->latest()
                               ->paginate(10);
        } else {
            // Jika query kosong, tampilkan semua artikel dengan paginasi
            $articles = Article::latest()->paginate(10);
        }

        return view('public.search_result', compact('articles', 'query'));
    }
}