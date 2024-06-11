<?php
session_start();
$pi = $_GET['pi'];
if ($pi === $_SESSION['u_id'])
    header("Location: profile.php");
$_SESSION['pi'] = $pi;
$con = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
include("php_util/isLogin.php");
$dow = check_login($con);
$namee = $dow['fname'] . ' ' . $dow['lname'];
$dpp = $dow['dp'];

$neu = "select *from user where u_id='$pi'";
$neu1 = mysqli_query($con, $neu);
$dow = mysqli_fetch_assoc($neu1);

$name = $dow['fname'] . ' ' . $dow['lname'];
$cover = $dow['cover'];
$dp = $dow['dp'];
$friend = $dow['friends'];
$bio = nl2br($dow['bio']);


$currentaddr = $dow['currentaddr'];
$permanentaddr = $dow['permanentaddr'];
$id_type = $dow['id_type'];
$gender = $dow['gender'];
$relationship = $dow['relationship'];
$university = $dow['university'];
$college = $dow['college'];
$primaryschool = $dow['primaryschool'];
$highschool = $dow['highschool'];

$dekho = "select *from user_friends where friendfrom=" . $_SESSION['u_id'] . " and friendto='$pi'";
$dekhores = mysqli_query($con, $dekho);
$arekbar = mysqli_query($con, $dekho);
$arekbarr = mysqli_query($con, $dekho);
$arekbarrr = mysqli_query($con, $dekho);
$arekbarrrr = mysqli_query($con, $dekho);


$chokh = "select *from requests where rqfrom=" . $_SESSION['u_id'] . " and rqto='$pi'";
$chokhres = mysqli_query($con, $chokh);

$cidami = "select *from requests where rqto=" . $_SESSION['u_id'] . " and rqfrom='$pi'";
$cidamires = mysqli_query($con, $cidami);

$fr = "select *from user NATURAL join (select friendto as u_id from user_friends where friendfrom='$pi')x where u_id<>'$pi'";
$fr2 = mysqli_query($con, $fr);
$fr0 = mysqli_query($con, $fr);


if (isset($_POST['baadde'])) {
    $q1 = "delete from user_friends where friendfrom=" . $_SESSION['u_id'] . " and friendto='$pi'";
    $q2 = "delete from user_friends where friendto=" . $_SESSION['u_id'] . " and friendfrom='$pi'";
    mysqli_query($con, $q1);
    mysqli_query($con, $q2);
    
    $frndcnt=mysqli_fetch_assoc(mysqli_query($con, "select friends from user where u_id=".$_SESSION['u_id'].""));
    $frndct=$frndcnt['friends']-1;
    mysqli_query($con, "update user set friends='$frndct' where u_id=".$_SESSION['u_id']."");

    $frndcnt=mysqli_fetch_assoc(mysqli_query($con, "select friends from user where u_id='$pi'"));
    $frndct=$frndcnt['friends']-1;
    mysqli_query($con, "update user set friends='$frndct' where u_id='$pi'");
    
    header("Location: peopleprofile.php?pi=$pi");
}
if (isset($_POST['reqpathao'])) {
    $doit = "select *from requests where rqfrom=" . $_SESSION['u_id'] . " and rqto='$pi'";
    $doitres = mysqli_query($con, $doit);
    if (mysqli_fetch_assoc($doitres)) {
        $ebarkor = "delete from requests where rqfrom=" . $_SESSION['u_id'] . " and rqto='$pi'";
        mysqli_query($con, $ebarkor);
    } else {
        $kkk = $_SESSION['u_id'];
        $ebarkor = "insert into requests(rqfrom, rqto) values('$kkk','$pi' )";
        mysqli_query($con, $ebarkor);
        date_default_timezone_set('Asia/Dhaka');
        $ndate = date('Y-m-d');
        $ntime = date('H:i:s');
        mysqli_query($con, "insert into notifications(type, sender, senderentity, ndate, ntime, u_id) values('sent','$kkk','$kkk','$ndate','$ntime','$pi')");
    }
    header("Location: peopleprofile.php?pi=$pi");
}

if (isset($_POST['confirmkoro'])) {

    $ebarkor = "delete from requests where rqto=" . $_SESSION['u_id'] . " and rqfrom='$pi'";
    mysqli_query($con, $ebarkor);

    $kkk = $_SESSION['u_id'];
    date_default_timezone_set('Asia/Dhaka');
    $ndate = date('Y-m-d');
    $ntime = date('H:i:s');
    mysqli_query($con, "insert into notifications(type, sender, senderentity, ndate, ntime, u_id) values('accepted','$kkk','$kkk','$ndate','$ntime','$pi')");
    $query1 = "insert into user_friends(friendfrom, friendto) values('$kkk','$pi')";
    mysqli_query($con, $query1);

    $query2 = "insert into user_friends(friendto, friendfrom) values('$kkk','$pi')";
    mysqli_query($con, $query2);
    
    $frndcnt=mysqli_fetch_assoc(mysqli_query($con, "select friends from user where u_id=".$_SESSION['u_id'].""));
    $frndct=$frndcnt['friends']+1;
    mysqli_query($con, "update user set friends='$frndct' where u_id=".$_SESSION['u_id']."");

    $frndcnt=mysqli_fetch_assoc(mysqli_query($con, "select friends from user where u_id='$pi'"));
    $frndct=$frndcnt['friends']+1;
    mysqli_query($con, "update user set friends='$frndct' where u_id='$pi'");
    
    header("Location: peopleprofile.php?pi=$pi");
}
if (isset($_POST['deletekoro'])) {
    $ebarkor = "delete from requests where rqto=" . $_SESSION['u_id'] . " and rqfrom='$pi'";
    mysqli_query($con, $ebarkor);
    header("Location: peopleprofile.php?pi=$pi");
}
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php echo $name; ?> | JUSE</title>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/profile.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link rel="icon" href="images/icob.svg">

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
                                <img src="<?php if (!empty($dpp)) echo $dpp;
                                            else echo "images/defaultdp.png"; ?>" alt="">
                                <small style="margin-left: .5rem; font-weight:500; width:80px;white-space: nowrap;overflow: hidden !important;text-overflow: ellipsis;"> <?php echo $namee ?></small>
                            </div>
                        </a> </li>
                    <li id="logout250" class="nav-item f bg-d bc"><a class="nav-link text-dark" href="#"> <i class="fas fa-sign-out-alt text-dark fa-lg"></i> </a> </li>
                </ul>

            </div> <!-- navbar-collapse.// -->
        </div> <!-- container-fluid.// -->
    </nav>




    <div class="container" style="max-width: 1100px">
        <section class="basic-intro">
            <a href="#"><img src="<?php if (!empty($cover)) echo $cover;
                                    else echo "images/default-cover.png"; ?>" alt="Cover Photo"></a>
            <div class="biodata">
                <div class="left">
                    <a href="#"><img src="<?php if (!empty($dp)) echo $dp;
                                            else echo "images/defaultdp.png"; ?>" alt="Profile Picture"></a>
                </div>
                <div class="right">
                    <h2><b><?php echo $name; ?></b></h2>
                    <b class="text-dark"><?php echo $friend; ?> Friends</b><?php if (empty($bio)) echo "<br><br>"; ?>
                    <p style="display: <?php if (empty($bio)) echo "none";
                                        else echo "block"; ?>;" class="text-secondary"><?php echo $bio; ?></p>


                    <div style="display: flex;">
                        <?php
                        if (mysqli_fetch_assoc($arekbar)) {
                            echo '<button data-bs-toggle="modal" data-bs-target="#myDal" class="btn btn-secondary"><i class="fas fa-user-check" style="margin-right:5px;"></i>Friends</button>';
                        } else {
                            echo '<form action="" method="post">';
                            if (mysqli_fetch_assoc($cidamires)) echo ' <div class="btn-group">
                            <button class="btn btn-secondary dropdown-toggle" style="width:10rem;" type="button" id="defaultDropdown"
                                data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                                <i class="fas fa-user-check" style="margin-right:5px;"></i>Respond
                            </button>
                            <ul class="dropdown-menu" style="width:10rem;"  aria-labelledby="defaultDropdown">
                                <li><button type="submit" name="confirmkoro" style="width:10rem;"  class="dropdown-item">Confirm</button></li>
                                <li><button type="submit" name="deletekoro" style="width:10rem;"  class="dropdown-item">Delete request</button></li>
                            </ul>
                        </div>';
                            else {
                                if (mysqli_fetch_assoc($chokhres)) echo '<button type="submit" name="reqpathao"  class="btn btn-primary" style="width:10rem;"><i class="fas fa-user-minus" style="margin-right:5px;"></i>Cancel Request</button>';
                                else echo '<button type="submit" name="reqpathao"  class="btn btn-primary" style="width:10rem;"><i class="fa fa-user-plus" style="margin-right:5px;"></i>Add Friend</button>';
                            }
                            echo '</form>';
                        }
                        ?>
                        <?php
                        if (mysqli_fetch_assoc($arekbarrr)) {
                            echo '<button onclick=window.location.href="chat.php?u_id=' . $pi . '" class="btn btn-primary x"><i class="fab fa-facebook-messenger" style="margin-right:5px;"></i>Message</button>';
                        } ?>
                    </div>
                    <div style="margin-top:8rem;" class="modal fade" id="myDal" tabindex="-1" aria-labelledby="myDalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="unfollow">
                                        <img src="<?php if (!empty($dp)) echo $dp;
                                                    else echo "images/defaultdp.png"; ?>" alt="">
                                        <p>Unfriend <?php echo $name; ?>?</p>
                                    </div>
                                    <form action="" method="post">
                                        <hr class="new1">
                                        <input name="baadde" style="margin-left:11rem;background-color:transparent;outline:none;border:none;color:rgb(165, 37, 37);font-size: 1.5rem;text-align:center;" type="submit" value="Unfriend">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" style="margin-right:11rem;background-color: transparent;outline:none;border:none;color:rgb(0, 0, 0);font-size: 1.5rem;text-align:center;" data-bs-dismiss="modal">Cancel</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="false">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Friends</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-photos-tab" data-toggle="pill" href="#pills-photos" role="tab" aria-controls="pills-photos" aria-selected="false">Photos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-videos-tab" data-toggle="pill" href="#pills-videos" role="tab" aria-controls="pills-videos" aria-selected="false">Videos</a>
                </li>
            </ul>
        </section>

    </div>
    <section class="data">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="row">
                    <div class="col-5" style="padding-bottom:2rem;">
                        <div class="row" style="padding-bottom:2rem;">
                            <h4><b>Intro</b></h4>
                            <h6><i class='fas fa-school' style="margin-right:1rem;"></i><span>Studies at </span><?php echo $university; ?></h6>
                            <h6><i class='fas fa-graduation-cap' style="margin-right:1rem;"></i><span>Studied at
                                </span><?php echo $college; ?></h6>
                            <h6><i class='fas fa-home' style="margin-right:1rem;"></i><span>Lives in </span><?php echo $currentaddr; ?></h6>
                            <h6><i class='fa fa-map-marker' style="margin-right:1rem;"></i><span>From </span><?php echo $permanentaddr; ?></h6>
                            <h6><i class='fa fa-heart' style="margin-right:1rem;"></i><?php echo $relationship; ?></h6>
                        </div>
                        <div class="row" style="margin-top:2rem;padding-bottom:2rem;max-height: 400px;">
                            <div class="flexx">
                                <h4><b>Photos</b></h4>
                                <p id="seephotos">See all photos</p>
                            </div>
                            <div class="card-wrapper">
                                <?php
                                if (mysqli_fetch_assoc($dekhores)) {
                                    $gone = "select *from userpost natural join userpost_photos where u_id='$pi' order by pid desc limit 9";
                                    $gone2 = mysqli_query($con, $gone);

                                    while ($gone3 = mysqli_fetch_array($gone2)) {
                                        echo ' <a href="post_view.html"> <img src="' . $gone3['location'] . '" alt=""></a>';
                                    }
                                } else echo '<div style="margin-top:2rem;font-weight:500;width:350px;text-align:center;">No photos available for you.</div>';
                                ?>
                            </div>
                        </div>
                        <div class="row" style="margin-top:2rem;padding-bottom:2rem;max-height: 400px;">
                            <div class="flexx">
                                <h4><b>Friends</b></h4>
                                <p id="seefriend">See all friends</p>
                            </div>
                            <div class="card-wrapper">
                                <?php while ($fr3 = mysqli_fetch_array($fr2)) {
                                    echo '  <div class="card">
                              <img src="';
                                    if (!empty($fr3['dp'])) echo $fr3['dp'];
                                    else echo 'images/defaultdp.png';
                                    echo '" alt="">
                                    <a href="peopleprofile.php?pi=' . $fr3["u_id"] . '">' . $fr3['fname'] . ' ' . $fr3['lname'] . '</a>
                                </div>';
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div id="sc" class="col-7" style="max-height: 1200px;overflow: scroll;">
                        <div class="row" style="margin-bottom:2rem;">
                            <h4>Posts</h4>
                        </div>
                        <div id="load_data"></div>
                        <?php
                        if (!mysqli_fetch_assoc($arekbarr)) {
                            echo '<div style="margin-top:8rem;font-weight:500;text-align:center;">No post available for you.</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div id="dhukao" class="row" style="padding:1rem 0rem;">
                </div>
            </div>

            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div class="row" style="padding:1rem 0rem;">
                    <div class="col-11" style="padding:1rem 1rem;background-color: rgb(255, 255, 255);border-radius: 10px;">
                        <div class="friendsintro">
                            <div class="left">
                                <h4>Friends</h4>
                            </div>
                            <div class="right">
                                <form action="">
                                    <input id="khojkoro" type="text" required placeholder="Search"></input>
                                </form>

                            </div>
                        </div>
                        <div class="parentfr" id="frienddau">

                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-photos" role="tabpanel" aria-labelledby="pills-photos-tab">
                <div class="row" style="padding:1rem 0rem;">
                    <div class="col-11" style="padding:1rem 1rem;background-color: rgb(255, 255, 255);border-radius: 10px;">
                        <div class="friendsintro">
                            <div class="left">
                                <h4>Photos</h4>
                            </div>

                        </div>
                        <div class="photopar" id="photodau">
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-videos" role="tabpanel" aria-labelledby="pills-videos-tab">
                <div class="row" style="padding:1rem 0rem;">
                    <div class="col-11" style="padding:1rem 1rem;background-color: rgb(255, 255, 255);border-radius: 10px;">
                        <div class="friendsintro">
                            <div class="left">
                                <h4>Videos</h4>
                            </div>

                        </div>
                        <div class="photopar" id="videodau">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="js/navfetch.js"></script>
    <script src="js/peopleprofile.js"></script>
    <script src="js/nav.js"></script>
</body>

</html>