@extends('layouts.app')
@section('title', 'Edit Anggota')
@section('content')
<h1>Edit Anggota</h1>
<form method="POST" action="{{ route('members.update', $member) }}">@csrf @method('PUT')
<label>Nama<input name="nama" value="{{ old('nama', $member->nama) }}" required></label>
<label>NIM<input name="nim" value="{{ old('nim', $member->nim) }}" required></label>
<label>Email<input type="email" name="email" value="{{ old('email', $member->email) }}" required></label>
<label>Nomor Telepon<input name="nomor_telepon" value="{{ old('nomor_telepon', $member->nomor_telepon) }}" required></label>
<label>Alamat<textarea name="alamat" required>{{ old('alamat', $member->alamat) }}</textarea></label>
<label>Status<select name="status"><option value="aktif" @selected($member->status === 'aktif')>Aktif</option><option value="nonaktif" @selected($member->status === 'nonaktif')>Nonaktif</option></select></label>
<button class="btn" type="submit">Simpan</button>
</form>
@endsection
