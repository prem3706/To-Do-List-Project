<?php
include "dbconnection.php";

if (isset($_SESSION["is_login"]) && $_SESSION["is_login"] === true) {
    header("Location: dashboard.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup TO-DO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        body {
            background-color: #EAEFEF;

        }

        .card {
            background-color: #25343F;
        }

        .text-white {
            color: #FFFFFF;
        }

        .form-control {
            font-size: small;
        }

        span {
            font-size: small;
        }
    </style>
</head>


<body>
    <div class="container-fluid" style="background-color: #EAEFEF;">
        <div class="row p-3 d-flex align-items-center justify-content-center" style="height: 100vh;">
            <div class="col-xl-4 col-md-6  card shadow p-4 mb-5 rounded-4" style="background-color: #25343F;">
                <h2 class=" text-center text-white mb-1">Login</h2>
                <form action="login-val.php" method="post" id="loginForm">

                    <div class="form-group my-1 col-md-12">
                        <label for="email" class="text-white">Email :</label>
                        <input type="email" class="form-control text-small" name="email" id="email"
                             placeholder="Enter Your Email"
                            value="<?php echo isset($_SESSION["emailval"]) && $_SESSION["emailval"] != null ? $_SESSION["emailval"] : $_SESSION["emailval"] = ""; ?>">
                        <span class="m-1 " style="color: red;" id="emailErr">
                            <?php echo isset($_SESSION["emailErr"]) && $_SESSION["emailErr"] != null ? $_SESSION["emailErr"] : $_SESSION["emailErr"] = ""; ?>
                        </span>
                    </div>


                    <div class="form-group mb-1 col-md-12">
                        <label for="pass" class="text-white">Password :</label>
                        <input type="password" class="form-control" name="pass" id="pass"
                            placeholder="Enter Your Password"
                            value="<?php echo isset($_SESSION["passval"]) && $_SESSION["passval"] != null ? $_SESSION["passval"] : $_SESSION["passval"] = ""; ?>">
                        <span class="mx-1 " style="color: red;" id="passErr">
                            <?php echo isset($_SESSION["passErr"]) && $_SESSION["passErr"] != null ? $_SESSION["passErr"] : $_SESSION["passErr"] = ""; ?>
                        </span>
                    </div>
                    <span class="text-center mb-2 small text-white">Don't have an account? <a href="signup.php">Signup
                            here</a></span>
                    <button type="submit" class="btn btn-secondary w-100 mt-3">Submit</button>
                </form>
            </div>
            <?php
            unset($_SESSION["emailErr"]);
            unset($_SESSION["passErr"]);
            unset($_SESSION["emailval"]);
            unset($_SESSION["passval"]);

            ?>


        </div>
    </div>
    </div>
    <script>
        var isValid = true;
        document.getElementById("email").addEventListener("change", function () {
            var email = document.getElementById("email").value;
            if (email.trim() === "") {
                document.getElementById("emailErr").textContent = "Email is required.";
                isValid = false;
            }
            else {
                document.getElementById("emailErr").textContent = "";
            }
        });
        document.getElementById("pass").addEventListener("change", function () {
            var pass = document.getElementById("pass").value;
            if (pass.trim() === "") {
                document.getElementById("passErr").textContent = "Password is required.";
                isValid = false;
            } else {
                document.getElementById("passErr").textContent = "";
            }
        });
        document.getElementById("loginForm").addEventListener("submit", function (event) {

            isValid = true;
            if (document.getElementById("email").value.trim() === "") {
                document.getElementById("emailErr").textContent = "Email is required.";
                isValid = false;
            } 
            if (document.getElementById("pass").value.trim() === "") {
                document.getElementById("passErr").textContent = "Password is required.";
                isValid = false;
            }
            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>

</body>

</html>