<?php
session_start();
if (!isset($_SESSION['user'])) { header("Location: ../index.php"); exit(); }
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_number = $_POST['id_number'];
    $name      = $_POST['name'];
    $email     = $_POST['email'];
    $course    = $_POST['course'];
    $conn->query("INSERT INTO students (id_number, name, email, course) VALUES ('$id_number','$name','$email','$course')");
    header("Location: ../home.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Add Student</title>
<style>
  body { font-family: Arial, sans-serif; background: #f0f2f5; margin: 30px; }
  .card { background: white; padding: 28px 32px; border-radius: 8px; max-width: 400px; box-shadow: 0 1px 4px rgba(0,0,0,0.1); }
  h2 { margin-bottom: 20px; }
  label { font-size: 13px; color: #555; display: block; margin-bottom: 4px; }
  input { width: 100%; padding: 9px 11px; margin-bottom: 14px; border: 1px solid #d1d5db; border-radius: 5px; font-size: 14px; box-sizing: border-box; }
  input:focus { outline: none; border-color: #4a90d9; }
  .actions { display: flex; gap: 8px; margin-top: 4px; }
  .btn { padding: 9px 18px; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 14px; text-decoration: none; display: inline-block; }
  .btn-blue { background: #4a90d9; }
  .btn-blue:hover { background: #357abd; }
  .btn-gray { background: #aaa; }
  .btn-gray:hover { background: #888; }
</style>
</head>
<body>
<div class="card">
  <h2>Add Student</h2>
  <form method="POST">
    <label>ID Number</label>
    <input type="text" name="id_number" required>
    <label>Name</label>
    <input type="text" name="name" required>
    <label>Email</label>
    <input type="email" name="email" required>
    <label>Course</label>
    <input type="text" name="course" required>
    <div class="actions">
      <button type="submit" class="btn btn-blue">Add Student</button>
      <a href="../home.php" class="btn btn-gray">Cancel</a>
    </div>
  </form>
</div>
</body>
</html>