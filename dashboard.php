<?php
include 'connect.php';   

$sql = "SELECT * FROM students";
$result = mysqli_query($conn, $sql);

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

  <form method="post" action="delete.php">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th><input type="checkbox" id="select_all"></th>
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
                    <td><input type='checkbox' name='ids[]' value='{$row['id']}'></td>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['number']}</td>
                    <td>{$row['class']}</td>
                    <td>{$row['sex']}</td>
                    <td>{$row['subjects']}</td>
                    <td>
                      <a href='update.php?id={$row['id']}' class='btn btn-primary btn-sm'>Update</a>
                      <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
                    </td>
                  </tr>";
        }
        ?>
      </tbody>
    </table>
    <button type="submit" class="btn btn-danger" onclick="return confirm('Delete selected records?')">Delete Selected</button>
  </form>
</div>

<script>
  // Select/Deselect all checkboxes
  document.getElementById('select_all').onclick = function() {
      var checkboxes = document.getElementsByName('ids[]');
      for (var checkbox of checkboxes) {
          checkbox.checked = this.checked;
      }
  }
</script>
</body>
</html>
