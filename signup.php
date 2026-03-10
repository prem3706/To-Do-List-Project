<?php
include "dbconnection.php";

if(isset($_SESSION["is_login"]) && $_SESSION["is_login"] === true) {
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
            <div class="col-md-4  card shadow p-4 mb-5 rounded-4" style="background-color: #25343F;">
                <h2 class=" text-center text-white mb-1">Signup</h2>
                <form action="sign-val.php" method="post" id="signinForm">
                    <div class="form-group my-1 col-md-12">
                        <label for="uname" class="text-white">Name :</label>
                        <input type="text" class="form-control small" name="uname" id="uname"
                            placeholder="Enter Your Name" value="<?php echo isset($_SESSION["unameval"]) && $_SESSION["unameval"] != null ? $_SESSION["unameval"] : $_SESSION["unameval"] = ""; ?>">
                        <span class="m-1 " style="height: 20px; color: red;" id="unameErr">
                            <?php echo isset($_SESSION["unameErr"]) && $_SESSION["unameErr"] != null ? $_SESSION["unameErr"] : $_SESSION["unameErr"] = ""; ?>
                        </span>
                    </div>
                    <div class="form-group my-1 col-md-12">
                        <label for="email" class="text-white">Email :</label>
                        <input type="email" class="form-control text-small" name="email" id="email"
                            aria-describedby="emailHelp" placeholder="Enter Your Email"
                            value="<?php echo isset($_SESSION["emailval"]) && $_SESSION["emailval"] != null ? $_SESSION["emailval"] : $_SESSION["emailval"] = ""; ?>">
                        <span class="m-1 " style="color: red;" id="emailErr">
                            <?php echo isset($_SESSION["emailErr"]) && $_SESSION["emailErr"] != null ? $_SESSION["emailErr"] : $_SESSION["emailErr"] = ""; ?>
                        </span>
                    </div>
                    <div class="form-group my-1 col-md-12">
                        <label for="mobile" class="text-white">Phone Number :</label>
                        <input type="number" class="form-control" name="mobile" id="mobile" aria-describedby="emailHelp"
                            placeholder="Enter Your Phone Number"
                            value="<?php echo isset($_SESSION["mobileval"]) && $_SESSION["mobileval"] != null ? $_SESSION["mobileval"] : $_SESSION["mobileval"] = ""; ?>">
                        <span class="m-1 " style="color: red;" id="mobileErr">
                            <?php echo isset($_SESSION["mobileErr"]) && $_SESSION["mobileErr"] != null ? $_SESSION["mobileErr"] : $_SESSION["mobileErr"] = ""; ?>
                        </span>
                    </div>
                    <div class="row">
                        <div class="form-group mb-1 col-md-6">
                            <label for="pass" class="text-white">Password :</label>
                            <input type="password" class="form-control" name="pass" id="pass"
                                placeholder="Enter Your Password"
                                value="<?php echo isset($_SESSION["passval"]) && $_SESSION["passval"] != null ? $_SESSION["passval"] : $_SESSION["passval"] = ""; ?>">
                            <span class="mx-1 " style="color: red;" id="passErr">
                                <?php echo isset($_SESSION["passErr"]) && $_SESSION["passErr"] != null ? $_SESSION["passErr"] : $_SESSION["passErr"] = ""; ?>
                            </span>
                        </div>
                        <div class="form-group mb-1 col-md-6">
                            <label for="cpass" class="text-white">Confirm Password:</label>
                            <input type="password" class="form-control " name="cpass" id="cpass"
                                placeholder="Confirm Your Password"
                                value="<?php echo isset($_SESSION["cpassval"]) && $_SESSION["cpassval"] != null ? $_SESSION["cpassval"] : $_SESSION["cpassval"] = ""; ?>">
                            <span class="mx-1 font-wrap" style="color: red;" id="cpassErr">
                                <?php echo isset($_SESSION["cpassErr"]) && $_SESSION["cpassErr"] != null ? $_SESSION["cpassErr"] : $_SESSION["cpassErr"] = ""; ?>
                            </span>
                        </div>
                    </div>
                    <span class="text-center mb-2 small text-white">Already have an account? <a href="login.php">Login
                            here</a></span>
                    <button type="submit" class="btn btn-secondary col-12 mt-3">Submit</button>
                </form>
                <?php
                unset($_SESSION["unameErr"]);
                unset($_SESSION["emailErr"]);
                unset($_SESSION["mobileErr"]);
                unset($_SESSION["passErr"]);
                unset($_SESSION["cpassErr"]);
                unset($_SESSION["unameval"]);
                unset($_SESSION["emailval"]);
                unset($_SESSION["mobileval"]);
                unset($_SESSION["passval"]);
                unset($_SESSION["cpassval"]);

                ?>
            </div>
        </div>
    </div>

    </div>


    <script>
        var isValid = true;
        document.getElementById("uname").addEventListener("change", function () {
            var uname = document.getElementById("uname").value;
            if (uname.trim() === "") {
                document.getElementById("unameErr").textContent = "Username is required.";
                isValid = false;
            } else {
                document.getElementById("unameErr").textContent = "";
            }
        });
        document.getElementById("email").addEventListener("change", function () {
            var email = document.getElementById("email").value;
            if (email.trim() === "") {
                document.getElementById("emailErr").textContent = "Email is required.";
                isValid = false;
            } else if (!/\S+@\S+\.\S+/.test(email)) {
                document.getElementById("emailErr").textContent = "Invalid email format.";
                isValid = false;
            } else {
                document.getElementById("emailErr").textContent = "";
            }
        });
        document.getElementById("mobile").addEventListener("change", function () {
            var mobile = document.getElementById("mobile").value;
            if (mobile.trim() === "") {
                document.getElementById("mobileErr").textContent = "Phone number is required.";
                isValid = false;
            } else if (!/^\d{10}$/.test(mobile)) {
                document.getElementById("mobileErr").textContent = "Invalid phone number format. Must be 10 digits.";
                isValid = false;
            } else {
                document.getElementById("mobileErr").textContent = "";
            }
        });
        document.getElementById("pass").addEventListener("change", function () {
            var pass = document.getElementById("pass").value;
            if (pass.trim() === "") {
                document.getElementById("passErr").textContent = "Password is required.";
                isValid = false;
            } else if (pass.length < 6) {
                document.getElementById("passErr").textContent = "must be 6 characters ";
                isValid = false;
            } else {
                document.getElementById("passErr").textContent = "";
            }
        });

        document.getElementById("cpass").addEventListener("change", function () {
            var cpass = document.getElementById("cpass").value;
            var pass = document.getElementById("pass").value;
            if (cpass.trim() === "") {
                document.getElementById("cpassErr").textContent = "Confirm password is required.";
                isValid = false;
            } else if (cpass !== pass) {
                document.getElementById("cpassErr").textContent = "Passwords not match.";
                isValid = false;
            } else {
                document.getElementById("cpassErr").textContent = "";
            }
        });

        document.getElementById("signinForm").addEventListener("submit", function (event) {
             // Prevent form submission to check validation
            isValid = true; // Reset validation status before checking
            if (document.getElementById("uname").value.trim() === "") {
                document.getElementById("unameErr").textContent = "Username is required.";
                isValid = false;
            }
            if (document.getElementById("email").value.trim() === "") {
                document.getElementById("emailErr").textContent = "Email is required.";
                isValid = false;
            } else if (!/\S+@\S+\.\S+/.test(document.getElementById("email").value)) {
                document.getElementById("emailErr").textContent = "Invalid email format.";
                isValid = false;
            }
            if (document.getElementById("mobile").value.trim() === "") {
                document.getElementById("mobileErr").textContent = "Phone number is required.";
                isValid = false;
            } else if (!/^\d{10}$/.test(document.getElementById("mobile").value)) {
                document.getElementById("mobileErr").textContent = "Invalid phone number format. Must be 10 digits.";
                isValid = false;
            }
            if (document.getElementById("pass").value.trim() === "") {
                document.getElementById("passErr").textContent = "Password is required.";
                isValid = false;
            } else if (document.getElementById("pass").value.length < 6) {
                document.getElementById("passErr").textContent = "Password must be at least 6 characters long.";
                isValid = false;
            }
            if (document.getElementById("cpass").value.trim() === "") {
                document.getElementById("cpassErr").textContent = "Confirm password is required.";
                isValid = false;
            } else if (document.getElementById("cpass").value !== document.getElementById("pass").value) {
                document.getElementById("cpassErr").textContent = "Passwords do not match.";
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault();
            }
        });

    </script>
</body>

</html>