<!doctype html>
<html>
<head><meta charset="utf-8"><title>Dashboard</title></head>
<body>
  <h2>Welcome, {{ auth()->user()->name }}</h2>

  <form method="POST" action="/logout">
    @csrf
    <button type="submit">Logout</button>
  </form>
</body>
</html>