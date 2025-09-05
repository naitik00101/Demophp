<?php
$conn = mysqli_connect("localhost", "root", "", "job_demo" , "3300");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id       = $_POST['id'];
    $name     = $_POST['name'];
    $number   = $_POST['phno'];
    $class    = $_POST['class'];
    $gender   = $_POST['gender'];

    $subjects = "";
    if (!empty($_POST['subjects'])) {
        $subjects = implode(", ", $_POST['subjects']);
    }

    $sql = "UPDATE students 
            SET name='$name', number='$number', class='$class', sex='$gender', subjects='$subjects' 
            WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: dashboard.php?msg=Updated Successfully");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM students WHERE id=$id");
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Update Student</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow p-4">
    <h2 class="mb-4 text-center">Update Student</h2>

    <form method="post">
      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

      <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>">
      </div>

      <div class="mb-3">
        <label class="form-label">Phone</label>
        <input type="text" class="form-control" name="phno" value="<?php echo $row['number']; ?>">
      </div>

      <div class="mb-3">
        <label class="form-label">Class</label>
        <select class="form-select" name="class">
          <option value="8" <?php if($row['class']==8) echo "selected"; ?>>8</option>
          <option value="9" <?php if($row['class']==9) echo "selected"; ?>>9</option>
          <option value="10" <?php if($row['class']==10) echo "selected"; ?>>10</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Gender</label><br>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="gender" value="Male" <?php if($row['sex']=="Male") echo "checked"; ?>>
          <label class="form-check-label">Male</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="gender" value="Female" <?php if($row['sex']=="Female") echo "checked"; ?>>
          <label class="form-check-label">Female</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="gender" value="Other" <?php if($row['sex']=="Other") echo "checked"; ?>>
          <label class="form-check-label">Other</label>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Subjects</label><br>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="subjects[]" value="Maths" <?php if(strpos($row['subjects'], "Maths")!==false) echo "checked"; ?>>
          <label class="form-check-label">Maths</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="subjects[]" value="Science" <?php if(strpos($row['subjects'], "Science")!==false) echo "checked"; ?>>
          <label class="form-check-label">Science</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="subjects[]" value="English" <?php if(strpos($row['subjects'], "English")!==false) echo "checked"; ?>>
          <label class="form-check-label">English</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="subjects[]" value="History" <?php if(strpos($row['subjects'], "History")!==false) echo "checked"; ?>>
          <label class="form-check-label">History</label>
        </div>
      </div>

      <button type="submit" class="btn btn-success w-100">Update</button>
    </form>
  </div>
</div>

</body>
</html>
