<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f7f9fb;
            padding: 40px
        }

        .card {
            max-width: 420px;
            margin: 0 auto;
            background: #fff;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, .06)
        }

        label {
            display: block;
            margin-top: 12px
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #e6eae8;
            border-radius: 6px
        }

        button {
            background: #10b981;
            color: #fff;
            padding: 10px 14px;
            border: none;
            border-radius: 6px;
            margin-top: 14px;
            width: 100%
        }
    </style>
</head>

<body>
    <div class="card">
        <h2>Login</h2>
        @if($errors->any())
            <div style="color:#c53030">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('login.attempt') }}">
            @csrf
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus>

            <label for="password">Password</label>
            <input id="password" name="password" type="password" required>

            <label style="margin-top:8px"><input type="checkbox" name="remember"> Ingat saya</label>

            <button type="submit">Masuk</button>
        </form>
    </div>
</body>

</html>