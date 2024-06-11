<?php
session_start();
$conn = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
$u_id = $_SESSION['u_id'];
if (!$conn) {
  echo "<script>console.log('error');</script>";
}
include_once "php/config.php";
if (!isset($_SESSION['u_id'])) {
  header("location: login.php");
}
$con = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
include("php_util/isLogin.php");
$dow = check_login($con);
$uid = $dow['u_id'];
$name = $dow['fname'] . ' ' . $dow['lname'];
$dp = $dow['dp'];

if (isset($_POST['creategroup'])) {
  $sql = "select * from `groups`";
  if ($row = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($row) > 0) {
      $maxid = "select max(gid)+1 as gid from `groups`";
      $result = mysqli_query($conn, $maxid);
      $r = mysqli_fetch_assoc($result);
      $maxid = $r['gid'];
    } else {
      $maxid = 1;
    }


    $gn = $_POST["group_name"];
    $about = $_POST["about"];
    $sql1 = "insert into `groups`(`gid`, `gname`,`about`) values ('$maxid','$gn','$about')";
    $row1 = mysqli_query($conn, $sql1);
    $sql2 = "insert into grp_members values('$maxid','$u_id')";
    $res2 = mysqli_query($conn, $sql2);

    if (!empty($_FILES["dp"]["name"])) {
      $fileName = $_FILES["dp"]["name"];
      $tempname = $_FILES["dp"]["tmp_name"];
      $extension = strtolower(substr(strrchr($fileName, '.'), 1));
      $newfilename = $maxid . "groups" . rand() . "_" . $fileName;
      $folder = "images/" . $newfilename;

      $sql1 = "update `groups` set dp='$folder' where gid='$maxid'";
      $row1 = mysqli_query($conn, $sql1);
      move_uploaded_file($tempname, $folder);
    }
  }
}



$sql3 = "select *from `groups` natural join grp_members where u_id='$u_id'";
$bos = mysqli_query($con, $sql3);
$los = mysqli_query($con, $sql3);

?>
<!DOCTYPE HTML>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="icon" href="images/icob.svg">

  <title>Group Chat | JUSE</title>
  <link rel="stylesheet" href="css/nav.css">
  <link rel="stylesheet" href="css/groupchatcssapply.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
  <script src="
https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
  <script src="
https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
  </script>
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
          <li id="messenger250" class="nav-item f bg-d bc"><a class="nav-link text-dark hover-underline-animation" href="#"> <i class="fab fa-facebook-messenger text-dark fa-lg"></i> </a><span id="kotomessage"></span></li>
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

  <div class="row-1" <?php $lose = mysqli_fetch_assoc($los);
                      if (!$lose)
                        echo 'style="padding:10rem 15rem;"' ?>>
    <div class="col-7">
      <div class="friendsintro">
        <div class="left">
          <h4>Messenger groups you have</h4>
        </div>
        <div class="right">
          <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Create Group
          </button>
        </div>
      </div>
      <div class="parentfr">
        <?php
        while ($resul = mysqli_fetch_assoc($bos)) {
          echo '<div class="friend">
          <div class="left">
            <a href="group_layout.php?gid=' . $resul['gid'] . '"><img src="' . $resul['dp'] . '" alt=""></a>
          </div>
          <div class="right">
            <a href="group_layout.php?gid=' . $resul['gid'] . '">
              <h5>' . $resul['gname'] . '</h5>
            </a>
            <p>' . $resul['about'] . '</p>
          </div>
        </div>';
        }
        ?>
      </div>
      <?php
      if (!$lose)
        echo '<h4 style="text-align:center;margin-top:2rem;color:red;">No groups found.</h4>';
      ?>


      <div style="margin-top:8rem" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 style="margin-left:10rem!important;" class="modal-title" id="exampleModalLabel">Create Group</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="formm" autocomplete="off" action="" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <label style="margin-bottom: .5rem;margin-top:.5rem" for="group_name">Group Name</label>
                <input class="form-control" placeholder="Group Name" type="text" name="group_name" id="gn" required>

                <label style="margin-bottom: .5rem;margin-top:.5rem" for="group_name">Group Info</label>
                <textarea class="form-control" placeholder="About Group" type="text" name="about" required></textarea>

                <label style="margin-bottom: .5rem;margin-top:.5rem" for="group_name">Group Photo</label>
                <input class="form-control" type="file" name="dp">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="creategroup" class="btn btn-primary">Create</button>
            </form>
          </div>
        </div>
      </div>
    </div>


  </div>
  </div>

  <script src="js/nav.js"></script>
  <script src="js/navfetch.js"></script>
</body>

</html>