<?php
include 'connect.php';   // connect to database

// Run the query
$sql = "SELECT * FROM students";
$result = mysqli_query($conn, $sql);

// Check for query error
if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
      <button class="btn btn-primary my-5">
        <a class="text-light text-decoration-none" href="student.php">Add Student</a>
      </button>

      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>id</th>
            <th>name</th>
            <th>Ph. Number</th>
            <th>class</th>
            <th>Gender</th>
            <th>subject</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          while($row = mysqli_fetch_assoc($result)) { 
              echo "<tr>
                      <td>{$row['id']}</td>
                      <td>{$row['name']}</td>
                      <td>{$row['number']}</td>
                      <td>{$row['class']}</td>
                      <td>{$row['sex']}</td>
                      <td>{$row['subjects']}</td>
                      <td>
                        <a href='update.php?id={$row['id']}' class='btn btn-primary btn-sm'>Update</a>
                        <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Delete this record?\")'>Delete</a>
                      </td>
                    </tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
</body>
</html>
