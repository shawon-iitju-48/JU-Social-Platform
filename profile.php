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

$gone = "select *from userpost natural join userpost_photos where u_id='$uid' order by pid desc limit 9";
$gone2 = mysqli_query($con, $gone);


$fr = "select *from user NATURAL join (select friendto as u_id from user_friends where friendfrom='$uid')x where u_id<>'$uid' limit 6";
$fr2 = mysqli_query($con, $fr);
$fr0 = mysqli_query($con, $fr);


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
    header("Location: profile.php");
}

if (isset($_POST['diyedau'])) {

    if (!empty($_FILES["dpneu"]["name"])) {
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
        $query1 = "insert into userpost(pid,pdate, ptime, u_id) values('$pid','$pdate','$ptime','$uid');";
        mysqli_query($con, $query1);


        $fileName = $_FILES["dpneu"]["name"];
        $tempname = $_FILES["dpneu"]["tmp_name"];
        $extension = strtolower(substr(strrchr($fileName, '.'), 1));
        $newfilename = $pid . rand() . "_" . $fileName;
        $folder = "posts/photos/" . $newfilename;
        $_SESSION['dp']=$folder;
        $query3 = "insert into userpost_photos(location, pid) values('$folder','$pid')";
        mysqli_query($con, $query3);
        move_uploaded_file($tempname, $folder);

        $query4 = "update user set dp='$folder' where u_id='$uid'";
        mysqli_query($con, $query4);
    }
    if (!empty($_FILES["coverneu"]["name"])) {

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
        $query1 = "insert into userpost(pid,pdate, ptime, u_id) values('$pid','$pdate','$ptime','$uid');";
        mysqli_query($con, $query1);


        $fileName = $_FILES["coverneu"]["name"];
        $tempname = $_FILES["coverneu"]["tmp_name"];
        $extension = strtolower(substr(strrchr($fileName, '.'), 1));
        $newfilename = $pid . rand() . "_" . $fileName;
        $folder = "posts/photos/" . $newfilename;
        $query3 = "insert into userpost_photos(location, pid) values('$folder','$pid')";
        mysqli_query($con, $query3);
        move_uploaded_file($tempname, $folder);

        $query4 = "update user set cover='$folder' where u_id='$uid'";
        mysqli_query($con, $query4);
    }

    $aboutneu = $dow['about'];
    if (!empty($_POST['aboutneu']))
        $aboutneu = $_POST['aboutneu'];

    $bioneu  = $dow['bio'];
    if (!empty($_POST['bioneu']))
        $bioneu  = $_POST['bioneu'];


    $universityneu = $dow['university'];
    if (!empty($_POST['universityneu']))
        $universityneu = $_POST['universityneu'];

    $collegeneu = $dow['college'];
    if (!empty($_POST['collegeneu']))
        $collegeneu = $_POST['collegeneu'];

    $currentaddrneu = $dow['currentaddr'];
    if (!empty($_POST['currentaddrneu']))
        $currentaddrneu = $_POST['currentaddrneu'];

    $permanentaddrneu = $dow['permanentaddr'];
    if (!empty($_POST['permanentaddrneu']))
        $permanentaddrneu = $_POST['permanentaddrneu'];

    $relationshipneu = $dow['relationship'];
    if (!empty($_POST['relationshipneu']))
        $relationshipneu = $_POST['relationshipneu'];


    $highschoolneu = $dow['highschool'];
    if (!empty($_POST['highschoolneu']))
        $highschoolneu = $_POST['highschoolneu'];

    $primaryschoolneu  = $dow['primaryschool'];
    if (!empty($_POST['primaryschoolneu']))
        $primaryschoolneu  = $_POST['primaryschoolneu'];


    $dobneu = $dow['dob'];
    if (!empty($_POST['dobneu']))
        $dobneu = $_POST['dobneu'];

    $bgneu = $dow['bg'];
    if (!empty($_POST['bgneu']))
        $bgneu = $_POST['bgneu'];

    $aboutneu = $dow['about'];
    if (!empty($_POST['aboutneu']))
        $aboutneu = $_POST['aboutneu'];

    $emailneu = $dow['email'];
    if (!empty($_POST['emailneu']))
        $emailneu = $_POST['emailneu'];

    $phoneneu = $dow['phone'];
    if (!empty($_POST['phoneneu']))
        $phoneneu = $_POST['phoneneu'];

    $genderneu = $dow['gender'];
    if (!empty($_POST['genderneu']))
        $genderneu = $_POST['genderneu'];

    $one = "update user set about='$aboutneu', bio='$bioneu',university='$universityneu', college='$collegeneu ',
    currentaddr='$currentaddrneu', permanentaddr='$permanentaddrneu',relationship='$relationshipneu',
    gender='$genderneu',phone='$phoneneu',email='$emailneu',
    bg='$bgneu',dob='$dobneu',primaryschool='$primaryschoolneu',highschool='$highschoolneu' where u_id='$uid'";
    mysqli_query($con, $one);
    header("Location: profile.php");
}

?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="images/icob.svg">
    <title><?php echo $name; ?> | JUSE</title>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/profile.css">
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

    <!-- ============= COMPONENT ============== -->
    <nav id="navbar_top" class="navbar navbar-expand-lg navbar-dark bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand text-dark" id="brandd" href="home.php"><img style="transform: scale(2.5);height:20px;width:20px;object-fit:fill;border-radius: 50%;" src="images/logo.png" alt="JUSE"></a>
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
                    <li id="notification250" class="nav-item f bg-d bc"><a class="nav-link text-dark" href="#"> <i class="fas fa-bell text-dark fa-lg"></i> </a> <span id="kotonoti"></span></li>
                    <li id="user250" style="background-color: aliceblue;;border-radius:10px;" class="nav-item foru bg-d"><a class="nav-link text-dark" href="profile.php">
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

                    <div class="modal fade " id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="col-12 modal-title text-center" id="myModalLabel"><span class="gai">Edit
                                            Intro</span><span class="fai">Edit Profile </span></h5>
                                    <button style="margin-left:-5rem;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div id="amarshona">

                                </div>
                            </div>
                        </div>
                    </div>


                    <button id="bhnn" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-secondary"><i class="fas fa-edit" style="margin-right:5px;"></i>Edit
                        Profile</button>
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
                            <button data-bs-toggle="modal" data-bs-target="#myModal" id="bhon" class="btn btn-secondary" style="margin-left:2.3rem;width:80%;">Edit
                                Details</button>
                        </div>
                        <div class="row" style="margin-top:2rem;padding-bottom:2rem;max-height: 400px;">
                            <div class="flexx">
                                <h4><b>Photos</b></h4>
                                <p id="seephotos">See all photos</p>
                            </div>
                            <div class="card-wrapper">
                                <?php while ($gone3 = mysqli_fetch_array($gone2)) {
                                    echo ' <a href="post_view.php?pidd=' . $gone3['pid'] . '"> <img src="' . $gone3['location'] . '" alt=""></a>';
                                }
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
                                    <a href="peopleprofile.php?pi='.$fr3["u_id"].'">' . $fr3['fname'] . ' ' . $fr3['lname'] . '</a>
                                </div>';
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div id="sc" class="col-7" style="max-height: 1200px;overflow: scroll;">
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
                                <a href="#">Find Friends</a>
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
                        <div class="photoparr" id="videodau">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="js/navfetch.js"></script>
    <script src="js/profile.js"></script>
    <script src="js/nav.js"></script>
</body>

</html>