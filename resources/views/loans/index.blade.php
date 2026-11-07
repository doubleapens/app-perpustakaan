@extends('layouts.app')
@section('title', 'Peminjaman')
@section('content')
<h1>Peminjaman</h1>
<a class="btn" href="{{ route('loans.create') }}">Tambah Peminjaman</a>
<table><thead><tr><th>ID</th><th>Anggota</th><th>Petugas</th><th>Status</th><th>Aksi</th></tr></thead><tbody>
@forelse($loans as $loan)
<tr><td>{{ $loan->id }}</td><td>{{ $loan->member?->nama }}</td><td>{{ $loan->user?->name }}</td><td>{{ $loan->status }}</td><td><a href="{{ route('loans.show', $loan) }}">Detail</a>@if($loan->status !== 'dikembalikan') <form class="inline" method="POST" action="{{ route('loans.kembalikan', $loan->id) }}">@csrf @method('PUT')<button class="btn" type="submit">Kembalikan</button></form>@endif</td></tr>
@empty<tr><td colspan="5">Belum ada peminjaman.</td></tr>@endforelse
</tbody></table>
{{ $loans->links() }}
@endsection
