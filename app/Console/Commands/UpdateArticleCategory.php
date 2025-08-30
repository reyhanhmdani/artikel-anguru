<?php

namespace App\Console\Commands;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateArticleCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:update-category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the category of articles older than 30 days to null.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $articles = Article::where('category', 'Terbaru')
                            ->where('created_at', '<', Carbon::now()->subDays(30))
                            ->get();


        $count = $articles->count();

        // Gunakan kondisi if/else untuk memberikan feedback yang jelas
        if ($count > 0) {
            foreach ($articles as $article) {
                $article->update(['category' => null]);
            }
            $this->info("Berhasil memperbarui {$count} artikel. Kategori 'Terbaru' telah dihapus.");
        } else {
            $this->info("Tidak ada artikel yang perlu diperbarui.");
        }

        return Command::SUCCESS;
    }
}
