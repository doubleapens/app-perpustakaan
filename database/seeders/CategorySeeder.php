<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ([
            'Fiksi' => 'Novel dan cerita rekaan.',
            'Teknologi' => 'Pemrograman, jaringan, dan teknologi informasi.',
            'Sains' => 'Matematika dan ilmu pengetahuan alam.',
            'Sejarah' => 'Sejarah nasional dan dunia.',
        ] as $name => $description) {
            Category::updateOrCreate(['nama_kategori' => $name], ['deskripsi' => $description]);
        }
    }
}
