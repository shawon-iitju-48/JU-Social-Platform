<?php
session_start();
$con = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
include("php_util/isLogin.php");
$dow = check_login($con);
$uid = $dow['u_id'];
$name = $dow['fname'] . ' ' . $dow['lname'];
$dp = $dow['dp'];

$q = "select *from user NATURAL join (select friendto as u_id from user_friends where friendfrom='$uid' and friendto<>'$uid')x";
$subres = mysqli_query($con, $q);
if (isset($_POST['creategroup'])) {
    $qrd = "select gid from user_groups order by gid desc limit 1";
    $rt = mysqli_query($con, $qrd);
    if ($xs = mysqli_fetch_array($rt))
        $gid = $xs['gid'] + 1;
    else $gid = 1;
    $gname = $_POST['gname'];

    $query1 = "insert into user_groups(gid,gname, u_id) values('$gid','$gname','$uid');";
    mysqli_query($con, $query1);
    mysqli_query($con, "insert into group_member(memberid,gid) values(".$_SESSION['u_id'].",'$gid')");
    $sum = 1;
    if (!empty($_POST['lang'])) {
        foreach ($_POST['lang'] as $value) {
            $sum++;
            $query2 = "insert into group_member(memberid,gid) values('$value','$gid');";
            mysqli_query($con, $query2);
        }
    }
    $query3 = "update user_groups set member='$sum' where gid='$gid'";
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

?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Create Group | JUSE</title>
    <link rel="icon" href="images/icob.svg">

    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/create-group.css">
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

    <div class="container">
        <div class="row">
            <div class="col-3">
                <h4>Create Group</h4>
                <div class="head">
                    <div class="left">
                        <a href=""><img src="<?php echo $dp; ?>" alt=""></a>
                    </div>
                    <div class="right">
                        <h5><?php echo $name; ?></h5>
                        <p style="color:rgb(189, 180, 180);">Admin</p>
                    </div>
                </div>
                <form autocomplete="off" action="" method="post" enctype="multipart/form-data">
                    <input id="khojkoro" name="gname" class="form-control" style="margin-bottom:0.5rem" type="text" required placeholder="Group Name">
                    <label style="margin-bottom:0.2rem;color:rgb(189, 180, 180);" for="">Group Photo</label>
                    <input name="ufile" class="form-control" onchange="previewFile(this)" type="file">
                    <img id="ekhane" src="images/default-cover.png" alt="">
                    <p class="btn btn-light" style="width: 100%;">Invite friends</p>
                    <?php
                    while ($res = mysqli_fetch_array($subres)) {
                        echo '<div class="invite">
                        <input class="form-check-input" id="xd" name="lang[]" type="checkbox" value="' . $res['u_id'] . '">
                        <p style="margin-left:.5rem">' . $res['fname'] . ' ' . $res['lname'] . '</p>
                    </div>';
                    }
                    ?>

                    <footer>
                        <input name="creategroup" type="submit" class="btn btn-primary" style="width: 90%;margin-left:1rem;" value="Create Group">
                    </footer>
                </form>
            </div>
            <div class="col-7">
                <div class="row">
                    <h5>Desktop Preview</h5>
                    <img id="ekhan" src="images/default-cover.png" alt="">
                    <h4 id="frienddau">Group Name</h4>
                    <h6 id="memc">Group Member - </h6>
                    <hr>
                    <div class="line">
                        <p>Posts</p>
                        <p>About</p>
                        <p>Members</p>
                        <p>Photos</p>
                        <p>Videos</p>
                    </div>
                    <div class="postt">
                        <div class="tag">
                            <h5>About</h5>
                            <h5> <i class="fa fa-users" style="font-size: 1rem;color: rgb(189, 180, 180);"></i> General
                            </h5>
                        </div>
                        <div class="tag">
                            <div class="d">
                                <div class="left">
                                    <img src="<?php echo $dp; ?>" alt="">
                                </div>
                                <div class="right">
                                    <label for="" class="form-control" style="width:300px;color:rgb(189, 180, 180);">What's on your mind?</label>
                                </div>
                            </div>
                            <div class="bu">
                                <button style="width:45%;border-radius:40px;color:rgb(189, 180, 180);border:rgb(189, 180, 180);"><i class="fa fa-image" style="margin-right:.5rem;color:rgb(189, 180, 180);font-size:1rem;"></i>Upload
                                    Photos</button>
                                <button style="width:45%;border-radius:40px;color:rgb(189, 180, 180);border:rgb(189, 180, 180);"><i class="fas fa-video" style="margin-right:.5rem;color:rgb(189, 180, 180);font-size:1rem;"></i>Upload
                                    Videos</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="js/nav.js"></script>
    <script src="js/navfetch.js"></script>
    <script>
        function previewFile(input) {
            var file = $("input[type=file]").get(0).files[0];

            if (file) {
                var reader = new FileReader();

                reader.onload = function() {
                    $("#ekhane").attr("src", reader.result);
                    $("#ekhan").attr("src", reader.result);
                }

                reader.readAsDataURL(file);
            }
        }

        $(document).ready(function() {
            $("#khojkoro").keyup(function() {
                $('#frienddau').html("");
                $('#frienddau').html(khojkoro.value);
            });
            var c = 1;
            $('#memc').html("Group Member - " + c);
            $(".form-check-input").click(function() {
                var radioValue = $("input:checked").val();
                if (radioValue) {
                    c++;
                    $('#memc').html("");
                    $('#memc').html("Group Member - " + c);
                }
            });
        });
    </script>
</body>

</html>