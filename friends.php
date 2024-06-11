<?php
session_start();
$con = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
include("php_util/isLogin.php");
$dow = check_login($con);
$uid = $dow['u_id'];
$name = $dow['fname'] . ' ' . $dow['lname'];
$cover = $dow['cover'];
$dp = $dow['dp'];

$ache = mysqli_fetch_assoc(mysqli_query($con, "select *from requests where rqto='$uid'"));
$achena = mysqli_fetch_assoc(mysqli_query($con, "select *from user where u_id<>'$uid'"));
$jche = mysqli_fetch_assoc(mysqli_query($con, "select *from requests where rqto='$uid'"));
$jchena = mysqli_fetch_assoc(mysqli_query($con, "select *from user where u_id<>'$uid'"));

?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Friends | JUSE</title>
    <link rel="icon" href="images/icob.svg">

    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/friends.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {

            window.addEventListener('scroll', function() {

                if (window.scrollY >= 0) {
                    document.getElementById('navbar_top').classList.add('fixed-top');
                    // add padding top to show content behind navbar
                    navbar_height = document.querySelector('.navbar').offsetHeight;
                    document.body.style.paddingTop = navbar_height + 'px';
                } else {
                    document.getElementById('navbar_top').classList.remove('fixed-top');
                    // remove padding top from body
                    document.body.style.paddingTop = '0';
                }
            });
        });
        // DOMContentLoaded  end
    </script>

</head>

<body>

    <nav id="navbar_top" class="navbar navbar-expand-lg navbar-dark bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand text-dark" href="home.php"><img style="transform: scale(2.5);height:20px;width:20px;object-fit:fill;border-radius: 50%;" src="images/logo.png" alt="JUSE"></a>
            <div class="navxx">
                <form action="searchinsocial.php" method="post">
                    <input name="skey" type="text" required placeholder="Search"></input>
                    <input name="searchkoro" type="submit" hidden>
                </form>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="main_nav">


                <ul class="navbar-nav ms-auto">
                    <li id="home250" class="nav-item f bc"><a class="nav-link text-dark" href="home.php"> <i class="fas fa-home text-dark fa-lg"></i> </a> </li>
                    <li id="friend250" class="nav-item f bg-d bc"><a class="nav-link text-dark hover-underline-animation" href="friends.php"> <i class="fas fa-user-friends text-dark fa-lg"></i> </a> <span id="kotorq1"></span></li>
                    <li id="group250" class="nav-item f bg-d bc"><a class="nav-link text-dark" href="#"><i class="fas fa-users text-dark fa-lg"></i> </a> </li>
                    <li id="classroom250" class="nav-item f bg-d bc"><a class="nav-link text-dark" href="#"><i class="fas fa-chalkboard-teacher text-dark fa-lg"></i> </a> </li>
                    <li id="messenger250" class="nav-item f bg-d bc"><a class="nav-link text-dark" href="#"> <i class="fab fa-facebook-messenger text-dark fa-lg"></i> </a><span id="kotomessage"></span></li>
                    <li id="notification250" class="nav-item f bg-d bc"><a class="nav-link text-dark" href="#"> <i class="fas fa-bell text-dark fa-lg"></i> </a><span id="kotonoti"></span></li>
                    <li id="user250" class="nav-item foru bg-d"><a class="nav-link text-dark" href="profile.php">
                            <div class="left">
                                <img src="<?php if (!empty($dp)) echo $dp;
                                            else echo "images/defaultdp.png"; ?>" alt="">
                                <small style="margin-left: .5rem; font-weight:500; width:80px;white-space: nowrap;overflow: hidden !important;text-overflow: ellipsis;"> <?php echo $name ?></small>
                            </div>
                        </a> </li>
                    <li id="logout250" class="nav-item f bg-d bc"><a class="nav-link text-dark" href="#"> <i class="fas fa-sign-out-alt text-dark fa-lg"></i> </a> </li>
                </ul>

            </div> <!-- navbar-collapse.// -->
        </div> <!-- container-fluid.// -->
    </nav>

    <section id="sc" class="con">
        <?php
        if ($ache)
            echo '<h4 style="margin-bottom:1rem;">Friend Requests</h4>
        <div class="card-wrapper" style="margin-bottom:2rem;" id="rq">
        </div>';
        ?>
        <?php
        if($achena)
        echo '<h4 style="margin-bottom:1rem;">People You May Know</h4>
        <div class="card-wrapper" id="load_data">
        </div>';
         ?>
         <?php
         if(!$jche and !$jchena)
         echo '<h4 style="text-align:center;">No other user available.</h4>';
          ?>
        

    </section>
    <script src="js/nav.js"></script>
    <script>
        $(document).ready(function() {

            var limit = 5;
            var start = 0;
            var action = 'inactive';

            function load_country_data(limit, start) {
                $.ajax({
                    url: "getfriend.php",
                    method: "POST",
                    data: {
                        limit: limit,
                        start: start
                    },
                    cache: false,
                    success: function(data) {
                        $('#load_data').append(data);
                        if (data == '') {
                            action = 'active';
                        } else {
                            action = "inactive";
                        }
                    }
                });
            }

            if (action == 'inactive') {
                action = 'active';
                load_country_data(limit, start);
            }
            $("#sc").scroll(function() {
                if ($("#sc").scrollTop() + $("#sc").height() > $("#load_data").height() && action == 'inactive') {
                    action = 'active';
                    console.log("j");
                    start = start + limit;
                    setTimeout(function() {
                        load_country_data(limit, start);
                    }, 1);
                }
            });



            var lt = 5;
            var st = 0;
            var an = 'inactive';

            function load_country_datat(lt, st) {
                $.ajax({
                    url: "getfriend.php",
                    method: "POST",
                    data: {
                        lt: lt,
                        st: st
                    },
                    cache: false,
                    success: function(data) {
                        $('#rq').append(data);
                        if (data == '') {
                            an = 'active';
                        } else {
                            an = "inactive";
                        }
                    }
                });
            }

            if (an == 'inactive') {
                an = 'active';
                load_country_datat(lt, st);
            }
            $("#sc").scroll(function() {
                if ($("#sc").scrollTop() + $("#sc").height() > $("#rq").height() && an == 'inactive') {
                    an = 'active';
                    console.log("rq");
                    st = st + lt;
                    setTimeout(function() {
                        load_country_datat(lt, st);
                    }, 1);
                }
            });

        });
    </script>
    <script src="js/navfetch.js"></script>
</body>

</html>