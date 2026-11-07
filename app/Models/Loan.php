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
    protected function casts(): array
    {
        return [
            'tanggal_pinjam' => 'date',
            'tanggal_kembali' => 'date',
            'tanggal_dikembalikan' => 'date',
        ];
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loanItems()
    {
        return $this->hasMany(LoanItem::class);
    }
}
