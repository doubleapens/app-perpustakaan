<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Member;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['member', 'user', 'loanItems.book'])->latest()->paginate(10);

        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $members = Member::where('status', 'aktif')->orderBy('nama')->get();
        $books = Book::where('stok', '>', 0)->orderBy('judul')->get();

        return view('loans.create', compact('members', 'books'));
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
                'user_id' => auth()->id(),
                'tanggal_pinjam' => $validated['tanggal_pinjam'],
                'tanggal_kembali' => $validated['tanggal_kembali'],
                'status' => 'dipinjam',
            ]);

            foreach (array_unique($validated['book_ids']) as $bookId) {
                $book = Book::lockForUpdate()->findOrFail($bookId);
                if ($book->stok < 1) {
                    throw new \RuntimeException("Stok buku \"{$book->judul}\" tidak tersedia.");
                }
                $loan->loanItems()->create(['book_id' => $bookId]);
                $book->decrement('stok');
            }

            return $loan;
        });

        return redirect()->route('loans.index')
            ->with('success', "Peminjaman #{$loan->id} berhasil dicatat.");
    }

    public function show(string $id)
    {
        $loan = Loan::with(['member', 'user', 'loanItems.book'])->findOrFail($id);

        return view('loans.show', compact('loan'));
    }

    public function destroy(string $id)
    {
        $loan = Loan::findOrFail($id);
        $loan->delete();

        return redirect()->route('loans.index')->with('success', 'Peminjaman berhasil dihapus.');
    }

    public function kembalikan(string $id)
    {
        $loan = Loan::with('loanItems')->findOrFail($id);
        DB::transaction(function () use ($loan) {
            foreach ($loan->loanItems as $item) {
                $item->book()->increment('stok');
            }
            $loan->update([
                'tanggal_dikembalikan' => now()->toDateString(),
                'status' => 'dikembalikan',
            ]);
        });

        return redirect()->route('loans.index')->with('success', 'Buku berhasil dikembalikan.');
    }

    public function report()
    {
        try {
            $response = Http::get(config('services.internal_api.base_url').'/api/loans');
            $loans = $response->successful() ? ($response->json('data') ?? []) : [];
        } catch (ConnectionException) {
            $loans = [];
        }

        return view('loans.report', compact('loans'));
    }
}
