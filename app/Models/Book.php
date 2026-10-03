<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'judul',
    'penulis',
    'penerbit',
    'tahun_terbit',
    'isbn',
    'stok',
    'category_id',
    'sampul',
])]
class Book extends Model
{
    //
}
