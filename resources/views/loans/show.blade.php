@extends('layouts.app')
@section('title', 'Detail Peminjaman')
@section('content')
<h1>Peminjaman #{{ $loan->id }}</h1>
<p>Anggota: {{ $loan->member?->nama }}<br>Petugas: {{ $loan->user?->name }}<br>Status: {{ $loan->status }}</p>
<h2>Buku Dipinjam</h2>
<ul>@foreach($loan->loanItems as $item)<li>{{ $item->book?->judul }}</li>@endforeach</ul>
@endsection
