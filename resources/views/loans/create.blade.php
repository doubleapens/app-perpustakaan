@extends('layouts.app')
@section('title', 'Tambah Peminjaman')
@section('content')
<h1>Tambah Peminjaman</h1>
<form method="POST" action="{{ route('loans.store') }}">
@csrf
<label>Anggota<select name="member_id" required><option value="">Pilih anggota</option>@foreach($members as $member)<option value="{{ $member->id }}" @selected(old('member_id') == $member->id)>{{ $member->nama }}</option>@endforeach</select></label>
<label>Tanggal Pinjam<input type="date" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', now()->toDateString()) }}" required></label>
<label>Tanggal Kembali<input type="date" name="tanggal_kembali" value="{{ old('tanggal_kembali', now()->addDays(7)->toDateString()) }}" required></label>
<h3>Buku</h3>
@foreach($books as $book)<label><input type="checkbox" name="book_ids[]" value="{{ $book->id }}"> {{ $book->judul }} (stok {{ $book->stok }})</label><br>@endforeach
@error('book_ids')<div>{{ $message }}</div>@enderror
<button class="btn" type="submit">Simpan</button>
</form>
@endsection
