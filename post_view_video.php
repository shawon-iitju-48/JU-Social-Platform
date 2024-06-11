<?php
session_start();
$con = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
include("php_util/isLogin.php");
$dow = check_login($con);
$name = $dow['fname'] . ' ' . $dow['lname'];
$dp = $dow['dp'];
$pid = $_GET['pidd'];
$q1 = "select *from userpost natural join user natural join userpost_videos where pid='$pid'";
$subres1 = mysqli_query($con, $q1);

$res1 = mysqli_fetch_assoc($subres1);
$res2 = mysqli_query($con, $q1);;
$hostid = $res1['u_id'];
$hostdp = $res1['dp'];
$hostname = $res1['fname'] . ' ' . $res1['lname'];
$post = $res1['pdetails'];
$postlocation = $res1['location'];
$posttime = $res1['ptime'];
$postdate = $res1['pdate'];
$postlike = $res1['likecount'];
$postcomment = $res1['commentcnt'];

$like1 = "select *from userpost_likes where u_id=" . $_SESSION['u_id'] . " and pid='$pid'";
$like2 = mysqli_query($con, $like1);
$like3 = mysqli_fetch_array($like2);

if (isset($_POST['postupdate'])) {
    $postd = $_POST['edit-post'];
    $q2 = "update userpost set pdetails='$postd' where pid='$pid'";
    mysqli_query($con, $q2);
    header("Location: post_view.php?pidd=$pid");
}

?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>JUSE</title>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/post_view.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="images/icob.svg">

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

    <div class="row first">
        <div class="col-9">
            <div class="head">
                <div class="left">
                    <button onclick="history.back()" class="close" style="background:transparent;color:white;outline: none;border:none;margin-left:-1.3rem;margin-top:-2rem;font-size: 3rem;">&times;</button>
                </div>
                <div class="right">
                    <button onclick="openFullscreen();" style="background-color: transparent;outline: none;border:none;margin-right:-1.5rem;margin-top:-1rem;"><i class="fa fa-expand" style="font-size:2rem;color:rgb(255, 255, 255);"></i></button>
                </div>
            </div>
            <div style="margin-top:-3.6rem;position: relative;" id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
                <div class="carousel-inner">
                    <?php
                    $row = mysqli_fetch_array($res2);
                    echo '<div class="carousel-item active" >
                    <video id="' . $row['videosid'] . '" class="' . $row['pid'] . '" src="' . $row['location'] . '" width="100%" height="590" controls></video>
                    </div>';
                    while ($row = mysqli_fetch_array($res2)) {
                        echo '
                        <div class="carousel-item" >
                        <video id="' . $row['videosid'] . '" class="' . $row['pid'] . '" src="' . $row['location'] . '" width="100%" height="590" controls></video>
                        </div>';
                    }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="col-3">



            <div class="modal fade" style="width: 325px;margin-left:64.5rem;margin-top:6rem;" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- <button type="button" style="margin-left:18rem;margin-top:1rem;" class="btn-close"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="modal-body">
                            <form action="">
                                <input class="btn btn-secondary" style="width:18rem" type="submit"
                                    value="Delete this post">

                            </form>
                        </div> -->
                        <div class="modal-body">
                            <!-- <hr class="new1"> -->
                            <button id="shawon" style="margin-left:3.5rem;background-color:transparent;outline:none;border:none;color:rgb(165, 37, 37);font-size: 1.5rem;text-align:center;" type="submit">Delete this post</button>

                        </div>
                        <div class="modal-footer">
                            <button type="button" style="margin-right:7rem;background-color: transparent;outline:none;border:none;color:rgb(0, 0, 0);font-size: 1.5rem;text-align:center;" data-bs-dismiss="modal">Cancel</button>
                        </div>

                    </div>
                </div>
            </div>





            <div class="gayeb">
                <div class="matha">
                    <div class="left">
                        <a href="peopleprofile.php?pi=<?php echo $hostid; ?>"><img src="<?php echo $hostdp; ?>" alt=""></a>
                    </div>
                    <div class="right">
                        <a href="peopleprofile.php?pi=<?php echo $hostid; ?>"><b><?php echo $hostname; ?></b></a>
                        <p style="font-size: .8rem;"><?php echo $postdate; ?> at <?php echo $posttime; ?></p>
                    </div>
                    <?php if ($hostid == $_SESSION['u_id'])
                        echo '   <div class="another">
                    <button style="border:none; background:transparent;outline:none;" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fas fa-bars"></i></button>
                </div>';
                    ?>

                </div>
                <p><?php echo nl2br($post); ?></p>
                <?php if ($hostid == $_SESSION['u_id'])
                echo '<button id="edit-koro" class="btn btn-secondary">Edit</button>';
                ?>
            </div>
            <div class="edit-post-form">
                <form action="" method="post">
                    <textarea style="border: 2px solid gray;border-radius: 5px;margin-bottom:.5rem;" name="edit-post" id="edit-post" cols="40" rows="5"><?php echo $post; ?></textarea>
                    <input type="submit" name="postupdate" class="btn btn-primary" value="Done Editing"></input>
                </form>
                <button id="edit-post-btn" style="margin-left:9rem;margin-top: -4.1rem;" class="btn btn-secondary">Cancel</button>
            </div>
            <div class="like" style="margin-bottom:-.8rem;">
                <div class="left">
                    <h6><i style="margin-right:0.5rem;font-weight: 400;color:#2078F4" class="fa-duotone fa-thumbs-up"></i><span id="<?php echo $pid; ?>-"><?php echo $postlike; ?></span>

                    </h6>
                </div>
                <div class="right">
                    <p><b><span id="<?php echo $pid; ?>-----"><?php echo $postcomment; ?></span>
                            Comments</b></p>
                </div>
            </div>
            <div class="agao">
                <hr>
                <button id="<?php echo $pid; ?>" class="btn ButtonJolo kirebhai" style="width:49%;border-radius:40px;margin-top:-1.5rem;"><?php if (!$like3) echo '<i style="margin-right:0.5rem;font-weight: 400;" class="fa-thin fa-thumbs-up"></i>Like';
                                                                                                                                            else echo '<i style="margin-right:0.5rem;color:#2078F4" class="fa-solid fa-thumbs-up"></i>Liked'; ?></button>
                <button onclick="parent.location='#1212'" class="btn ButtonJolo normi" id="<?php echo $pid; ?>__" style="width:49%;border-radius:40px;margin-top:-1.5rem;"><i style="margin-right:0.5rem;" class="fa-regular fa-message"></i>Comment</button>
                <hr style="margin-top:-.3rem;">
            </div>

            <div id="<?php echo $pid; ?>____">
            </div>
            <div class="btm" style="margin-bottom:1rem">
                <a href="peopleprofile.php?pi=<?php echo $_SESSION['u_id']; ?>"> <img src="<?php echo $_SESSION['dp']; ?>" alt=""></a>
                <form autocomplete="off" method="post" id="<?php echo $pid; ?>--">
                    <input name="bindas" class="btn btn-light" style="width:15rem;margin-left:.5rem;border-radius:40px;text-align: left;cursor:text" placeholder="Write a comment..." id="1212"></input>
                    <input name="done" type="submit" hidden></input>
                </form>
            </div>

        </div>
    </div>

    <script src="js/post_view.js"></script>
    <script src="js/nav.js"></script>
    <script src="js/navfetch.js"></script>
</body>

</html>