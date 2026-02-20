<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>
  <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
  <div class="auth-wrap">
    <div class="auth-card">
      <div class="auth-top">
        <div class="brand">
          <div class="brand-badge">R</div>
          <div>
            <h1 class="auth-title">Register</h1>
            <p class="auth-subtitle">Create your account to continue.</p>
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

        <form method="POST" action="/register">
          @csrf

          <div class="form-group">
            <label class="label">Name</label>
            <input class="input" name="name" value="{{ old('name') }}" placeholder="Your name" required>
          </div>

          <div class="form-group">
            <label class="label">Email</label>
            <input class="input" type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>
          </div>

          <div class="form-group">
            <label class="label">Password</label>
            <input class="input" type="password" name="password" placeholder="Min 6 characters" required>
          </div>

          <div class="form-group">
            <label class="label">Confirm Password</label>
            <input class="input" type="password" name="password_confirmation" placeholder="Repeat password" required>
          </div>

          <button class="btn" type="submit">Create account</button>

          <div class="divider">already have an account?</div>

          <a class="link" href="/login">Go to Login</a>
        </form>
      </div>


    </div>
  </div>
</body>
</html>