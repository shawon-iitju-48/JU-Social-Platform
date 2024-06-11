<?php
session_start();
$con = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
include("php_util/isLogin.php");
$dow = check_login($con);
$uid = $dow['u_id'];
$name = $dow['fname'] . ' ' . $dow['lname'];
$cover = $dow['cover'];
$dp = $dow['dp'];
$friend = $dow['friends'];
$bio = $dow['bio'];


$currentaddr = $dow['currentaddr'];
$permanentaddr = $dow['permanentaddr'];
$id_type = $dow['id_type'];
$gender = $dow['gender'];
$relationship = $dow['relationship'];
$university = $dow['university'];
$college = $dow['college'];
$primaryschool = $dow['primaryschool'];
$highschool = $dow['highschool'];

$gone = "select dp, fname, lname,u_id from user NATURAL join (select friendto as u_id from user_friends where friendfrom='$uid')x where u_id<>'$uid'";
$gone2 = mysqli_query($con, $gone);


if (isset($_POST['createpost'])) {

    $pdetails = $_POST['upost'];
    date_default_timezone_set('Asia/Dhaka');
    $monthNum = date('m');
    $monthName = date("F", mktime(0, 0, 0, $monthNum, 10));
    $pdate = $monthName . ' ' . date('d') . ', ' . date('Y');
    $ptime = date('h:i A');
    $q = "select pid from userpost order by pid desc limit 1";

    $r = mysqli_query($con, $q);
    if ($xs = mysqli_fetch_array($r))
        $pid = $xs['pid'] + 1;
    else $pid = 1;

    $query1 = "insert into userpost(pid,pdate, ptime, pdetails, u_id) values('$pid','$pdate','$ptime','$pdetails','$uid');";
    mysqli_query($con, $query1);

    $filecount = count($_FILES['ufile']['name']);
    for ($i = 0; $i < $filecount; $i++) {

        $fileName = $_FILES["ufile"]["name"][$i];
        $tempname = $_FILES["ufile"]["tmp_name"][$i];
        $extension = strtolower(substr(strrchr($fileName, '.'), 1));

        if ($extension == "mp4" || $extension == "MP4" || $extension == "mkv" || $extension == "MKV") {
            $newfilename = $pid . rand() . "_" . $fileName;
            $folder = "posts/videos/" . $newfilename;
            $query2 = "insert into userpost_videos(location, pid) values('$folder','$pid')";
            mysqli_query($con, $query2);
            move_uploaded_file($tempname, $folder);
        } else if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "gif") {
            $newfilename = $pid . rand() . "_" . $fileName;
            $folder = "posts/photos/" . $newfilename;
            $query3 = "insert into userpost_photos(location, pid) values('$folder','$pid')";
            mysqli_query($con, $query3);
            move_uploaded_file($tempname, $folder);
        }
    }
    header("Location: home.php");
}
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>JUSE</title>
      <link rel="icon" href="images/icob.svg">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/home.css">
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

    <!-- ============= COMPONENT ============== -->
    <!-- sign up er shomoy user er shathe nijer friend banate hobe. 2001-2001 -->
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
                    <li id="home250" class="nav-item f bc"><a class="nav-link text-dark hover-underline-animation " href="home.php"> <i class="fas fa-home text-dark fa-lg"></i> </a> </li>
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
    <!-- ============= COMPONENT END// ============== -->



    <section class="data">
        <div class="row">
            <div class="col-5 side" style="padding-bottom:2rem;">
                <a href="profile.php">
                    <div class="sidebar">
                        <div class="left">
                            <img src="<?php if (!empty($dp)) echo $dp;
                                        else echo "images/defaultdp.png"; ?>" alt="">
                        </div>
                        <div class="right">
                            <p><?php echo $name; ?></p>
                        </div>
                    </div>
                </a>
                <a href="friends.php">
                    <div class="sidebar" style="margin-top:-.2rem;">
                        <div class="left">
                            <i class="fas fa-user-friends" style="font-size: 1.5rem;color:blueviolet"></i>
                        </div>
                        <div class="right" style="margin-top:-.01rem;">
                            <p>Friends</p>
                        </div>
                    </div>
                </a>
                <a href="groupfeed.php">
                    <div class="sidebar" style="margin-top:-.2rem;">
                        <div class="left">
                            <i class="fa fa-users" style="font-size: 1.5rem;color: lightblue;"></i>
                        </div>
                        <div class="right" style="margin-top:-.01rem;">
                            <p>Groups</p>
                        </div>
                    </div>
                </a>
                <a href="users.php">
                    <div class="sidebar" style="margin-top:-.2rem;">
                        <div class="left">
                            <i class="fab fa-facebook-messenger" style="font-size: 1.8rem;color:rgb(75, 4, 4)"></i>
                        </div>
                        <div class="right" style="margin-top:-.01rem;">
                            <p>Messenger</p>
                        </div>
                    </div>
                </a>
                <a href="others/user_type.php">
                    <div class="sidebar" style="margin-top:-.2rem;">
                        <div class="left">
                            <i class="fas fa-chalkboard-teacher" style="font-size: 1.5rem;color:green"></i>
                        </div>
                        <div class="right" style="margin-top:-.01rem;">
                            <p>Classroom</p>
                        </div>
                    </div>
                </a>
                <a href="others/notices.php">
                    <div class="sidebar" style="margin-top:-.2rem;">
                        <div class="left">
                            <i class="fa-solid fa-bells" style="font-size: 1.5rem;color:purple"></i>
                        </div>
                        <div class="right" style="margin-top:-.01rem;">
                            <p>Notices</p>
                        </div>
                    </div>
                </a>
            </div>
            <div id="sc" class="col-7">
                <div class="row" style="margin-bottom:2rem;">
                    <div id="extra" class="flexx" style="margin-bottom:1rem">
                        <a href=""> <img src="<?php if (!empty($dp)) echo $dp;
                                                else echo "images/defaultdp.png"; ?>" alt=""></a>
                        <button id="depost" type="button" class="btn btn-secondary" style="width:100%;margin-left:2rem;border-radius:40px;" data-bs-toggle="modal" data-bs-target="#exampleModal">What's on your
                            mind?</button>

                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="top:4rem;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create Post</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="modalpic">
                                            <div class="left">
                                                <a href="#"><img src="<?php if (!empty($dp)) echo $dp;
                                                                        else echo "images/defaultdp.png"; ?>" alt=""></a>
                                            </div>
                                            <div class="right">
                                                <b><?php echo $name; ?></b>
                                                <p><i class="fas fa-user-check" style="margin-right:5px;"></i>Friends</p>
                                            </div>
                                        </div>
                                        <form method="post" enctype="multipart/form-data">
                                            <textarea name="upost" id="post" cols="60" rows="10" placeholder="What's on your mind?" required style="margin-bottom: .5rem;"></textarea>
                                            <div class="mb-3 photomodal">

                                                <input name="ufile[]" class="form-control" type="file" id="formFile" multiple>
                                            </div>
                                            <input type="submit" class="btn btn-primary" value="Post" name="createpost" style="width:100%;margin:.7rem 0rem;"></input>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>
                    <hr>
                    <button id="photos" class="btn ButtonJolo" style="width:50%;border-radius:40px;" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-image" style="margin-right:.5rem;font-size:1rem;"></i>Upload Photos</button>
                    <button id="videos" class="btn ButtonJolo" style="width:50%;border-radius:40px;" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-video" style="margin-right:.5rem;font-size:1rem;"></i>Upload
                        Videos</button>
                </div>
                <div id="load_data"></div>
                <!-- <div class="row" style="margin-bottom:1rem;">
                    <div class="posthead">
                        <div class="left">
                            <a href="#"><img src="images/dp.jpg" alt=""></a>

                        </div>
                        <div class="right">
                            <a href="#"><b>Apurbo Shahid Shawon</b></a> updated his cover photo.
                            <p style="font-size: .8rem;">February 4 at 9:34 PM</p>
                        </div>
                    </div>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit necessitatibus dolorem
                        blanditiis laudantium, earum totam eum ipsam accusamus doloribus aspernatur!</p>
                    <div class="divide">
                        <a href="post_view.html"><img src="images/dp.jpg" class="postphoto" alt=""></a>
                        <div class="icoin">
                            <i class="fas fa-arrow-right"
                                style="font-size:1.5rem;color:rgb(138, 123, 123);background:#f7f7f7;border-radius: 100%;padding:3px 3px;"></i>
                        </div>
                    </div>


                    <div class="like">
                        <div class="left">
                            <h6><i class='fa fa-heart'
                                    style="margin-right:.3rem;margin-top:1rem;color:rgb(255, 0, 0)"></i>23 Likes
                            </h6>
                        </div>
                        <div class="right">
                            <p><b><i class='fas fa-comments'
                                        style="margin-right:.3rem;margin-top:1rem;color:rgb(255, 208, 0)"></i>8
                                    Comments</b></p>
                        </div>
                    </div>
                    <hr>
                    <button class="btn ButtonJolo" style="width:50%;border-radius:40px;margin-top:-1rem;"><i
                            class="fas fa-heart"
                            style="margin-right:.5rem;color:rgb(255, 0, 0);font-size:1rem;"></i>Like</button>
                    <button onclick="parent.location='#1212'" class="btn ButtonJolo"
                        style="width:50%;border-radius:40px;margin-top:-1rem;"><i class="fas fa-comments"
                            style="margin-right:.5rem;color:rosybrown;font-size:1rem;"></i>Comment</button>
                    <hr>
                    <div class="flexx" style="margin-bottom:1rem">
                        <a href=""> <img src="images/dp.jpg" alt=""></a>
                        <form action="">
                            <input class="btn btn-light"
                                style="width:25rem;margin-left:1rem;border-radius:40px;text-align: left;cursor:text"
                                placeholder="Write a comment..." id="1212"></input>
                            <input type="submit" hidden></input>
                        </form>
                    </div>
                    <div class="comment">
                        <div class="left">
                            <a href="#"><img src="images/dp1.jpg" alt=""></a>
                        </div>
                        <div class="right">
                            <a href="#"><b>Arnab Purkayastha</b></a>
                            <p style="font-size: .8rem;margin-bottom: .5rem;">February 4 at 9:34 PM</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem magnam commodi animi
                                sapiente mollitia dolores earum tempora placeat blanditiis corrupti!</p>
                        </div>
                    </div>
                    <div class="comment">
                        <div class="left">
                            <a href="#"><img src="images/dp1.jpg" alt=""></a>
                        </div>
                        <div class="right">
                            <a href="#"><b>Arnab Purkayastha</b></a>
                            <p style="font-size: .8rem;margin-bottom: .5rem;">February 4 at 9:34 PM</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem magnam commodi animi
                                sapiente mollitia dolores earum tempora placeat blanditiis corrupti!</p>
                        </div>
                    </div>
                    <p class="view-more" id="12">View 14 more comments</p>
                    <div class="comment 12" style="display:none;">
                        <div class="left">
                            <a href="#"><img src="images/dp1.jpg" alt=""></a>
                        </div>
                        <div class="right">
                            <a href="#"><b>Arnab Purkayastha</b></a>
                            <p style="font-size: .8rem;margin-bottom: .5rem;">February 4 at 9:34 PM</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem magnam commodi animi
                                sapiente mollitia dolores earum tempora placeat blanditiis corrupti!</p>
                        </div>
                    </div>
                    <div class="comment 12" style="display:none;">
                        <div class="left">
                            <a href="#"><img src="images/dp1.jpg" alt=""></a>
                        </div>
                        <div class="right">
                            <a href="#"><b>Arnab Purkayastha</b></a>
                            <p style="font-size: .8rem;margin-bottom: .5rem;">February 4 at 9:34 PM</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem magnam commodi animi
                                sapiente mollitia dolores earum tempora placeat blanditiis corrupti!</p>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="col-3 con">
                <h5>Contacts</h5>
                <?php while ($gone3 = mysqli_fetch_array($gone2)) {
                    echo '
                <a href="chat.php?u_id=' . $gone3['u_id'] . '">
                    <div class="sidebar">
                        <div class="left">
                            <img src="';
                    if (!empty($gone3['dp'])) echo $gone3['dp'];
                    else echo 'images/defaultdp.png';
                    echo '" alt="">
                        </div>
                        <div class="right">
                            <p>' . $gone3['fname'] . ' ' . $gone3['lname'] . '</p>
                        </div>
                    </div>
                </a>';
                }
                ?>
            </div>
        </div>
    </section>
    <script src="js/home.js"></script>
    <script src="js/nav.js"></script>
    <script src="js/navfetch.js"></script>
</body>

</html>