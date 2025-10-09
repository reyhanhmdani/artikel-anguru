<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Http\Requests\StoreArticleRequest;
use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $year = $request->get('year');
        $month = $request->get('month') ? (int) $request->get('month') : null;

        $query = Article::query();

        if ($year) {
            $query->whereYear('created_at', $year);
        }

        if ($month) {
            $query->whereMonth('created_at', $month);
        }

        // Jika hanya ingin menampilkan artikel yang AKTIF (tidak terhapus)
        $query->whereNull('deleted_at');

        $articles = $query->latest()->paginate(10)->withQueryString();

        $totalArticles = Article::withTrashed()->count();

        $deletedArticlesCount = Article::onlyTrashed()->count();

        $availableYears = Article::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        $availableMonths = [];
        if ($year) {
            $availableMonths = Article::selectRaw('MONTH(created_at) as month_num, MONTHNAME
            (created_at) as month_name')
                ->whereYear('created_at', $year)
                ->distinct()
                ->orderBy('month_num')
                ->get();
        }

        return view('admin.articles.index', compact('articles',
            'totalArticles',
            'deletedArticlesCount',
            'availableYears',
            'availableMonths',
            'year',
            'month' ));
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

        $article = Article::create($data);

        if ($article->created_at->isAfter(Carbon::now()->subDays(30))){
            $article->category = 'Terbaru';
            $article->save(); // Simpan perubahan
        }


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

    // Logika penanganan gambar: hapus gambar lama, upload yang baru
    if ($request->hasFile('image')) {
        if ($article->image && Storage::disk('public')->exists($article->image)) {
            Storage::disk('public')->delete($article->image);
        }

        $data['image'] = $request->file('image')->store('articles', 'public');
    }

    // Ambil nilai kategori langsung dari form
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
