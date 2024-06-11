<?php
session_start();
$con = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
include("php_util/isLogin.php");
$dow = check_login($con);
$name = $dow['fname'] . ' ' . $dow['lname'];
$dp = $dow['dp'];


if (isset($_POST['searchkoro'])) {
    $skey = '%' . $_POST['skey'] . '%';
    $group = "select *from user_groups where gname like '$skey'";
    $user = "select *from user where fname like '$skey' or lname like '$skey' or concat_ws(' ',fname, lname) like '$skey'";
    $groupp = mysqli_query($con, $group);
    $userr = mysqli_query($con, $user);

    $lagbe = mysqli_fetch_assoc($userr);
    $lagbe1 = mysqli_fetch_assoc($groupp);

    $grouppp = mysqli_query($con, $group);
    $userrr = mysqli_query($con, $user);
}

?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Search Results | JUSE</title>

    <link rel="stylesheet" href="css/searchSocial.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">
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
    <link rel="icon" href="images/icob.svg">


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
                    <li id="friend250" class="nav-item f bg-d bc"><a class="nav-link text-dark" href="friends.php"> <i class="fas fa-user-friends text-dark fa-lg"></i> </a> <span id="kotorq1"></span></li>
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


    <div class="search">
        <?php
        if ($lagbe) {
            echo '
            <div class="row-1">
            <h4>People</h4><br>
            <div class="inner">';
            while ($userres = mysqli_fetch_assoc($userrr)) {
                echo ' <div class="card">
                    <div class="left">
                        <a href="peopleprofile.php?pi=' . $userres["u_id"] . '"><img src="' . $userres["dp"] . '" alt=""></a>
                        <a href="peopleprofile.php?pi=' . $userres["u_id"] . '">' . $userres["fname"] . ' ' . $userres['lname'] . '</a>
                    </div>';
                $gg = $userres['u_id'];
                $isfriend = mysqli_fetch_assoc(mysqli_query($con, "select *from user_friends where friendfrom=" . $_SESSION['u_id'] . " and friendto='$gg'"));
                $isrq = mysqli_fetch_assoc(mysqli_query($con, "select *from requests where rqfrom=" . $_SESSION['u_id'] . " and rqto='$gg'"));
                $isrqashche = mysqli_fetch_assoc(mysqli_query($con, "select *from requests where rqfrom='$gg' and rqto=" . $_SESSION['u_id'] . ""));
                if ($isrqashche && ($userres["u_id"] != $_SESSION['u_id'])) {
                    echo '
                    <div id="' . $userres["u_id"] . '" class="right confirmkoro boshotkore" style="color:blue">
                    <span id="' . $userres["u_id"] . '_"><i class="fas fa-user-plus"></i></span></div>';
                } else if ($isfriend && ($userres["u_id"] != $_SESSION['u_id'])) {
                    echo '<div class="right mess boshotkore" id="' . $userres["u_id"] . '">
                        <i style="font-size:1.5rem;" class="fab fa-facebook-messenger"></i></div>';
                } else if ($isrq && ($userres["u_id"] != $_SESSION['u_id']))
                    echo '
                    <div id="' . $userres["u_id"] . '" class="right requestpathao" style="color:blue">
                    <span id="' . $userres["u_id"] . '_"><i class="fas fa-user-minus"></i></span></div>';
                else if ($userres["u_id"] != $_SESSION['u_id'])
                    echo '
                    <div id="' . $userres["u_id"] . '" class="right requestpathao">
                    <span id="' . $userres["u_id"] . '_"><i class="fas fa-user-plus"></i></span></div>';
                echo '
                    
                </div>';
            }
            echo '
            </div>
        </div>';
        }
        ?>
        <?php
        if ($lagbe1) {
            echo '
            <div class="row-1">
            <h4>Groups</h4><br>
            <div class="inner">';
            while ($groupres = mysqli_fetch_assoc($grouppp)) {
                echo '
                <div class="cd">
                    <div class="left">
                        <a href="group.php?gid=' . $groupres["gid"] . '"><img src="' . $groupres["cover"] . '" alt=""></a>
                    </div>
                    <div class="mid">
                        <a href="group.php?gid=' . $groupres["gid"] . '">' . $groupres["gname"] . '</a>
                        <small> Private Group . ' . $groupres["member"] . ' Member</small>
                        <p class="truncate">' . $groupres["about"] . '</p>
                    </div>';
                $ismember = mysqli_fetch_assoc(mysqli_query($con, "select *from group_member where memberid=" . $_SESSION['u_id'] . " and gid=" . $groupres["gid"] . ""));
                $isreq = mysqli_fetch_assoc(mysqli_query($con, "select *from grouprequests where rqfrom=" . $_SESSION['u_id'] . " and rqto=" . $groupres["gid"] . ""));
                if ($ismember and ($groupres["u_id"] != $_SESSION['u_id'])) {
                    echo '
                    <a style="text-decoration:none;" href="group.php?gid=' . $groupres["gid"] . '"><div class="right boshotkore earphone">
                    <i style="color:blue" class="fa-solid fa-users"></i>
                    </div></a>';
                } else if ($isreq and ($groupres["u_id"] != $_SESSION['u_id'])) {
                    echo '
                    <div id="' . $groupres["gid"] . '" class="right mofiz xd boshotkore">
                    <span id="' . $groupres["gid"] . '__"><i style="color:blue;" class="fa-solid fa-users-slash"></i></span>
                    </div>';
                } else if ($groupres["u_id"] != $_SESSION['u_id']) {
                    echo '
                    <div id="' . $groupres["gid"] . '" class="right mofiz xdd boshotkore">
                    <span id="' . $groupres["gid"] . '__"><i class="fa-solid fa-users-medical"></i></span>
                    </div>';
                }
                echo '
                </div>';
            }
            echo '
            </div>
        </div>';
        }
        if (!$lagbe && !$lagbe1)
            echo '<h1 style="margin-top:20%;margin-left:35%">No results found.</h1>'
        ?>
    </div>
    <script src="js/nav.js"></script>
    <script src="js/navfetch.js"></script>
    <script>
        $(document).ready(function() {
            $(".requestpathao").click(function() {
                var s = this.id;
                $.ajax({
                    url: "rqadditional.php",
                    method: "POST",
                    data: {
                        rqpathaona: this.id
                    },
                    cache: false,
                    success: function(data) {
                        if (data == 'minus') {
                            $("#" + s + "_").html("");
                            $("#" + s + "_").html("<i style='color:blue;' class='fas fa-user-minus'></i>")
                        } else {
                            $("#" + s + "_").html("");
                            $("#" + s + "_").html("<i style='color:black;' class='fas fa-user-plus'></i>")
                        }

                    }
                });
            });
            $(".mess").click(function() {
                var m = this.id;
                $(location).prop('href', "chat.php?u_id=" + m);
            });
            $(".confirmkoro").click(function() {
                var sp = this.id;
                $("#" + sp).removeClass("confirmkoro");
                $("#" + sp).addClass("mess");
                $.ajax({
                    url: "rqadditional.php",
                    method: "POST",
                    data: {
                        accept: sp
                    },
                    cache: false,
                    success: function(data) {
                        $("#" + sp + "_").html("");
                        $("#" + sp + "_").html("<i style='font-size:1.5rem;color:black' class='fab fa-facebook-messenger'></i>")
                    }
                });
            });
            $(".confirmkoro").hover(function(e) {
                $(".confirmkoro").attr('data', 'Confirm');
            })
            $(".mess").hover(function(e) {
                $(".mess").attr('data', 'Message');
            });
            $(".earphone").hover(function(e) {
                $(".earphone").attr('data', 'Joined');
            });
            $(".xd").hover(function(e) {
                $(".xd").attr('data', 'Cancel');
            });
            $(".xdd").hover(function(e) {
                $(".xdd").attr('data', 'Join Group');
            });

            $(".mofiz").click(function() {
                var xd = this.id;
                $.ajax({
                    url: "rqadditional.php",
                    method: "POST",
                    data: {
                        xd: this.id
                    },
                    cache: false,
                    success: function(data) {
                        console.log(data);
                        if (data == 'minus') {
                            $("#" + xd + "__").html("");
                            $("#" + xd + "__").html("<i style='color:blue;' class='fa-solid fa-users-slash'></i>")
                        } else {

                            $("#" + xd + "__").html("");
                            $("#" + xd + "__").html("<i style='color:black;' class='fa-solid fa-users-medical'></i>")
                        }

                    }
                });
            });





        });
    </script>
</body>

</html>