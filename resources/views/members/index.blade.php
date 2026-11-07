@extends('layouts.app')

@section('title', 'Daftar Anggota')

@section('content')
<h1>Daftar Anggota</h1>
<a class="btn" href="{{ route('members.create') }}">Tambah Anggota</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Email</th>
            <th>No. Telepon</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($members as $member)
        <tr>
            <td>{{ $member->id }}</td>
            <td><a href="{{ route('members.show', $member) }}">{{ $member->nama }}</a></td>
            <td>{{ $member->nim }}</td>
            <td>{{ $member->email }}</td>
            <td>{{ $member->nomor_telepon }}</td>
            <td>{{ ucfirst($member->status) }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="6">Belum ada data anggota.</td>
        </tr>
        @endforelse
    </tbody>
</table>
{{ $members->links() }}
@endsection