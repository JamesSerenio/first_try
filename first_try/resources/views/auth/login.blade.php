<!doctype html>
<html>
<head><meta charset="utf-8"><title>Login</title></head>
<body>
  <h2>Login</h2>

  @if ($errors->any())
    <ul>
      @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
    </ul>
  @endif

  <form method="POST" action="/login">
    @csrf

    <label>Email</label><br>
    <input type="email" name="email" value="{{ old('email') }}" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <label>
      <input type="checkbox" name="remember" value="1"> Remember me
    </label><br><br>

    <button type="submit">Login</button>
  </form>

  <p>Wala pang account? <a href="/register">Register</a></p>
</body>
</html>