<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Membuat judul dummy
        $title = $this->faker->sentence(rand(3, 8));

        // Daftar kategori dummy
        $categories = ['Teknologi', 'Gaya Hidup', 'Berita Lokal', 'Olahraga', 'Opini'];

        return [
            'title' => $title,
            'content' => $this->faker->paragraphs(rand(5, 15), true), // Konten 5-15 paragraf

            // Kolom 'image'
            // Gunakan gambar placeholder 640x480
            'image' => 'https://via.placeholder.com/640x480.png?text=' . urlencode($this->faker->word()),

            // Kolom 'category' (disesuaikan dari category_id menjadi string category)
            'category' => $this->faker->randomElement($categories),

            // Kolom created_at: Membuat data tersebar dari 1 tahun lalu hingga akhir 2025
            'created_at' => $this->faker->dateTimeBetween('-1 year', '2025-12-31'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', '2025-12-31'),
        ];
    }
}