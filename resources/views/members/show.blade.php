@extends('layouts.app')
@section('title', $member->nama)
@section('content')
<h1>{{ $member->nama }}</h1>
<p>NIM: {{ $member->nim }} | {{ $member->email }}</p>
<h2>Riwayat Peminjaman</h2>
@forelse($member->loans as $loan)
<p>#{{ $loan->id }} - {{ $loan->tanggal_pinjam }} sampai {{ $loan->tanggal_kembali }}</p>
@empty
<p>Belum pernah meminjam buku.</p>
@endforelse
@endsection
