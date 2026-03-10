<?php
include "dbconnection.php";
if (!isset($_SESSION["is_login"]) || $_SESSION["is_login"] !== true) {
    header("Location: login.php");
    exit();
}
$id = $_SESSION['u_id'];

$tsaklist = "select * from task where user_id = $id";
$result = mysqli_query($conn, $tsaklist);

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
        }

        .box-task:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
            background-color: #f9f9f9;
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



                <div class="card mt-3 p-3 shadow  "
                    style="background-color: #212529; color: #fff; font-weight: 600; font-size: 1.5rem; border-radius: 12px;">


                    <div class=" ">
                        <i class="bi bi-card-checklist me-2"></i> Task List
                    </div>


                    <!-- <div class="ms-auto">
                        <div class="dropdown">
                            <button class="btn btn-outline-light btn-sm dropdown-toggle" type="button" id="filterMenu"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-funnel-fill me-1"></i> Filter
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="filterMenu">
                                <li><a class="dropdown-item" href="#">All</a></li>
                                <li><a class="dropdown-item" href="#">Pending</a></li>
                                <li><a class="dropdown-item" href="#">In Progress</a></li>
                                <li><a class="dropdown-item" href="#">Completed</a></li>
                            </ul>
                        </div>


                    </div> -->
                </div>


                <div class="row mt-3 mb-3">


                    <div class="col p-3">
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 g-4">
                            <?php if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) { ?>

                                    <div class="col">
                                        <div class="card p-3 box-task"
                                            style="border-radius:12px; background:#fff; color:#212529;">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <h5 class="mb-0"><?php echo $row['title']; ?></h5>
                                                <?php $badgeColor = ($row['status'] === 'completed') ? 'bg-success' : 'bg-warning text-dark'; ?>
                                                <span class="badge  <?php echo $badgeColor ?>   text-dark"><?php echo $row['status']; ?></span>
                                            </div>
                                            <p class="mb-1"><strong>Due Date:</strong> <?php echo $row['due_date']; ?></p>
                                            <p class="mb-0 text-muted"><?php echo $row['description']; ?>
                                            </p>
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

                            <!-- <div class="col">
                                <div class="card p-3 box-task"
                                    style="border-radius:12px; background:#fff; color:#212529;">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h5 class="mb-0">Backend API</h5>
                                        <span class="badge bg-info text-dark">In Progress</span>
                                    </div>
                                    <p class="mb-1"><strong>Due Date:</strong> 2026-03-12</p>
                                    <p class="mb-0 text-muted">Develop REST API for user authentication and tasks.</p>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card p-3 box-task"
                                    style="border-radius:12px; background:#fff; color:#212529;">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h5 class="mb-0">Testing</h5>
                                        <span class="badge bg-success text-dark">Completed</span>
                                    </div>
                                    <p class="mb-1"><strong>Due Date:</strong> 2026-03-08</p>
                                    <p class="mb-0 text-muted">Perform QA tests on completed modules.</p>
                                </div>
                            </div> -->


                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>