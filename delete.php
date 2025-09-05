<?php
include 'connect.php';

if (isset($_POST['ids'])) {
    $ids = $_POST['ids'];
    $idList = implode(",", array_map('intval', $ids));

    $sql = "DELETE FROM students WHERE id IN ($idList)";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error deleting records: " . mysqli_error($conn));
    }
}

header("Location: dashboard.php");
exit();
?>
