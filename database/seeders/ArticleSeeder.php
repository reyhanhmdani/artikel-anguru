<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // LOGIKA SEEDER ANDA BERADA DI SINI

        // Contoh: Membuat 50 artikel dummy
        Article::factory()
            ->count(50)
            ->create();

        // Akhir dari fungsi run()
    }
    // Akhir dari class ArticleSeeder
}
