<?php
include 'connect.php';

if (isset($_POST['submit'])) {
    $name     = $_POST['name'];
    $number   = $_POST['phno'];
    $class    = $_POST['class'];
    $sex      = $_POST['gender'];
    $subjects = $_POST['subjects'];
  if (is_array($subjects)) {
    $subjects = implode(', ', $subjects);
  }

    $sql = "INSERT INTO `students` (name,number,class,sex,subjects) 
            VALUES ('$name', '$number', '$class', '$sex', '$subjects')";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error: " . mysqli_error($conn));
    }
       header("Location: dashboard.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Registration Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" 
        rel="stylesheet">
</head>
<body class="container mt-4">

  <h1 class="mb-4">Student Registration Form</h1>
  
  <form method="post" >
    
    <!-- Student Name -->
    <div class="mb-3">
      <label for="studentName" class="form-label">Student Name</label>
      <input type="text" class="form-control" name="name" id="studentName" placeholder="Enter name" required>
    </div>

    <!-- Student Number -->
    <div class="mb-3">
      <label for="studentNumber" class="form-label">Student Number</label>
      <input type="number" class="form-control" name="phno" id="studentNumber" placeholder="Enter number" required>
    </div>

    <!-- Class Dropdown -->
    <div class="mb-3">
      <label for="studentClass" class="form-label">Class</label>
      <select name="class" class="form-select" id="studentClass" required>
        <option selected disabled>Select Class</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
      </select>
    </div>

    <!-- Gender -->
    <div class="mb-3">
      <label class="form-label">Gender</label><br>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" id="male" value="Male" required>
        <label class="form-check-label" for="male">Male</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
        <label class="form-check-label" for="female">Female</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" id="other" value="Other">
        <label class="form-check-label" for="other">Other</label>
      </div>
    </div>

    <!-- Subjects -->
    <div class="mb-3">
      <label class="form-label">Subjects</label><br>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="subjects[]" id="maths" value="Maths">
        <label class="form-check-label" for="maths">Maths</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="subjects[]" id="science" value="Science">
        <label class="form-check-label" for="science">Science</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="subjects[]" id="english" value="English">
        <label class="form-check-label" for="english">English</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="subjects[]" id="history" value="History">
        <label class="form-check-label" for="history">History</label>
      </div>
    </div>

    <!-- Submit -->
    <button type="submit" name="submit"  class="btn btn-primary">Submit</button>
  </form>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
