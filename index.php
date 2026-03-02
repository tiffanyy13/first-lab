<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: home.php");
    exit();
}

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['user'] = $username;
        header("Location: home.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login | Student Management System</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;700;800&family=DM+Sans:wght@300;400;500&display=swap');
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  :root {
    --bg: #0d0f14;
    --card: #161a22;
    --accent: #4f8ef7;
    --accent2: #a78bfa;
    --text: #e8eaf0;
    --muted: #6b7280;
    --border: #252a36;
    --error: #f87171;
  }
  body {
    font-family: 'DM Sans', sans-serif;
    background: var(--bg);
    color: var(--text);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
  }
  body::before {
    content: '';
    position: fixed;
    top: -30%;
    left: -10%;
    width: 600px; height: 600px;
    background: radial-gradient(circle, rgba(79,142,247,0.12) 0%, transparent 70%);
    pointer-events: none;
  }
  body::after {
    content: '';
    position: fixed;
    bottom: -20%;
    right: -10%;
    width: 500px; height: 500px;
    background: radial-gradient(circle, rgba(167,139,250,0.1) 0%, transparent 70%);
    pointer-events: none;
  }
  .card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 48px 42px;
    width: 100%;
    max-width: 420px;
    box-shadow: 0 25px 60px rgba(0,0,0,0.4);
    position: relative;
    z-index: 1;
    animation: fadeUp 0.5s ease both;
  }
  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(24px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  .logo {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 28px;
  }
  .logo-icon {
    width: 42px; height: 42px;
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 22px;
  }
  h1 {
    font-family: 'Syne', sans-serif;
    font-size: 1.1rem;
    font-weight: 700;
    line-height: 1.2;
  }
  h1 span { color: var(--muted); font-weight: 400; font-size: .85rem; display: block; margin-top: 2px; }
  .headline {
    font-family: 'Syne', sans-serif;
    font-size: 1.6rem;
    font-weight: 800;
    margin-bottom: 6px;
  }
  .sub { color: var(--muted); font-size: .9rem; margin-bottom: 28px; }
  label { font-size: .82rem; color: var(--muted); display: block; margin-bottom: 6px; }
  input[type=text], input[type=password] {
    width: 100%;
    background: #1e2330;
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 12px 14px;
    color: var(--text);
    font-family: 'DM Sans', sans-serif;
    font-size: .95rem;
    margin-bottom: 18px;
    transition: border-color .2s;
    outline: none;
  }
  input:focus { border-color: var(--accent); }
  .btn {
    width: 100%;
    padding: 13px;
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    border: none;
    border-radius: 10px;
    color: #fff;
    font-family: 'Syne', sans-serif;
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    transition: opacity .2s, transform .1s;
  }
  .btn:hover { opacity: .88; }
  .btn:active { transform: scale(.98); }
  .error {
    background: rgba(248,113,113,.12);
    border: 1px solid rgba(248,113,113,.3);
    color: var(--error);
    border-radius: 8px;
    padding: 10px 14px;
    font-size: .85rem;
    margin-bottom: 16px;
  }
  .hint { color: var(--muted); font-size: .78rem; margin-top: 18px; text-align: center; }
</style>
</head>
<body>
<div class="card">
  <div class="logo">
    <div class="logo-icon">🎓</div>
    <h1>SMS <span>Student Management System</span></h1>
  </div>
  <div class="headline">Welcome Back</div>
  <p class="sub">Enter your credentials to login!</p>

  <?php if ($error): ?>
    <div class="error">⚠️ <?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="POST" action="index.php">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" placeholder="Enter username" required autocomplete="username">
    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Enter password" required autocomplete="current-password">
    <button type="submit" class="btn">Login →</button>
  </form>
  <p class="hint">Default: admin / admin123</p>
</div>
</body>
</html>