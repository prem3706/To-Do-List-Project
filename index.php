<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">


    <style>
        body {
            overflow-x: hidden;
            background-color: #EAEFEF;
        }
        .login,.signup{
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }
        .login:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
            background-color: #f9f9f9;
            /* subtle background lightening */
        }
        .signup:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
            background-color: #f9f9f9;
            /* subtle background lightening */
        }
    </style>
</head>

<body>
    <div class="container min-vh-100 ">
        <div class="row d-flex gap-5 align-items-center justify-content-center min-vh-100 ">
            <a class="col-md-2 col-lg-2 card bg-dark text-white p-5 d-flex align-items-center text-decoration-none login"
            href="login.php">
                <div class="fs-3">
                    Login
                </div>
            </a>
            <a class="col-md-2 col-lg-2 card bg-dark text-white p-5 d-flex align-items-center text-decoration-none signup"
            href="signup.php">
                <div class="fs-3">
                    Signup
                </div>
            </a>



        </div>
    </div>
</body>

</html>