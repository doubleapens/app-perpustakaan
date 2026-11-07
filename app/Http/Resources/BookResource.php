<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /** @return array<string, mixed> */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'judul' => $this->judul,
            'penulis' => $this->penulis,
            'penerbit' => $this->penerbit,
            'tahun_terbit' => $this->tahun_terbit,
            'isbn' => $this->isbn,
            'stok' => $this->stok,
            'sampul' => $this->sampul,
            'category' => $this->category ? [
                'id' => $this->category->id,
                'nama_kategori' => $this->category->nama_kategori,
            ] : null,
        ];
    }
}
