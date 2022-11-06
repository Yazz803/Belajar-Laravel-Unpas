<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(mt_rand(2,4)), // sentence(mt_rand(2,4)) ini akan mencari kata random minimalnya 2 kata dan maksimalnya 8 kata
            'slug' => $this->faker->slug(), // membuat slugnya
            'excerpt' => $this->faker->paragraph(), // untuk membuat paragrap
            // fungsi implode untuk menggabungkan/join setiap arraynya dengan menambahkan delimiter/pemisahnya </p><p>
            // 'body' => '<p>'. implode('</p><p>',$this->faker->paragraphs(mt_rand(5,10))). '</p>', // paragraphs untuk membuat 5-10 paragrap
            'body' => collect($this->faker->paragraphs(mt_rand(5,10)))
                        ->map(fn($p) => "<p>$p</p>")
                        ->implode(''), // jadi setiap paragrap dibungkus dengan tag p
            'user_id' => mt_rand(1,4),
            'category_id' => mt_rand(1,3)
        ];
    }
}
