<?php
include 'dbconnection.php';

if($_SERVER['REQUEST_METHOD']=="POST"){
    $title = $_POST['title'];
    $due = $_POST['due'];
    $status= $_POST['status'];
    $desc= $_POST['desc'];

    $id = $_SESSION['u_id'];

    

    


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
        $sql = "INSERT INTO task (user_id, title, description, due_date, status ) VALUES ('$id','$newtitle', '$desc', '$newdue', '$status')";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['success']='Task Added Successfully';
            header("Location: dashboard.php");

            
            exit();
        } else {
            $_SESSION['error']='"Error: " . $sql . "<br>" . mysqli_error($conn);';

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