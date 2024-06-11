<?php
session_start();
$gid = $_GET['gid'];
$_SESSION['gid'] = $gid;
$con = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
include("php_util/isLogin.php");
$dow = check_login($con);
$uid = $dow['u_id'];
$name = $dow['fname'] . ' ' . $dow['lname'];
$dp = $dow['dp'];

$qrd = "select *from user_groups where gid='$gid'";
$rt = mysqli_query($con, $qrd);
$res = mysqli_fetch_array($rt);
$gname = $res['gname'];
$gcover = $res['cover'];
$gmem = $res['member'];
$admin = $res['u_id'];
$_SESSION['admin'] = $admin;


$sql = "select *from group_member where memberid=" . $_SESSION['u_id'] . " and gid='$gid'";
$sqlres = mysqli_query($con, $sql);
$sqlres1 = mysqli_fetch_array($sqlres);

$qu4 = "select *from grouprequests where rqfrom=" . $_SESSION['u_id'] . " and rqto='$gid'";
$qu4s = mysqli_query($con, $qu4);
$agei = mysqli_fetch_array($qu4s);


$gone = "select *from grouppost natural join grouppost_photos where gid='$gid' order by gpid desc limit 9";
$gone2 = mysqli_query($con, $gone);

$fr = "select fname, lname, dp,user.u_id from user inner join (select *from group_member NATURAL join user_groups where gid='$gid')x on x.memberid=user.u_id where user.u_id<>'$uid'";
$fr2 = mysqli_query($con, $fr);
$fr0 = mysqli_query($con, $fr);
if (isset($_POST['editinfo'])) {

    $gname = $res['gname'];
    if (!empty($_POST['gname']))
        $gname = $_POST['gname'];

    $about = $res['about'];
    if (!empty($_POST['about']))
        $about = $_POST['about'];

    $query3 = "update user_groups set gname='$gname',about='$about' where gid='$gid'";
    mysqli_query($con, $query3);

    if (!empty($_FILES["ufile"]["name"])) {
        $fileName = $_FILES["ufile"]["name"];
        $tempname = $_FILES["ufile"]["tmp_name"];
        $newfilename = $gid . $uid . rand() . "_" . $fileName;
        $folder = "posts/photos/" . $newfilename;
        $query4 = "update user_groups set cover='$folder' where gid='$gid'";
        mysqli_query($con, $query4);
        move_uploaded_file($tempname, $folder);
    }
    header("Location: group.php?gid=$gid");
}
if (isset($_POST['createpost'])) {

    $pdetails = $_POST['gpost'];
    date_default_timezone_set('Asia/Dhaka');
    $monthNum = date('m');
    $monthName = date("F", mktime(0, 0, 0, $monthNum, 10));
    $pdate = $monthName . ' ' . date('d') . ', ' . date('Y');
    $ptime = date('h:i A');
    $q = "select gpid from grouppost order by gpid desc limit 1";

    $r = mysqli_query($con, $q);
    if ($xs = mysqli_fetch_array($r))
        $gpid = $xs['gpid'] + 1;
    else $gpid = 1;

    $query1 = "insert into grouppost(gpid,pdate, ptime, pdetails, memberid,gid) values('$gpid','$pdate','$ptime','$pdetails','$uid','$gid');";
    mysqli_query($con, $query1);

    $filecount = count($_FILES['gfile']['name']);
    for ($i = 0; $i < $filecount; $i++) {

        $fileName = $_FILES["gfile"]["name"][$i];
        $tempname = $_FILES["gfile"]["tmp_name"][$i];
        $extension = strtolower(substr(strrchr($fileName, '.'), 1));

        if ($extension == "mp4" || $extension == "MP4" || $extension == "mkv" || $extension == "MKV") {
            $newfilename = $gpid . $uid . date('Yhmis') . rand() . "_" . $fileName;
            $folder = "posts/videos/" . $newfilename;
            $query2 = "insert into grouppost_videos(location, gpid) values('$folder','$gpid')";
            mysqli_query($con, $query2);
            move_uploaded_file($tempname, $folder);
        } else if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "gif") {
            $newfilename = $gpid . $uid . date('Yhmis') . rand() . "_" . $fileName;
            $folder = "posts/photos/" . $newfilename;
            $query3 = "insert into grouppost_photos(location, gpid) values('$folder','$gpid')";
            mysqli_query($con, $query3);
            move_uploaded_file($tempname, $folder);
        }
    }
    $rup = mysqli_query($con, "select memberid from group_member where gid='$gid'");
    date_default_timezone_set('Asia/Dhaka');
    $ndate = date('Y-m-d');
    $ntime = date('H:i:s');
    while ($rupres = mysqli_fetch_assoc($rup)) {
        $bup = mysqli_fetch_assoc(mysqli_query($con, "select *from group_member where memberid=" . $rupres['memberid'] . " and gid='$gid'"));
        if ($rupres['memberid'] != $uid and $bup['mute'] == 'off')
            mysqli_query($con, "insert into notifications(type, sender, senderentity, ndate, ntime, u_id) values('grouppost','$uid','$gpid','$ndate','$ntime'," . $rupres['memberid'] . ")");
    }
    header("Location: group.php?gid=$gid");
}

if (isset($_POST['invited'])) {
    date_default_timezone_set('Asia/Dhaka');
    $ndate = date('Y-m-d');
    $ntime = date('H:i:s');
    $sum = 0;
    if (!empty($_POST['lang'])) {
        foreach ($_POST['lang'] as $value) {
            $sum++;
            $query2 = "insert into group_member(memberid,gid) values('$value','$gid');";
            mysqli_query($con, $query2);
            mysqli_query($con, "insert into notifications(type, sender, senderentity, ndate, ntime, u_id) values('groupinvite','$uid','$gid','$ndate','$ntime','$value')");
        }
    }
    $query10 = "select *from user_groups where gid='$gid'";
    $res10 = mysqli_query($con, $query10);
    $res11 = mysqli_fetch_array($res10);
    $mem = $res11['member'];
    $sum = $sum + $mem;
    $query3 = "update user_groups set member='$sum' where gid='$gid'";
    mysqli_query($con, $query3);


    header("Location: group.php?gid=$gid");
}
$mute = "select *from group_member where gid='$gid' and memberid=" . $_SESSION['u_id'] . "";
$mutes = mysqli_query($con, $mute);
$muteres = mysqli_fetch_array($mutes);

if (isset($_POST['deletekoro'])) {
    if ($muteres['mute'] == 'on') {
        mysqli_query($con, "update group_member set mute='off' where gid='$gid' and memberid=" . $_SESSION['u_id'] . "");
    } else if ($muteres['mute'] == 'off') {
        mysqli_query($con, "update group_member set mute='on' where gid='$gid' and memberid=" . $_SESSION['u_id'] . "");
    }
    header("Location: group.php?gid=$gid");
}
if (isset($_POST['confirmkoro'])) {
    mysqli_query($con, "delete from group_member where gid='$gid' and memberid=" . $_SESSION['u_id'] . "");
    $query10 = "select *from user_groups where gid='$gid'";
    $res10 = mysqli_query($con, $query10);
    $res11 = mysqli_fetch_array($res10);
    $mem = $res11['member'];
    $mem = $mem - 1;
    $query3 = "update user_groups set member='$mem' where gid='$gid'";
    mysqli_query($con, $query3);
    header("Location: groupfeed.php");
}

if (isset($_POST['joingroup'])) {
    mysqli_query($con, "INSERT INTO grouprequests(rqfrom, rqto) VALUES('$uid', '$gid')");
    header("Location: group.php?gid=$gid");
}
if (isset($_POST['canceljoin'])) {
    mysqli_query($con, "delete from grouprequests where rqfrom='$uid' and rqto='$gid'");
    header("Location: group.php?gid=$gid");
}
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php echo $gname; ?> | JUSE</title>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/group.css">
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
                    <li id="group250" class="nav-item f bg-d bc"><a class="nav-link text-dark hover-underline-animation" href="#"><i class="fas fa-users text-dark fa-lg"></i> </a> </li>
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




    <div class="container" style="max-width: 1100px">
        <section class="basic-intro">
            <a href="#"><img src="<?php echo $gcover;
                                    ?>" alt="Cover Photo"></a>
            <div class="biodata">
                <div class="row-1">
                    <h3><b><?php echo $gname; ?></b></h3>
                    <p style="color:rgb(145, 136, 136);">Private Group .
                        <?php echo $gmem; ?> Members</p>

                    <div class="balton" style="display: flex;align-items:center;justify-content:space-between;width:60rem;">
                        <div class="left" style="display: flex;">
                            <form method="post">
                                <div class="btn-group">
                                    <?php
                                    if ($sqlres1)

                                        echo '<button  class="btn btn-secondary dropdown-toggle" style="width:7.5rem;" type="button" id="defaultDropdown" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
<i class="fa fa-users" style="margin-right:5px;"></i>Joined
</button>';
                                    else {
                                        if (!$agei)
                                            echo '<button name="joingroup" style="margin-right:1rem;" class="btn btn-primary"><i class="fa-solid fa-users-medical" style="margin-right:5px;"></i>Join Group</button>';
                                        else echo '<button name="canceljoin" style="margin-right:1rem;" class="btn btn-primary"><i class="fa-solid fa-users-slash" style="margin-right:5px;"></i>Cancel request</button>';
                                    }
                                    ?>


                                    <ul class="dropdown-menu" style="width:13rem;" aria-labelledby="defaultDropdown">

                                        <?php
                                        if ($admin != $_SESSION['u_id'])
                                            echo '<li><button type="submit" name="confirmkoro" style="width:13rem;" class="dropdown-item"><i class="fas fa-sign-out-alt" style="margin-right:5px"></i>Leave Group</button></li>';
                                        ?>
                                        <li><button type="submit" name="deletekoro" style="width:13rem;" class="dropdown-item"><i class="fas fa-bell" style="margin-right:5px"></i><?php if ($muteres['mute'] == "on") echo 'Unmute notifications';
                                                                                                                                                                                    else echo 'Mute notifications'; ?></button></li>
                                    </ul>

                                </div>
                            </form>

                            <?php
                            if ($admin == $_SESSION['u_id'])
                                echo '<div class="right">
                            <button id="bhnn" data-bs-toggle="modal" data-bs-target="#myModal" style="margin-right:1rem;" class="btn btn-info"><i class="fas fa-edit" style="margin-right:5px;"></i>Edit Group</button>
                        </div>';

                            ?>

                        </div>
                        <?php
                        if ($sqlres1)
                            echo '<button id="bhnn" data-bs-toggle="modal" style="background-color: #814DE7;" data-bs-target="#doggy" class="btn btn-secondary"><i class="fa fa-plus" style="margin-right:5px;"></i>Invite</button>';
                        ?>

                    </div>

                </div>
                <div class="modal fade " id="doggy" tabindex="-1" aria-labelledby="doggyLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="col-12 modal-title text-center" id="doggyLabel">Invite friends to this group</span></h5>
                                <button style="margin-left:-5rem;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form autocomplete="off" style="width: 80%;margin-left:1rem;margin-top:1rem;">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-search" style="font-size:30px ;"></i></span>
                                    </div>
                                    <input id="natore" type="text" class="form-control" placeholder="Search for friends by name">
                                </div>
                            </form>
                            <form autocomplete="off" action="" method="post" enctype="multipart/form-data" class="ahah">
                                <div class="modal-body">
                                    <div class="bai">
                                        <div class="dp">
                                            <div class="left">
                                                <h4>Suggested</h4>
                                            </div>
                                        </div>
                                        <div id="suggested">
                                            <?php
                                            $qa = "select *from (select *from user NATURAL join (select friendto as u_id from user_friends where 
                                            friendfrom=" . $_SESSION['u_id'] . " and friendto<>" . $_SESSION['u_id'] . ")x)y left join (select rqfrom as xxx from grouprequests where rqto='$gid' union select memberid as xxx from group_member where gid='$gid')z on y.u_id=z.xxx where z.xxx is null;";
                                            $subress = mysqli_query($con, $qa);
                                            $DON = mysqli_query($con, $qa);
                                            $DON2 = mysqli_fetch_array($DON);
                                            if (!$DON2)
                                                echo '<p>No results found.</p>';
                                            while ($ress = mysqli_fetch_array($subress)) {
                                                echo '<div class="invite">
                                                    <input class="form-check-input" id="xd" name="lang[]" type="checkbox" value="' . $ress['u_id'] . '">
                                                    <p style="margin-left:.5rem">' . $ress['fname'] . ' ' . $ress['lname'] . '</p>
                                                </div>';
                                            }
                                            ?>
                                        </div>



                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input name="invited" type="submit" value="Invite" class="btn btn-primary" style="width:100%">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade " id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="col-12 modal-title text-center" id="myModalLabel">Edit Group Info </span></h5>
                                <button style="margin-left:-5rem;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form autocomplete="off" action="" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="nai">
                                        <div class="dp">
                                            <div class="left">
                                                <h4>Group Photo</h4>
                                            </div>
                                            <div class="right">
                                                <input name="ufile" id="shawon" onchange="previewFilec(this)" type="file" class="form-control">
                                            </div>
                                        </div>
                                        <div class="cover-chobi"><img id="ekhan" src="<?php echo $res['cover']; ?>" alt=""></div>
                                        <div class="dp" style="margin-top:2rem;">
                                            <div class="left">
                                                <h4>Group Name</h4>
                                            </div>
                                            <div class="right">

                                                <h5 id="bioedit">Edit</h5>

                                                <h5 id="bioeditcancel">Cancel</h5>

                                            </div>
                                        </div>
                                        <p style="text-align: center;" class="1"><?php echo $res['gname']; ?></p>
                                        <textarea class="biolekho" name="gname" id="" cols="40" rows="10"><?php echo $res['gname']; ?></textarea>
                                    </div>

                                    <div class="bai">
                                        <div class="dp" style="margin-top:2rem;">
                                            <div class="left">
                                                <h4>Customize About Info</h4>
                                            </div>
                                            <div class="right">

                                                <h5 id="aboutedit">Edit</h5>

                                                <h5 id="abouteditcancel">Cancel</h5>

                                            </div>
                                        </div>

                                        <div class="editabout">
                                            <textarea name="about" id="" cols="100%" rows="10"><?php echo $res['about']; ?></textarea>
                                        </div>
                                        <div class="myabout">
                                            <p><?php echo $res['about']; ?></p>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <input name="editinfo" type="submit" value="Save Changes" class="btn btn-primary" style="width:100%">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <hr style="margin-top:2rem;">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <?php
                if ($sqlres1)

                    echo '<li class="nav-item">
         <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="false">Discussion</a>
     </li>';
                ?>

                <li class="nav-item">
                    <a class="nav-link <?php
                                        if (!$sqlres1)
                                            echo 'active';

                                        ?>" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">About</a>
                </li>
                <?php
                if ($sqlres1)
                    echo '<li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Members</a>
                        </li>';
                ?>

                <?php
                if ($admin == $_SESSION['u_id'])
                    echo '  <li class="nav-item">
<a class="nav-link" id="pills-request-tab" data-toggle="pill" href="#pills-request" role="tab" aria-controls="pills-request" aria-selected="false">Member requests</a>
<span id="kotorq2"></span>
</li>';
                ?>
                <?php
                if ($sqlres1)

                    echo '<li class="nav-item">
        <a class="nav-link" id="pills-photos-tab" data-toggle="pill" href="#pills-photos" role="tab" aria-controls="pills-photos" aria-selected="false">Photos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="pills-videos-tab" data-toggle="pill" href="#pills-videos" role="tab" aria-controls="pills-videos" aria-selected="false">Videos</a>
    </li>';
                ?>

            </ul>
        </section>

    </div>
    <section class="data">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade <?php
                                        if ($sqlres1)
                                            echo 'show active';

                                        ?>" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="row">
                    <div class="col-5" style="padding-bottom:2rem;">
                        <div class="row" style="padding:.5rem .5rem; max-height:400px;">
                            <h4><b>About</b></h4>
                            <p class="truncate"><?php echo $res['about']; ?></p>
                            <div class="bold">
                                <div class="left">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </div>
                                <div class="right">
                                    <b>Private</b><br>
                                    <small>Only members can see who's in the group and what they post.</small>
                                </div>
                            </div>
                            <div class="bold">
                                <div class="left">
                                    <i class="fas fa-eye"></i>
                                </div>
                                <div class="right">
                                    <b>Visible</b><br>
                                    <small>Anyone can find this group.</small>
                                </div>
                            </div>
                            <div class="bold">
                                <div class="left">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="right">
                                    <b>General</b><br>
                                </div>
                            </div>

                        </div>
                        <div class="row" style="margin-top:2rem;padding-bottom:2rem;max-height: 400px;">
                            <div class="flexx">
                                <h4><b>Photos</b></h4>
                                <p id="seephotos">See all photos</p>
                            </div>
                            <div class="card-wrapper">
                                <?php while ($gone3 = mysqli_fetch_array($gone2)) {
                                    echo ' <a href="groupphotoview.php?pidd=' . $gone3['gpid'] . '"> <img src="' . $gone3['location'] . '" alt=""></a>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row" style="margin-top:2rem;padding-bottom:2rem;max-height: 400px;">
                            <div class="flexx">
                                <h4><b>Members</b></h4>
                                <p id="seefriend">See all Members</p>
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
                            <div id="extra" class="flexx" style="margin-bottom:1rem">
                                <a href=""> <img src="<?php if (!empty($dp)) echo $dp;
                                                        else echo "images/defaultdp.png"; ?>" alt=""></a>
                                <button id="depost" type="button" class="btn btn-secondary" style="width:100%;margin-left:2rem;border-radius:40px;" data-bs-toggle="modal" data-bs-target="#exampleModal">Write something...</button>

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
                                                        <p><i class="fas fa-users" style="margin-right:5px;"></i>Members of <?php echo $gname ?></p>
                                                    </div>
                                                </div>
                                                <form method="post" enctype="multipart/form-data">
                                                    <textarea name="gpost" id="post" cols="60" rows="10" placeholder="Create a post..." required style="margin-bottom: .5rem;"></textarea>
                                                    <div class="mb-3 photomodal">

                                                        <input name="gfile[]" class="form-control" type="file" id="formFile" multiple>
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
            <div class="tab-pane fade <?php
                                        if (!$sqlres1)
                                            echo 'show active';

                                        ?>" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="row" style="padding:1rem 0rem;">
                    <div class="row" style="padding:.5rem .5rem;background:white;">
                        <h4><b>About this group</b></h4>
                        <hr style="margin-top: 1rem;margin-bottom:1rem;">
                        <p><?php echo $res['about']; ?></p>
                        <div class="bold">
                            <div class="left">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </div>
                            <div class="right">
                                <b>Private</b><br>
                                <small>Only members can see who's in the group and what they post.</small>
                            </div>
                        </div>
                        <div class="bold">
                            <div class="left">
                                <i class="fas fa-eye"></i>
                            </div>
                            <div class="right">
                                <b>Visible</b><br>
                                <small>Anyone can find this group.</small>
                            </div>
                        </div>
                        <div class="bold">
                            <div class="left">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="right">
                                <b>General</b><br>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div class="row" style="padding:1rem 0rem;">
                    <div class="col-11" style="padding:1rem 1rem;background-color: rgb(255, 255, 255);border-radius: 10px;">
                        <div class="friendsintro">
                            <div class="left">
                                <h4>Members</h4>
                            </div>
                            <div class="right">
                                <form action="" autocomplete="off">
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
            <div class="tab-pane fade" id="pills-request" role="tabpanel" aria-labelledby="pills-request-tab">
                <div class="row" style="padding:1rem 0rem;">
                    <div class="col-11" style="padding:1rem 1rem;background-color: rgb(255, 255, 255);border-radius: 10px;">
                        <div class="friendsintro">
                            <div class="left">
                                <h4>Requests</h4>
                            </div>

                        </div>
                        <div class="con">
                            <div class="card-wrapper" style="margin-bottom:2rem;" id="rqt">
                            </div>
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

    <script src="js/group.js"></script>
    <script src="js/nav.js"></script>
    <script src="js/navfetch.js"></script>
    <script>
        function previewFilec(input) {
            var files = $("#shawon").get(0).files[0];

            if (files) {
                var readers = new FileReader();

                readers.onload = function() {
                    $("#ekhan").attr("src", readers.result);
                }

                readers.readAsDataURL(files);
            }
        }
    </script>
</body>

</html>