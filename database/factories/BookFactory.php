<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titles = ['Algoritma Modern', 'Dasar Jaringan Komputer', 'Laskar Pagi', 'Peta Nusantara', 'Data Cerdas'];

        return [
            'judul' => fake()->randomElement($titles).' '.fake()->unique()->numberBetween(1, 999),
            'penulis' => fake()->name('male').' '.fake()->lastName(),
            'penerbit' => fake()->randomElement(['Gramedia', 'Erlangga', 'Deepublish', 'Informatika']),
            'tahun_terbit' => fake()->numberBetween(1990, (int) date('Y')),
            'isbn' => fake()->unique()->numerify('978##########'),
            'stok' => fake()->numberBetween(1, 8),
            'category_id' => Category::inRandomOrder()->value('id'),
        ];
    }
}
