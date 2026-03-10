<?php
include "dbconnection.php";
$uname = $email = $mobile = $pass = $cpass = "";
$newuname = $newemail = $newmobile = $newpass = $newcpass = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = $_POST["uname"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $pass = $_POST["pass"];
    $cpass = $_POST["cpass"];
    
    $isValid = true;

    $sqluser = "SELECT * FROM users WHERE name='$uname'";
    $resultuser = mysqli_query($conn, $sqluser);

    if (empty($uname)) {
        $_SESSION["unameErr"] = "Username is required.";
        $isValid = false;
    } elseif (mysqli_num_rows($resultuser) > 0) {
        $_SESSION["unameErr"] = "Username already exists.";
        $isValid = false;
    } else {
        $newuname = $uname;
    }

    $sqlemail = "SELECT * FROM users WHERE email='$email'";
    $resultemail = mysqli_query($conn, $sqlemail);


    if (empty($email)) {
        $_SESSION["emailErr"] = "Email is required.";
        $isValid = false;

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["emailErr"] = "Invalid email format.";
        $isValid = false;
    } elseif (mysqli_num_rows($resultemail) > 0) {
        $_SESSION["emailErr"] = "Email already exists.";
        $isValid = false;
    } else {
        $newemail = $email;
    }

    $sqlmobile = "SELECT * FROM users WHERE phone='$mobile'";
    $resultmobile = mysqli_query($conn, $sqlmobile);


    if (empty($mobile)) {
        $_SESSION["mobileErr"] = "Phone number is required.";
        $isValid = false;
    } elseif (!preg_match("/^\d{10}$/", $mobile)) {
        $_SESSION["mobileErr"] = "Invalid phone number format. Must be 10 digits.";
        $isValid = false;
    } elseif (mysqli_num_rows($resultmobile) > 0) {
        $_SESSION["mobileErr"] = "Phone number already exists.";
        $isValid = false;
    } else {
        $newmobile = $mobile;
    }
    if (empty($pass)) {
        $_SESSION["passErr"] = "Password is required.";
        $isValid = false;
    } elseif (strlen($pass) < 6) {
        $_SESSION["passErr"] = "Password must be at least 6 characters long.";
        $isValid = false;
    } else {
        $newpass = password_hash($pass, PASSWORD_DEFAULT);
    }

    if (empty($cpass)) {
        $_SESSION["cpassErr"] = "Confirm password is required.";
        $isValid = false;
    } elseif ($cpass !== $pass) {
        $_SESSION["cpassErr"] = "Passwords do not match.";
        $isValid = false;
    } else {
        $newcpass = $cpass;
    }

    if ($isValid) {
        // echo "Validation successful. You can proceed with form submission.";
        $sql = "INSERT INTO users (name, email, phone, pass ) VALUES ('$newuname', '$newemail', '$newmobile', '$newpass')";
        if (mysqli_query($conn, $sql)) {
            // echo "New record created successfully";
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        $_SESSION["unameval"] = $uname;
        $_SESSION["emailval"] = $email;
        $_SESSION["mobileval"] = $mobile;
        $_SESSION["passval"] = $pass;
        $_SESSION["cpassval"] = $cpass;
        header("Location: signup.php");
    }

}

?>