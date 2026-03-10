<?php
include "dbconnection.php";
if (!isset($_SESSION["is_login"]) || $_SESSION["is_login"] !== true) {
    header("Location: login.php");
    exit();
}
$id = $_SESSION['u_id'];

$tsaklist = "select * from task where user_id = $id order by created_date desc limit 6";


$result = mysqli_query($conn, $tsaklist);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TO-DO Dashboard</title>

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

                <?php if (isset($_SESSION['success'])) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><?php echo $_SESSION['success'] ?></strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="<?php unset($_SESSION['success']); ?>"></button>
                    </div>
                <?php } ?>
                <?php if (isset($_SESSION['error'])) { ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong><?php echo $_SESSION['error'] ?></strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="<?php unset($_SESSION['success']); ?>"></button>
                    </div>
                <?php } ?>

                <div class="card shadow-lg border-0 p-4"
                    style="background:white; color:black; width:100%; border-radius:12px;">
                    <div class="text-bold fs-2 d-flex gap-2">
                        <i class="bi bi-plus-circle "></i>
                        <p class=" mb-4"> Add Task</p>
                    </div>


                    <form method="post" action="task-val.php" id="taskForm">

                        <div class="row">


                            <div class="col-md-6 mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control   border-secondary"
                                    id="title" name="title" placeholder="Task title"
                                    value="<?php echo isset($_SESSION["titleval"]) && $_SESSION["titleval"] != null ? $_SESSION["titleval"] : $_SESSION["titleval"] = ""; ?>">
                                <span class="small text-danger m-1" id="titleErr">
                                    <?php echo isset($_SESSION["titleErr"]) && $_SESSION["titleErr"] != null ? $_SESSION["titleErr"] : $_SESSION["emailErr"] = ""; ?>
                                </span>
                            </div>


                            <div class="col-md-6 mb-3">
                                <label class="form-label">Due Date</label>
                                <input type="date" class="form-control   border-secondary" id="due" name="due"
                                    value="<?php echo isset($_SESSION["dueval"]) && $_SESSION["dueval"] != null ? $_SESSION["dueval"] : $_SESSION["dueval"] = ""; ?>">
                                <span class="small text-danger m-1" id="dueErr">
                                    <?php echo isset($_SESSION["dueErr"]) && $_SESSION["dueErr"] != null ? $_SESSION["dueErr"] : $_SESSION["emailErr"] = ""; ?>
                                </span>
                            </div>

                        </div>

                        <div class="row">


                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select border-secondary" id="status" name="status"
                                    value="<?php echo isset($_SESSION["statusval"]) && $_SESSION["statusval"] != null ? $_SESSION["statusval"] : $_SESSION["statusval"] = ""; ?>">
                                    <option value="pending">Pending</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>


                            <div class="col-md-6 mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control border-secondary" rows="2"
                                    placeholder="Enter task description" id="desc" name="desc"
                                    value="<?php echo isset($_SESSION["descval"]) && $_SESSION["descval"] != null ? $_SESSION["descval"] : $_SESSION["descval"] = ""; ?>"></textarea>

                            </div>

                        </div>


                        <div class="mt-3">
                            <button type="submit" name="submit" class="btn btn-dark  px-4  text-center text-md-start"
                                style="color:#ff9b51; font-weight:600; font-size:1.25rem; border-bottom: 3px solid #ff9b51;">Add
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
                <div class="row m-2">

                    <div class="col-md-3  col-sm-6 mt-3 p-2   d-flex align-items-center justify-content-center"
                        style="color:black;
                        background: linear-gradient(to bottom, #EAEFEF 0%, #d1d1d1 100%); border-bottom: 2px solid black; font-weight: 600; font-size: 1.25rem; text-align: center;"><i class="bi bi-clock-history mx-3"></i>
                        Recent Task
                    </div>
                </div>


                <!-- Task Cards -->
                <div class="row row-cols-1 row-cols-md-3 row-cols-lg-3 g-4 mt-2 d-flex align-items-center ">

                    <?php if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) { ?>

                            <div class="col">
                                <div class="card shadow-sm p-4 h-100 box-task"
                                    style="background:#fff; color:#212529; border-radius:12px;">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="mb-0"><?php echo $row['title']; ?></h5>
                                        <?php $badgeColor = ($row['status'] === 'completed') ? 'bg-success' : 'bg-warning text-dark';
                                        ?>
                                        <span class="badge <?php echo $badgeColor ?>  text-dark" id="statuscolor"><?php echo $row['status']; ?></span>
                                    </div>
                                    <p class="mb-1"><strong>Due Date:</strong> <?php echo $row['due_date']; ?></p>
                                    <p class="mb-3 text-muted"><?php echo $row['description']; ?></p>
                                    <div class="d-flex justify-content-between align-items-center mt-1">
                                        <p class="mb-1"><strong>Created Date:</strong> <?php echo date('Y-m-d', strtotime($row['created_date'])); ?></p>

                                        <div class="fs-4">
                                            <a href="editTask.php?id=<?php echo $row['id']; ?>"
                                                class="bi bi-pencil-square mx-2">
                                            </a>
                                            <a href="deleteTask.php?id=<?php echo $row['id']; ?>"
                                                class="bi bi-trash-fill"
                                                onclick="return confirm('Are you sure you want to delete this task?');">
                                            </a>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php }
                    } else { ?>

                        <div class="col-12 align-item-center">
                            <div class="card shadow-sm p-5 h-100 box-task d-flex justify-content-center align-items-center "
                                style="background:#fff; color:#212529; border-radius:12px;">
                                <h5 class=" text-muted">No task Found!</h5>
                            </div>
                        </div>

                    <?php } ?>
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