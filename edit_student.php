<?php
session_start();
if (!isset($_SESSION['user'])) { header("Location: index.php"); exit(); }
require 'db.php';

$id  = $_GET['id'];
$row = $conn->query("SELECT * FROM students WHERE id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_number = $_POST['id_number'];
    $name      = $_POST['name'];
    $email     = $_POST['email'];
    $course    = $_POST['course'];
    $conn->query("UPDATE students SET id_number='$id_number', name='$name', email='$email', course='$course' WHERE id=$id");
    header("Location: home.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Student Record</title>
<style>
  body { font-family: Arial, sans-serif; margin: 30px; }
  h2 { margin-bottom: 15px; }
  label { font-size: 14px; display: block; margin-bottom: 4px; }
  input { width: 300px; padding: 8px; margin-bottom: 12px; border: 1px solid #ccc; border-radius: 4px; }
  .btn { padding: 8px 16px; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; }
  .btn-blue { background: #4a90d9; }
</style>
</head>
<body>
<h2>Edit Student Record</h2>
<form method="POST">
  <label>ID Number</label>
  <input type="text" name="id_number" value="<?= $row['id_number'] ?>" required><br>
  <label>Name</label>
  <input type="text" name="name" value="<?= $row['name'] ?>" required><br>
  <label>Email</label>
  <input type="email" name="email" value="<?= $row['email'] ?>" required><br>
  <label>Course</label>
  <input type="text" name="course" value="<?= $row['course'] ?>" required><br>
  <button type="submit" class="btn btn-blue">Save</button>
</form>
</body>
</html>