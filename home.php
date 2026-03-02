<?php
session_start();
if (!isset($_SESSION['user'])) { header("Location: login.php"); exit(); }
require 'db.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM students WHERE id=$id");
    header("Location: home.php");
    exit();
}

$result = $conn->query("SELECT * FROM students");
?>
<!DOCTYPE html>
<html>
<head>
<title>Student Records</title>
<style>
  body { font-family: Arial, sans-serif; margin: 30px; }
  h2 { margin-bottom: 10px; }
  a.btn { padding: 7px 14px; background: #4a90d9; color: white; text-decoration: none; border-radius: 4px; font-size: 13px; }
  a.del { background: #e74c3c; }
  a.edit { background: #f39c12; }
  table { width: 100%; border-collapse: collapse; margin-top: 15px; }
  th, td { padding: 10px; border: 1px solid #ddd; text-align: left; font-size: 14px; }
  th { background: #4a90d9; color: white; }
  tr:nth-child(even) { background: #f9f9f9; }
  .top { display: flex; justify-content: space-between; align-items: center; }
</style>
</head>
<body>
<div class="top">
  <h2>Student Records</h2>
  <a href="create_student.php" class="btn">+ Add Student</a>
</div>

<table>
  <tr>
    <th>ID Number</th>
    <th>Name</th>
    <th>Email</th>
    <th>Course</th>
    <th>Action</th>
  </tr>
  <?php while ($row = $result->fetch_assoc()): ?>
  <tr>
    <td><?= $row['id_number'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['course'] ?></td>
    <td>
      <a href="edit_student.php?id=<?= $row['id'] ?>" class="btn edit">Edit</a>
      <a href="home.php?delete=<?= $row['id'] ?>" class="btn del" onclick="return confirm('Delete this student?')">Delete</a>
    </td>
  </tr>
  <?php endwhile; ?>
</table>
</body>
</html>