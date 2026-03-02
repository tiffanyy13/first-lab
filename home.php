<?php
session_start();
if (!isset($_SESSION['user'])) { header("Location: index.php"); exit(); }
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
<meta charset="UTF-8">
<title>Student Records</title>
<style>
  body { font-family: Arial, sans-serif; margin: 30px; background: #f0f2f5; }
  .top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
  h2 { margin: 0; }
  a.btn { padding: 8px 14px; background: #4a90d9; color: white; text-decoration: none; border-radius: 5px; font-size: 13px; }
  a.btn:hover { background: #357abd; }
  a.del { background: #e74c3c; }
  a.del:hover { background: #c0392b; }
  a.edit { background: #f39c12; }
  a.edit:hover { background: #d68910; }
  a.logout { background: #888; }
  a.logout:hover { background: #666; }
  table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 1px 4px rgba(0,0,0,0.1); }
  th, td { padding: 11px 14px; border-bottom: 1px solid #e5e7eb; text-align: left; font-size: 14px; }
  th { background: #4a90d9; color: white; }
  tr:last-child td { border-bottom: none; }
  tr:hover td { background: #f9fafb; }
  .actions { display: flex; gap: 6px; }
</style>
</head>
<body>
<div class="top">
  <h2>Student Records</h2>
  <div class="actions">
    <a href="pages/create_student.php" class="btn">+ Add Student</a>
    <a href="logout.php" class="btn logout">Logout</a>
  </div>
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
    <td><?= htmlspecialchars($row['id_number']) ?></td>
    <td><?= htmlspecialchars($row['name']) ?></td>
    <td><?= htmlspecialchars($row['email']) ?></td>
    <td><?= htmlspecialchars($row['course']) ?></td>
    <td class="actions">
      <a href="pages/edit_student.php?id=<?= $row['id'] ?>" class="btn edit">Edit</a>
      <a href="home.php?delete=<?= $row['id'] ?>" class="btn del" onclick="return confirm('Delete this student?')">Delete</a>
    </td>
  </tr>
  <?php endwhile; ?>
</table>
</body>
</html>