<?php
include "dbconnection.php";
if (!isset($_SESSION["is_login"]) || $_SESSION["is_login"] !== true) {
    header("Location: login.php");
    exit();
}
$id = $_GET['id'];

$showval = "select * from task where id='$id'";
$resultEdit = mysqli_query($conn, $showval);
if (mysqli_num_rows($resultEdit) > 0) {
    $rowEdit = mysqli_fetch_assoc($resultEdit);
} else {
    echo "User not found.";
    exit();
}
// echo $rowEdit['description'];
// exit();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TO-DO Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body {
            overflow-x: hidden;
            background-color: #EAEFEF;
        }

        .nav-link {
            color: white;
            padding: 10px;
            border-radius: 6px;
            transition: all 0.3s;
        }

        .nav-link:hover {
            background-color: #282c31;
            color: white;
            padding-left: 15px;
        }

        .sidebar {
            background: #212529;
            min-height: 100vh;
        }

        .form-control:focus,
        .form-select:focus {

            color: black;
            border-color: #0d6efd;
            box-shadow: none;
        }

        textarea::placeholder,
        input::placeholder {
            color: #aaa;
        }

        .box-task {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            /* indicates interactivity */
        }

        .box-task:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
            background-color: #f9f9f9;
            /* subtle background lightening */
        }
    </style>

</head>

<body>


    <div class="container-fluid min-vh-100">
        <div class="row">


            <!-- Sidebar -->
            <div class="col-2 col-md-3 col-xl-2 px-sm-2 px-0 sidebar min-vh-100">

                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-3 text-white">

                    <a href="/"
                        class="d-flex align-items-center p-3 text-white text-decoration-none border-bottom d-none d-sm-inline">
                        <span class="fs-5">TO-DO Dashboard</span>
                    </a>

                    <ul class="nav nav-pills flex-column mt-3 gap-2 mb-auto w-100">

                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link">
                                <i class="bi bi-plus-circle"></i>
                                <span class="ms-2 d-none d-sm-inline">Add Task</span>
                            </a>
                        </li>

                        <li>
                            <a href="tasklist.php" class="nav-link">
                                <i class="bi bi-card-checklist"></i>
                                <span class="ms-2 d-none d-sm-inline">Task List</span>
                            </a>
                        </li>
                        <li>
                            <a href="logout.php" class="nav-link">
                                <i class="bi bi-box-arrow-left"></i>
                                <span class="ms-2 d-none d-sm-inline">Logout</span>
                            </a>
                        </li>

                    </ul>

                </div>

            </div>

            <!-- Task Form -->
            <div class="col p-4 gap-2 min-vh-100">

                <div class="card shadow-lg border-0 p-4"
                    style="background:white; color:black; width:100%; border-radius:12px;">
                    <div class="text-bold fs-2 d-flex gap-2">
                        <i class="bi bi-pencil-square mx-2"></i>
                        <p class=" mb-4"> Edit Task</p>
                    </div>


                    <form method="post" action="editTask-val.php" id="taskForm">

                        <div class="row">
                            <input type="hidden" name="id" value="<?php echo $rowEdit['id']; ?>">


                            <div class="col-md-6 mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control   border-secondary"
                                    id="title" name="title" placeholder="Task title"
                                    value="<?php echo $rowEdit['title'] ;?>">
                                <span class="small text-danger m-1" id="titleErr">
                                    <?php echo isset($_SESSION["titleErr"]) && $_SESSION["titleErr"] != null ? $_SESSION["titleErr"] : $_SESSION["emailErr"] = ""; ?>
                                </span>
                            </div>


                            <div class="col-md-6 mb-3">
                                <label class="form-label">Due Date</label>
                                <input type="date" class="form-control   border-secondary" id="due" name="due"
                                    value="<?php echo $rowEdit['due_date'] ;?>">
                                <span class="small text-danger m-1" id="dueErr">
                                    <?php echo isset($_SESSION["dueErr"]) && $_SESSION["dueErr"] != null ? $_SESSION["dueErr"] : $_SESSION["emailErr"] = ""; ?>
                                </span>
                            </div>

                        </div>

                        <div class="row">


                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select border-secondary" id="status" name="status"
                                    >
                                    <option value="pending" <?php if (isset($rowEdit['status']) && $rowEdit['status'] == "pending") echo "selected"; ?>>
                                        Pending
                                    </option>

                                    <option value="completed" <?php if (isset($rowEdit['status']) && $rowEdit['status'] == "completed") echo "selected"; ?>>Completed</option>
                                </select>
                            </div>


                            <div class="col-md-6 mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control border-secondary" rows="2"
                                    placeholder="Enter task description" id="desc" name="desc"
                                    ><?php echo $rowEdit['description'];?></textarea>

                            </div>

                        </div>


                        <div class="mt-3">
                            <button type="submit" name="submit" class="btn btn-dark  px-4  text-center text-md-start"
                                style="color:#ff9b51; font-weight:600; font-size:1.25rem; border-bottom: 3px solid #ff9b51;">Edit
                                Task</button>
                        </div>

                    </form>
                    <?php
                    unset($_SESSION["titleval"]);
                    unset($_SESSION["titleErr"]);
                    unset($_SESSION["dueErr"]);
                    unset($_SESSION["dueval"]);
                    unset($_SESSION["statusval"]);
                    unset($_SESSION["descval"]);
                    ?>

                </div>





            </div>



        </div>
    </div>




    <script>
        var isValid = true;
        document.getElementById("title").addEventListener("change", function() {
            var email = document.getElementById("title").value;
            if (email.trim() === "") {
                document.getElementById("titleErr").textContent = "Title is required.";
                isValid = false;
            } else {
                document.getElementById("titleErr").textContent = "";
            }
        });
        document.getElementById("due").addEventListener("change", function() {
            var email = document.getElementById("due").value;
            if (email.trim() === "") {
                document.getElementById("dueErr").textContent = "Due Date is required.";
                isValid = false;
            } else {
                document.getElementById("dueErr").textContent = "";
            }
        });
        document.getElementById("taskForm").addEventListener("submit", function(event) {

            isValid = true;
            if (document.getElementById("title").value.trim() === "") {
                document.getElementById("titleErr").textContent = "Title is required.";
                isValid = false;
            }
            if (document.getElementById("due").value.trim() === "") {
                document.getElementById("dueErr").textContent = "Due Date is required.";
                isValid = false;
            }
            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>

</body>

</html>