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
  body { font-family: Arial, sans-serif; background: #f0f2f5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
  .card { background: white; padding: 36px 32px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); width: 100%; max-width: 360px; }
  h2 { margin-bottom: 6px; font-size: 1.4rem; }
  p { color: #888; font-size: 13px; margin-bottom: 20px; }
  label { font-size: 13px; color: #555; display: block; margin-bottom: 4px; }
  input { width: 100%; padding: 9px 11px; margin-bottom: 14px; border: 1px solid #d1d5db; border-radius: 5px; font-size: 14px; box-sizing: border-box; }
  input:focus { outline: none; border-color: #4a90d9; }
  .btn { width: 100%; padding: 10px; background: #4a90d9; color: white; border: none; border-radius: 5px; font-size: 14px; cursor: pointer; }
  .btn:hover { background: #357abd; }
  .error { background: #fee2e2; border: 1px solid #fca5a5; color: #b91c1c; border-radius: 5px; padding: 9px 12px; font-size: 13px; margin-bottom: 14px; }
  .hint { color: #aaa; font-size: 12px; margin-top: 14px; text-align: center; }
</style>
</head>
<body>
<div class="card">
  <h2>Welcome to Student Management System</h2>
  <p>Enter your Credentials to Login!</p>
  <style>
    h2, p {text-align: center;}
  </style>

  <?php if ($error): ?>
    <div class="error"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="POST" action="index.php">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" placeholder="Enter username" required>
    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Enter password" required>
    <button type="submit" class="btn">Login</button>
  </form>
  <p class="hint">Default: admin / admin123</p>
</div>
</body>
</html>