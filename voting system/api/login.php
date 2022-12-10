<?php
    session_start();
    include("connect.php");

    $mobile = $_POST['mob'];
    $pass = $_POST['pass'];
    $role = $_POST['role'];

    $check = mysqli_query($connect, "select * from user where mobile='$mobile' and password='$pass' and role='$role' ");
    
    if(mysqli_num_rows($check)>0)
    //Function return the number of rows
    {
        $getGroups = mysqli_query($connect, "select name, photo, votes, id from user where role=2 ");
        if(mysqli_num_rows($getGroups)>0){
            $groups = mysqli_fetch_all($getGroups, MYSQLI_ASSOC);
            //fetches all results rows and returns
            $_SESSION['groups'] = $groups;
        }
        $data = mysqli_fetch_array($check);
        //fetches a result row
        $_SESSION['id'] = $data['id'];
        $_SESSION['status'] = $data['status'];
        $_SESSION['data'] = $data;
        echo '<script>
                window.location = "../routes/dashboard.php";
            </script>';
    }
    else{
        echo '<script>
                alert("Invalid credentials!");
                window.location = "../";
            </script>';
    }
    
?>