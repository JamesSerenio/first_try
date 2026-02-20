<!doctype html>
<html>
<head><meta charset="utf-8"><title>Register</title></head>
<body>
  <h2>Register</h2>

  @if ($errors->any())
    <ul>
      @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
    </ul>
  @endif

  <form method="POST" action="/register">
    @csrf

    <label>Name</label><br>
    <input name="name" value="{{ old('name') }}" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" value="{{ old('email') }}" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <label>Confirm Password</label><br>
    <input type="password" name="password_confirmation" required><br><br>

    <button type="submit">Create account</button>
  </form>

  <p>May account na? <a href="/login">Login</a></p>
</body>
</html>