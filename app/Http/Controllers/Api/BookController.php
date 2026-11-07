<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return BookResource::collection(Book::with('category')->paginate(10));
    }

    public function show(string $id)
    {
        return new BookResource(Book::with('category')->findOrFail($id));
    }

    public function store(StoreBookRequest $request)
    {
        $book = Book::create($request->validated());

        return (new BookResource($book->load('category')))->response()->setStatusCode(201);
    }

    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);
        $validated = $request->validate([
            'judul' => 'sometimes|required|string|max:200',
            'penulis' => 'sometimes|required|string|max:100',
            'penerbit' => 'sometimes|required|string|max:100',
            'tahun_terbit' => 'sometimes|required|integer|min:1900|max:'.date('Y'),
            'isbn' => 'nullable|string|max:20',
            'stok' => 'sometimes|required|integer|min:0',
            'category_id' => 'sometimes|required|exists:categories,id',
        ]);
        $book->update($validated);

        return new BookResource($book->load('category'));
    }

    public function destroy(string $id)
    {
        Book::findOrFail($id)->delete();

        return response()->noContent();
    }
}
