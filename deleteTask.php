<?php
include 'dbconnection.php';
$id = $_GET['id'];

$deleteTask = "delete from task where id = '$id'";

if (mysqli_query($conn, $deleteTask)) {
    header("Location: dashboard.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>