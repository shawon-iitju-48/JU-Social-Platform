<?php
session_start();
$con = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
$_SESSION['lol'] = 0;
if (isset($_POST['upload'])) {

    $u_id = $_POST['userid'];
    $password = $_POST['password'];

    $query = "select * from user where u_id='$u_id'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        if ($user_data['ustat'] == 'yes') {
            if ($user_data['status'] == 'yes') {
                if ($user_data['password'] === $password) {
                    $_SESSION['u_id'] = $user_data['u_id'];
                    mysqli_query($con, "update user set sstatus='Online' where u_id='$u_id'");
                    $_SESSION['dp'] = $user_data['dp'];
                    if(empty($_SESSION['dp']))
                    $_SESSION['dp']="images/defaultdp.png";
                    header("Location: home.php");
                } else $_SESSION['lol'] = 1;
            } else  $_SESSION['lol'] = 2;
        } else $_SESSION['lol'] = 3;
    } else $_SESSION['lol'] = 4;
}
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>JUSE Login</title>
    <link rel="stylesheet" href="css/loginSocial.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="images/icob.svg">



</head>

<body>
    <div class="data">
        <div class="line">
            <h1><b>JU Social & E-Learning Platform</b></h1>
            <h4>JUSE helps you connect and share with the people in your life. </h4>
        </div>
        <div class="login">
            <form method="post">
                <div class="error uid">
                    <span>Your User ID is invalid.</span>
                </div>
                <div class="error email">
                    <span>Please varify your Email.</span>
                </div>
                <div class="error admin">
                    <span>Please wait for admin approval.</span>
                </div>
                <input id="uuu" type="text" placeholder="User ID" required name="userid">
                <div class="error pass">
                    <span>Your Password is incorrect.</span>
                </div>
                <input id="ppp" type="password" placeholder="Password" required name="password">
                <input class="btn btn-primary" style="font-weight:bold;font-size: 1.5rem;" type="submit" name="upload" value="Log In">
            </form>
            <div class="ordhek">
                <hr>
                <p style="text-align:center;">or</p>
                <hr>
            </div>
            <div class="link">
                <a href="signupsocial.php" class="btn btn-success">Create New Account</a>
            </div>

        </div>
    </div>
    <script>
        $(document).ready(function() {
            if (<?php echo $_SESSION['lol']; ?> == 1)
                $(".pass").css("display", "block");

            else if (<?php echo $_SESSION['lol']; ?> == 2)
                $(".admin").css("display", "block");

            else if (<?php echo $_SESSION['lol']; ?> == 3)
                $(".email").css("display", "block");

            else if (<?php echo $_SESSION['lol']; ?> == 4)
                $(".uid").css("display", "block");
        });
    </script>
    <script src="js/loginSocial.js"></script>
</body>

</html>