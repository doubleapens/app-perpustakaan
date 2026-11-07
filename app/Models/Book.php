<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function loanItems()
    {
        return $this->hasMany(LoanItem::class);
    }
}
