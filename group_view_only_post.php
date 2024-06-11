<?php
session_start();
$con = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
include("php_util/isLogin.php");
$dow = check_login($con);
$name = $dow['fname'] . ' ' . $dow['lname'];
$dp = $dow['dp'];
$pid = $_GET['pidd'];
$q1 = "select *from user inner join (select *from grouppost natural join user_groups  where gpid='$pid')x on x.memberid=user.u_id";
$subres1 = mysqli_query($con, $q1);

if (mysqli_fetch_array(mysqli_query($con, "select *from grouppost natural join grouppost_photos where gpid='$pid'")))
    header("Location: groupphotoview.php?pidd=$pid");
if (mysqli_fetch_array(mysqli_query($con, "select *from grouppost natural join grouppost_videos where gpid='$pid'")))
    header("Location: groupvideoview.php?pidd=$pid");
$res1 = mysqli_fetch_assoc($subres1);
$res2 = mysqli_query($con, $q1);;
$hostid = $res1['memberid'];
$hostdp = $res1['dp'];
$hostname = $res1['fname'] . ' ' . $res1['lname'];
$post = $res1['pdetails'];
$posttime = $res1['ptime'];
$postdate = $res1['pdate'];
$postlike = $res1['likecount'];
$postcomment = $res1['commentcnt'];

$like1 = "select *from grouppost_likes where memberid=" . $_SESSION['u_id'] . " and gpid='$pid'";
$like2 = mysqli_query($con, $like1);
$like3 = mysqli_fetch_array($like2);


?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>JUSE</title>
    <link rel="icon" href="images/icob.svg">

    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/view_only_post.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
    <div class="data">
        <div class="row" style="margin-bottom:2rem;">
            <div class="posthead">
                <div class="left">
                    <a href="group.php?gid=<?php echo $res1['gid']; ?>"><img src="<?php echo $res1['cover']; ?>" alt=""><img style="margin-left:-1rem;width:30px;height:30px;margin-top:1rem;" src="<?php echo $hostdp; ?>" alt=""></a>
                </div>
                <div class="right">
                    <a href="group.php?gid=<?php echo $res1['gid']; ?>"><b><?php echo $res1['gname']; ?></b></a><br>

                    <p style="font-size: .8rem;"><a style="font-size:.8rem;font-weight:300;" href="peopleprofile.php?pi=<?php echo $hostid; ?>"><b><?php echo $hostname; ?></b></a> . <?php echo $postdate; ?> at <?php echo $posttime; ?></p>
                </div>
            </div>
            <p><?php echo nl2br($post); ?></p>
            <div class="like" style="margin-bottom:-1.8rem;">
                <div class="left">
                    <h6><i style="margin-right:0.5rem;font-weight: 400;color:#2078F4" class="fa-duotone fa-thumbs-up"></i><span id="<?php echo $pid; ?>-"><?php echo $postlike; ?></span>
                    </h6>
                </div>
                <div class="right">
                    <p><b><span id="<?php echo $pid; ?>-----"><?php echo $postcomment; ?></span>Comments</b></p>
                </div>
            </div>
            <div class="agao">
                <hr>
                <button id="<?php echo $pid; ?>" class="btn ButtonJolo kirebhai" style="width:49%;border-radius:40px;margin-top:-1.5rem;"><?php if (!$like3) echo '<i style="margin-right:0.5rem;font-weight: 400;" class="fa-thin fa-thumbs-up"></i>Like';
                                                                                                                                            else echo '<i style="margin-right:0.5rem;color:#2078F4" class="fa-solid fa-thumbs-up"></i>Liked'; ?></button>
                <button onclick="parent.location='#1212'" class="btn ButtonJolo normi" id="<?php echo $pid; ?>__" style="width:49%;border-radius:40px;margin-top:-1.5rem;"><i style="margin-right:0.5rem;" class="fa-regular fa-message"></i>Comment</button>
                <hr style="margin-top:-.3rem;">
            </div>
            <div class="flexx" style="margin-bottom:1rem">
                <a href="peopleprofile.php?pi=<?php echo $_SESSION['u_id']; ?>"> <img src="<?php echo $_SESSION['dp']; ?>" alt=""></a>
                <form autocomplete="off" method="post" id="<?php echo $pid; ?>--">
                    <input name="bindas" class="btn btn-light" style="width:28rem;margin-left:1rem;border-radius:40px;text-align: left;cursor:text" placeholder="Write a comment..." id="1212"></input>
                    <input name="done" type="submit" hidden></input>
                </form>
            </div>
            <div id="<?php echo $pid; ?>____"></div>
        </div>
    </div>


    <script src="js/nav.js"></script>
    <script src="js/navfetch.js"></script>
    <script>
        $(document).ready(function() {
            $(".view-more").click(function(e) {
                $("." + e.target.id).css("display", "flex");
                $("#" + e.target.id).css("display", "none");
            });
            $(".kirebhai").unbind().click(function() {
                var finalid = this.id;
                var ss = finalid + "-";
                $.ajax({
                    url: "grouplike.php",
                    method: "POST",
                    data: {
                        pid: finalid
                    },
                    cache: false,
                    success: function(data) {
                        console.log(data);
                        if (data == 'successfull')
                            $("#" + finalid).html("<i style='margin-right:0.5rem;color:#2078F4' class='fa-solid fa-thumbs-up'></i>" + 'Liked');
                        else if (data == 'deleted') $("#" + finalid).html("<i style='margin-right:0.5rem;font-weight: 400;' class='fa-thin fa-thumbs-up'></i>" + 'Like');
                    }
                });
                $.ajax({
                    url: "grouplike.php",
                    method: "POST",
                    data: {
                        poid: finalid
                    },
                    cache: false,
                    success: function(data) {
                        $('#' + ss).html(data);
                    }
                });

            });

            $('form').unbind().on('submit', function() {
                var fid = this.id;
                var dog = fid.split("--")[0];
                var postdata = $("#" + fid).serialize() + "&pid=" + dog;
                $.post("groupcomment.php", postdata, function(data) {
                    console.log(data);
                });

                $.ajax({
                    url: "groupcomment.php",
                    method: "POST",
                    data: {
                        droid: dog
                    },
                    cache: false,
                    success: function(data) {
                        if (data != "") {
                            $('#' + dog + '____').html("");
                            $('#' + dog + '____').append(data);
                        }
                    }
                });

                $.ajax({
                    url: "groupcomment.php",
                    method: "POST",
                    data: {
                        bhai: dog
                    },
                    cache: false,
                    success: function(data) {
                        $('#' + dog + "-----").html(data);
                    }
                });

                $("form").trigger('reset');
                return false;
            });
            $(".normi").unbind().click(function(e) {
                var normiid = this.id.split("__")[0];
                $.ajax({
                    url: "groupcomment.php",
                    method: "POST",
                    data: {
                        droid: normiid
                    },
                    cache: false,
                    success: function(data) {
                        if (data != "") {
                            $('#' + normiid + '____').html("");
                            $('#' + normiid + '____').append(data);
                        }
                        //    console.log(data);
                    }
                });

            });
        });
    </script>
</body>

</html>