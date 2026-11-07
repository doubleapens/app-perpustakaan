@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<h1>Dashboard Perpustakaan</h1>
<table>
    <tr><th>Total Buku</th><td>{{ $stats['total_buku'] ?? 0 }}</td></tr>
    <tr><th>Total Anggota</th><td>{{ $stats['total_anggota'] ?? 0 }}</td></tr>
    <tr><th>Peminjaman Aktif</th><td>{{ $stats['peminjaman_aktif'] ?? 0 }}</td></tr>
</table>
@endsection
