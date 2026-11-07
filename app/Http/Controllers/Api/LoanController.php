<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LoanResource;
use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function index()
    {
        return LoanResource::collection(Loan::with(['member', 'user', 'loanItems.book'])->latest()->paginate(10));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'book_ids' => 'required|array|min:1',
            'book_ids.*' => 'exists:books,id',
        ]);

        $loan = DB::transaction(function () use ($validated) {
            $loan = Loan::create([
                'member_id' => $validated['member_id'],
                'user_id' => User::where('role', 'petugas')->value('id') ?? User::value('id'),
                'tanggal_pinjam' => $validated['tanggal_pinjam'],
                'tanggal_kembali' => $validated['tanggal_kembali'],
                'status' => 'dipinjam',
            ]);

            foreach (array_unique($validated['book_ids']) as $bookId) {
                $book = Book::lockForUpdate()->findOrFail($bookId);
                if ($book->stok < 1) {
                    throw new \RuntimeException('Stok buku tidak tersedia.');
                }
                $loan->loanItems()->create(['book_id' => $book->id]);
                $book->decrement('stok');
            }

            return $loan;
        });

        return (new LoanResource($loan->load(['member', 'user', 'loanItems.book'])))->response()->setStatusCode(201);
    }

    public function kembalikan(string $id)
    {
        $loan = Loan::findOrFail($id);
        $loan->update(['status' => 'dikembalikan', 'tanggal_dikembalikan' => now()->toDateString()]);

        return new LoanResource($loan->load(['member', 'user', 'loanItems.book']));
    }
}
