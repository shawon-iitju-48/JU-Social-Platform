<?php
session_start();
$conn = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
$_SESSION['gid'] = $_GET['gid'];
$gid = $_SESSION['gid'];
$u_id = $_SESSION['u_id'];
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


if (isset($_POST['invited'])) {

  if (!empty($_POST['lang'])) {
      foreach ($_POST['lang'] as $value) {
          $query2 = "insert into grp_members(gid, u_id) values('$gid','$value');";
          mysqli_query($con, $query2);
      }
  }
  header("Location: group_layout.php?gid=$gid");
}

?>
<!DOCTYPE HTML>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Group Messenger | JUSE</title>
  <link rel="stylesheet" href="css/nav.css">
  <link rel="stylesheet" href="css/groupstyle.css">
  <link rel="icon" href="images/icob.svg">

  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">
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
  <div class="bodyy">
    <div class="wrapper">
      <section class="chat-area">
        <header>
          <?php
          //   $u_id = mysqli_real_escape_string($conn, $_GET['u_id']);
          $sql = mysqli_query($conn, "SELECT * FROM `groups` WHERE gid ='$gid'");
          if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
          }
          ?>
          <!-- <a href="index.php" class="back-icon"><i class="fas fa-arrow-left"></i></a> -->
          <a href="groupchat.php" style="color:black;margin-right:1rem;"><i class="fa-solid fa-arrow-left"></i></a>

          <!-- <img src="php/images/<?php //echo $row['img']; 
                                    ?>" alt=""> -->
          <div class="details">
            <img src="<?php echo $row['dp'] ?>" alt="">
            <span><?php echo $row['gname'] ?></span>
          </div>
          <button id="bhnn" data-bs-toggle="modal" style="margin-left:6rem" data-bs-target="#doggy" class="btn btn-secondary"><i class="fa fa-plus" style="margin-right:5px;"></i>Invite</button>
          <div class="modal fade " id="doggy" tabindex="-1" aria-labelledby="doggyLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="col-12 modal-title text-center" id="doggyLabel">Invite friends to this group</span></h5>
                                <button style="margin-left:-5rem;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            
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
                                            $qa = "select *from user NATURAL join (select friendto as u_id from (select friendto from user_friends where friendfrom='$u_id')x left join (select u_id from grp_members where gid='$gid')y on x.friendto=y.u_id where u_id is null)z";
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
        </header>
        <div class="chat-box">

        </div>
        <form action="#" class="typing-area">
          <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $u_id; ?>" hidden>
          <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
          <!-- <button name="sendbtn"><i class="fab fa-telegram-plane"></i></button> -->
          <button name="sendbtn" type="submit">send</button>
        </form>
      </section>
    </div>
  </div>
  <script src="js/groupchat.js"></script>
  <script src="js/nav.js"></script>
  <script src="js/navfetch.js"></script>
</body>

</html>