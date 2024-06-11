<?php session_start();
$db = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
$nothing=mysqli_fetch_assoc(mysqli_query($db, "select *from user where u_id=".$_SESSION['u_id'].""));
if($nothing['id_type']==="Student")
header("Location: user_dashboard.php");
else if($nothing['id_type']==="Teacher")
header("Location: user_dashboard_t.php");
include("functions.php");
$dow=check_login($db);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
      
//   if(!$db) echo "<script> alert('hi1111111');</script>";
//         else echo "<script> alert('hello1111111');</script>";
        $uid=$_SESSION['u_id'];
        echo "<script> console.log('$uid');</script>";
    if (isset($_POST['upload'])) {
        $uid=$_SESSION['u_id'];
        $jobtype = $_POST['jobtype'];
        $sql = "update user set id_type ='$jobtype' where u_id='$uid'";
        $r=mysqli_query($db, $sql);
        // if(!$r) echo "<script> alert('hi');</script>";
        // else echo "<script> alert('hello');</script>";
        if ($jobtype == "Student") {
            $query2 = "insert into student(u_id) values('$uid')";
            $r=mysqli_query($db, $query2);
        //     if(!$r) echo "<script> alert('hi');</script>";
        // else echo "<script> alert('hello');</script>";
            echo "<script>location.href = 'stu_reg.php';</script>";
        } elseif ($jobtype == "Teacher") {
            $query2 = "insert into teacher(u_id) values('$uid')";
            mysqli_query($db, $query2);
            echo "<script>location.href = 'tea_reg.php';</script>";
        }
        // if(!$r) echo "<script> alert('hi');</script>";
        // else echo "<script> alert('hello');</script>";
   
    }
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Id Type</title>
    <link rel="icon" href="./dbfiles/icob.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container" style="margin-top:5rem;">
        <div class="title">
            Please specify Id type
        </div>
        <form method="post" enctype="multipart/form-data">
            <div class="user-details">
            <div class="gender-details">
                <span class="gender-title">
                    Id Type
                </span>
                <input type="radio" name="jobtype" value="Teacher" id="dott-1">
                <input type="radio" name="jobtype" value="Student" id="dott-2">
                <div class="category xd" >
                    <label for="dott-1" style="padding-right: 2rem;">
                        <span class="dot one"></span>
                        <span class="gender">Teacher</span>
                    </label>
                    <label for="dott-2">
                        <span class="dot two"></span>
                        <span class="gender">Student</span>
                    </label>
                </div>
            </div>
            <div class="button" style="margin-right: 30rem;margin-top: 5rem;">
                <input type="submit"  value="Enter" name="upload" style="width: 50rem;">
            </div>
        </form>
    </div>
</body>
</html>