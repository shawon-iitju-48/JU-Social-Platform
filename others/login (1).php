<?php
$con = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
include("functions.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $u_id = $_POST['u_id'];
    $password = md5($_POST['password']);
    if (!empty($u_id) && !empty($password)) {
        $query = "select * from user where u_id='$u_id' and status='yes' limit 1";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            if ($user_data['password'] === $password) {
                 $_SESSION['u_id'] = $user_data['u_id'];
                setcookie('u_id', $user_data['u_id'], time() + (86400 * 30), "/");
                $stu = "Student";
                $tea = "Teacher";
                if ($user_data['id_type'] == $stu) {
                    $checkk = "select * from student where u_id='$u_id' limit 1";
                    $stu_result = mysqli_query($con, $checkk);
                    $stu_data = mysqli_fetch_assoc($stu_result);
                    if (is_null($stu_data['skills']))
                         echo "<script>location.href = 'stu_reg.php';</script>";
                    else
                    echo "<script>location.href = 'user_dashboard.php';</script>";
                    die;
                } elseif ($user_data['id_type'] == $tea) {
                    $checkk = "select * from teacher where u_id='$u_id' limit 1";
                    $tea_result = mysqli_query($con, $checkk);
                    $tea_data = mysqli_fetch_assoc($tea_result);
                    if (is_null($tea_data['rinterest']))
                        echo "<script>location.href = 'tea_reg.php';</script>";
                    else
                    echo "<script>location.href = 'user_dashboard_t.php';</script>";
                    die;
                }
            } else {
                echo '<script>alert("Wrong Password. Please Enter Correct Password!")</script>';
            }
        } else {
            echo '<script>alert("Invalid User ID")</script>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="icon" href="./dbfiles/icob.svg">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
</head>

<body>
    <div class="container">
    <div class="navbar">

      <nav>
        <ul class="nav_links">
             <li><a href="/">Home</a></li>
          <li><a href="notices.php">Notices</a></li>
        </ul>
      </nav>
      <a class="login" href="login.php"><button class="button1">Login</button></a>
    </div>
    <div class="center">
        <form method="post">
            <div class="txt_field">
                <input type="text" name="u_id" required>
                <span></span>
                <label>User ID</label>
            </div>
            <div class="txt_field">
                <input type="password" name="password" required>
                <span></span>
                <label>Password</label>
            </div>
            <input type="submit" value="Login">
            <div class="signup_link">
                <a href="signup.php">Signup</a>
            </div>

        </form>
    </div>
</body>

</html>