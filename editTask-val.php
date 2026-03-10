<?php
include 'dbconnection.php';

if($_SERVER['REQUEST_METHOD']=="POST"){
    $title = $_POST['title'];
    $due = $_POST['due'];
    $status= $_POST['status'];
    $desc= $_POST['desc'];

    $id = $_POST['id'];
    


    $isValid = true;


    if(empty($title)){
        $_SESSION['titleErr']= "Title is required.";
        $isValid = false;
    }else{
        $newtitle = $title;
    }

    if(empty($due)){
        $_SESSION['dueErr']= "Due Date is required.";
        $isValid = false;
    }else{
        $newdue = $due;
    }

    if ($isValid) {
        
        $sql = "update  task set  title='$newtitle', description ='$desc', due_date='$newdue', status ='$status' where id='$id'";
        if (mysqli_query($conn, $sql)) {
            header("Location: tasklist.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        
        $_SESSION["titleval"] = $title;
        $_SESSION["dueval"] = $due;
        $_SESSION["statusval"] = $status;
        $_SESSION["descval"] = $desc;
        header("Location: dashboard.php");
    }


}


?>