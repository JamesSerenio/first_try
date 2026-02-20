<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
  <div class="auth-wrap">
    <div class="auth-card">
      <div class="auth-top">
        <div class="brand">
          <div class="brand-badge">L</div>
          <div>
            <h1 class="auth-title">Login</h1>
            <p class="auth-subtitle">Sign in using your email and password.</p>
          </div>
        </div>
      </div>

      <div class="auth-body">
        @if ($errors->any())
          <div class="alert">
            <ul>
              @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="/login">
          @csrf

          <div class="form-group">
            <label class="label">Email</label>
            <input class="input" type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>
          </div>

          <div class="form-group">
            <label class="label">Password</label>
            <input class="input" type="password" name="password" placeholder="••••••••" required>
          </div>

          <div class="row">
            <label class="check">
              <input type="checkbox" name="remember" value="1">
              Remember me
            </label>
            <a class="link" href="/register">Create account</a>
          </div>

          <button class="btn" type="submit">Login</button>

          <div class="divider">or</div>

          <a class="link" href="/register">Go to Register</a>
        </form>
      </div>

    </div>
  </div>
</body>
</html>