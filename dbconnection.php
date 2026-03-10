<?php
$conn = mysqli_connect("localhost", "root", "password", "todotask");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();
?>