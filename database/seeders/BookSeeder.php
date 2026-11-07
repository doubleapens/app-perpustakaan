<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ([
            'Bumi Manusia' => [Category::where('nama_kategori', 'Fiksi')->value('id'), 'Pramoedya Ananta Toer', 'Lentera Dipantara', 1980, '9789799731234', 5],
            'Clean Code' => [Category::where('nama_kategori', 'Teknologi')->value('id'), 'Robert C. Martin', 'Prentice Hall', 2008, '9780132350884', 4],
            'Fisikawan' => [Category::where('nama_kategori', 'Sains')->value('id'), 'Stephen Hawking', 'Bantam Books', 1988, '9780553380163', 3],
        ] as $title => [$categoryId, $author, $publisher, $year, $isbn, $stock]) {
            Book::updateOrCreate(['isbn' => $isbn], [
                'judul' => $title,
                'penulis' => $author,
                'penerbit' => $publisher,
                'tahun_terbit' => $year,
                'stok' => $stock,
                'category_id' => $categoryId,
            ]);
        }

        Book::factory()->count(17)->create();
    }
}
