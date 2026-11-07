<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Perpustakaan</title>
    <style>
        body { margin: 0; min-height: 100vh; display: grid; place-items: center; font-family: sans-serif; background: #eef2f7; color: #172033; }
        form { width: min(360px, calc(100% - 32px)); padding: 28px; background: #fff; border: 1px solid #d8dee9; }
        h1 { margin-top: 0; font-size: 24px; }
        label { display: block; margin-top: 16px; font-weight: 600; }
        input { width: 100%; padding: 10px; border: 1px solid #9ca3af; margin-top: 6px; box-sizing: border-box; }
        button { width: 100%; margin-top: 20px; padding: 10px; border: 0; background: #155eef; color: white; cursor: pointer; }
        .error { color: #b42318; font-size: 14px; }
    </style>
</head>
<body>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <h1>Perpustakaan Digital</h1>
        @include('partials.alert')
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required>
        @error('email') <div class="error">{{ $message }}</div> @enderror
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>
        @error('password') <div class="error">{{ $message }}</div> @enderror
        <button type="submit">Masuk</button>
    </form>
</body>
</html>
