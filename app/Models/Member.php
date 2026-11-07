<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    use HasFactory;

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
