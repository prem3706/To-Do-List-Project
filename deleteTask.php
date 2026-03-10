<?php
include 'dbconnection.php';
$id = $_GET['id'];

$deleteTask = "delete from task where id = '$id'";

$url = $_SERVER['HTTP_REFERER'];
if (mysqli_query($conn, $deleteTask)) {
    $_SESSION['success'] = 'Task Deleted Successfully';
    header("Location: $url");
    exit();
} else {
    $_SESSION['error'] = "Error: " . $sql . "<br>" . mysqli_error($conn);
}
