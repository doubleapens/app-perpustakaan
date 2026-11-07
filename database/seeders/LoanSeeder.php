<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Seeder;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = Member::where('status', 'aktif')->get();
        $staff = User::where('role', 'petugas')->get();

        foreach ($members->take(5) as $index => $member) {
            $loan = Loan::create([
                'member_id' => $member->id,
                'user_id' => $staff->isNotEmpty() ? $staff[$index % $staff->count()]->id : User::first()->id,
                'tanggal_pinjam' => now()->subDays($index + 2)->toDateString(),
                'tanggal_kembali' => now()->addDays(7 - $index)->toDateString(),
                'status' => 'dipinjam',
            ]);

            $loan->loanItems()->create([
                'book_id' => Book::inRandomOrder()->value('id'),
            ]);
        }
    }
}
