<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];  
    $sql = "DELETE FROM `students` WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error deleting record: " . mysqli_error($conn));
    } 
}

header("Location: dashboard.php");
exit();
?>
