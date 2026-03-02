<?php
session_start();
if (!isset($_SESSION['user'])) { header("Location: login.php"); exit(); }
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_number = $_POST['id_number'];
    $name      = $_POST['name'];
    $email     = $_POST['email'];
    $course    = $_POST['course'];
    $conn->query("INSERT INTO students (id_number, name, email, course) VALUES ('$id_number','$name','$email','$course')");
    header("Location: home.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Create Student Record</title>
<style>
  body { font-family: Arial, sans-serif; margin: 30px; }
  h2 { margin-bottom: 15px; }
  label { font-size: 14px; display: block; margin-bottom: 4px; }
  input { width: 300px; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 4px; }
  .btn { padding: 8px 16px; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; text-decoration: none; }
  .btn-blue { background: #4a90d9; }
  .btn-gray { background: #aaa; }
</style>
</head>
<body>
<h2>Create Student Record</h2>
<form method="POST">
  <label>ID Number</label>
  <input type="text" name="id_number" required><br>
  <label>Name</label>
  <input type="text" name="name" required><br>
  <label>Email</label>
  <input type="email" name="email" required><br>
  <label>Course</label>
  <input type="text" name="course" required><br>
  <button type="submit" class="btn btn-blue">Add Student</button>
  <a href="home.php" class="btn btn-gray">Cancel</a>
</form>
</body>
</html>