<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'nama',
    'nim',
    'email',
    'nomor_telepon',
    'alamat',
    'status',
])]
class Member extends Model
{
    //
}
