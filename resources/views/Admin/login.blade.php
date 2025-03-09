<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <h1>Admin Login</h1>

    <form action="{{ route('admin.login') }}" method="POST">
        @csrf

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>
<label for="remember">
            <input type="checkbox" name="remember" id="remember"> Remember Me
        </label><br><br>

        <button type="submit">Login</button>
    </form>
@if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>