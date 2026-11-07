@extends('layouts.app')
@section('title', 'Laporan Peminjaman')
@section('content')
<h1>Laporan Peminjaman</h1>
@forelse($loans as $loan)
<p>#{{ $loan['id'] }} - {{ $loan['member']['nama'] ?? '-' }} ({{ $loan['status'] }})</p>
@empty
<p>Data laporan belum tersedia. Pastikan server API internal berjalan.</p>
@endforelse
@endsection
