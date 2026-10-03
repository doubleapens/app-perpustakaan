<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'member_id',
    'user_id',
    'tanggal_pinjam',
    'tanggal_kembali',
    'tanggal_dikembalikan',
    'status',
])]
class Loan extends Model
{
    //
}
