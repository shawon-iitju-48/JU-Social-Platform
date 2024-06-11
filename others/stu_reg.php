<?php
$con = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
include("functions.php");
$dow = check_login($con);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $u_id = $_SESSION['u_id'];
    $skills = $_POST['skills'];
    $hall = $_POST['hall'];
    $cg = $_POST['cg'];
    $semester = $_POST['semester'];
    $batch = $_POST['batch'];
    $dept_id = $_POST['dept_id'];

    $query = "update  student set skills='$skills', hall='$hall',cg='$cg',semester='$semester',batch='$batch',dept_id='$dept_id' where u_id='$u_id'";

    if (mysqli_query($con, $query)) {
        echo "<script>location.href = 'user_dashboard.php';</script>";
    } else
        echo mysqli_error($con);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
      <link rel="icon" href="./dbfiles/icob.svg">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/stu_reg.css">
</head>

<body>
    <div class="container">
        <div class="title">
            Student Registration
        </div>
        <form method="post" action="stu_reg.php" enctype="multipart/form-data">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Batch</span>
                    <input type="text" name="batch" placeholder="Enter your Batch No." required>
                </div>
                <div class="input-box">
                    <span class="details">Semester</span>
                    <input type="text" name="semester" placeholder="Enter your semester" required>
                </div>
                <div class="input-box">
                    <span class="details"> Hall</span>
                    <input type="text" name="hall" placeholder="Enter your hall" required>
                </div>
                <div class="input-box">
                    <span class="details"> Department ID</span>
                    <input type="text" name="dept_id" placeholder="Enter your dept. ID" required>
                </div>
                <div class="input-box">
                    <span class="details"> CGPA</span>
                    <input type="text" name="cg" placeholder="Enter your CGPA" required>
                </div>

                <div class="input-box">
                    <span class="details"> Skills</span>
                    <input type="text" name="skills" placeholder="Enter your skills" required>
                </div>
            </div>
            <div class="button">
                <input type="submit" value="Register" name="enter">
            </div>
        </form>
    </div>
</body>

</html>