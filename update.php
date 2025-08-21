<?php
// 1. Connect to database
$conn = mysqli_connect("localhost", "root", "", "job_demo");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// 2. When form is submitted (POST request)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id       = $_POST['id'];
    $name     = $_POST['name'];
    $number   = $_POST['phno'];
    $class    = $_POST['class'];
    $gender   = $_POST['gender'];

    // Subjects may be many, so join them with comma
    $subjects = "";
    if (!empty($_POST['subjects'])) {
        $subjects = implode(", ", $_POST['subjects']);
    }

    // 3. Update the record in database
    $sql = "UPDATE students 
            SET name='$name', number='$number', class='$class', sex='$gender', subjects='$subjects' 
            WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        // 4. After update, go back to dashboard
        header("Location: dashboard.php?msg=Updated Successfully");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// 5. Load student details to show in the form
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM students WHERE id=$id");
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Student</title>
</head>
<body>
<h2>Update Student</h2>

<form method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

    Name: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>

    Phone: <input type="text" name="phno" value="<?php echo $row['number']; ?>"><br><br>

    Class: 
    <select name="class">
        <option value="8" <?php if($row['class']==8) echo "selected"; ?>>8</option>
        <option value="9" <?php if($row['class']==9) echo "selected"; ?>>9</option>
        <option value="10" <?php if($row['class']==10) echo "selected"; ?>>10</option>
    </select><br><br>

    Gender: 
    <input type="radio" name="gender" value="Male"   <?php if($row['sex']=="Male") echo "checked"; ?>> Male
    <input type="radio" name="gender" value="Female" <?php if($row['sex']=="Female") echo "checked"; ?>> Female
    <input type="radio" name="gender" value="Other"  <?php if($row['sex']=="Other") echo "checked"; ?>> Other
    <br><br>

    Subjects: 
    <input type="checkbox" name="subjects[]" value="Maths"   <?php if(strpos($row['subjects'], "Maths")!==false) echo "checked"; ?>> Maths
    <input type="checkbox" name="subjects[]" value="Science" <?php if(strpos($row['subjects'], "Science")!==false) echo "checked"; ?>> Science
    <input type="checkbox" name="subjects[]" value="English" <?php if(strpos($row['subjects'], "English")!==false) echo "checked"; ?>> English
    <input type="checkbox" name="subjects[]" value="History" <?php if(strpos($row['subjects'], "History")!==false) echo "checked"; ?>> History
    <br><br>

    <button type="submit">Update</button>
</form>

</body>
</html>
