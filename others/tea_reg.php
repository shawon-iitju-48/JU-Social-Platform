<?php
$con = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
include("functions.php");
$dow = check_login($con);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['designition'])) {
    $u_id = $_SESSION['u_id'];
    $rinterest = $_POST['rinterest'];
    $designition = $_POST['designition'];
    $dept_id = $_POST['dept_id'];

    $query = "update  teacher set rinterest='$rinterest', designition='$designition',dept_id='$dept_id' where u_id='$u_id'";
    if (mysqli_query($con, $query)) {
         echo "<script>location.href = 'user_dashboard_t.php';</script>";
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
    <title>Teacher Registration</title>
      <link rel="icon" href="./dbfiles/icob.svg">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/tea_reg.css">
</head>

<body>
    <div class="container">
        <div class="title">
            Teacher Registration
        </div>
        <form method="post" action="tea_reg.php" enctype="multipart/form-data">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Designition</span>
                    <input type="text" name="designition" placeholder="Enter your designition" required>
                </div>
                <div class="input-box">
                    <span class="details">Research Interest</span>
                    <input type="text" name="rinterest" placeholder="Enter your research interest" required>
                </div>
                <div class="input-box">
                    <span class="details"> Department ID</span>
                    <input type="text" name="dept_id" placeholder="Enter your dept. ID" required>
                </div>
            </div>
            <div class="button">
                <input type="submit" value="Register" name="enter">
            </div>
        </form>
    </div>
</body>

</html>