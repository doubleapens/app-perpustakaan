@extends('layouts.app')
@section('title', 'Tambah Anggota')
@section('content')
<h1>Tambah Anggota</h1>
<form method="POST" action="{{ route('members.store') }}">
@csrf
<label>Nama<input name="nama" value="{{ old('nama') }}" required></label>@error('nama')<div>{{ $message }}</div>@enderror
<label>NIM<input name="nim" value="{{ old('nim') }}" required></label>@error('nim')<div>{{ $message }}</div>@enderror
<label>Email<input type="email" name="email" value="{{ old('email') }}" required></label>@error('email')<div>{{ $message }}</div>@enderror
<label>Nomor Telepon<input name="nomor_telepon" value="{{ old('nomor_telepon') }}" required></label>
<label>Alamat<textarea name="alamat" required>{{ old('alamat') }}</textarea></label>
<label>Status<select name="status"><option value="aktif">Aktif</option><option value="nonaktif">Nonaktif</option></select></label>
<button class="btn" type="submit">Simpan</button>
</form>
@endsection
