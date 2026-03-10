<?php
include "dbconnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $isValid = true;

    if (empty($email)) {
        $_SESSION["emailErr"] = "Username is required.";
        $isValid = false;
    } else {
        $newemail = $email;
    }
    if (empty($pass)) {
        $_SESSION["passErr"] = "Password is required.";
        $isValid = false;
    } else {
        $newpass = password_hash($pass, PASSWORD_DEFAULT);
    }

    if ($isValid) {
        // echo "Validation successful. You can proceed with form submission.";
        $sql = "SELECT * FROM users WHERE email='$newemail'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {

            if ($row = mysqli_fetch_assoc($result)) {
                if (password_verify($pass, $row["pass"])) {
                    $_SESSION["is_login"] = true;
                    $_SESSION["u_id"]= $row["id"];
                    header("Location: dashboard.php");
                } else {
                    $_SESSION["passErr"] = "Invalid password.";
                    $_SESSION["passval"] = $pass;
                    $_SESSION["emailval"] = $email;

                    header("Location: login.php");
                    exit();
                }
            }
        } else {
            $_SESSION["emailErr"] = "Invalid Email.";
            //    $_SESSION["passErr"] = "Invalid password.";

            $_SESSION["emailval"] = $email;
                    $_SESSION["passval"] = $pass;

            //    $_SESSION["passval"]= $newpass;
            header("Location: login.php");
            exit();
        }
    }
}

?>