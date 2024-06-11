<?php
$con = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_e_learning");
$sql_iit = "select * from dept where faculty_name='IIT'";
$res_iit = mysqli_query($con, $sql_iit);
// $row=mysqli_fetch_assoc($res);
$n_iit = 0;
while ($row_iit = mysqli_fetch_assoc($res_iit)) {
  $did_iit[$n_iit] = $row_iit['dept_id'];
  $dname_iit[$n_iit] = $row_iit['dept_name'];
  $n_iit++;
}
$sql_mp = "select * from dept where faculty_name='mp'";
$res_mp = mysqli_query($con, $sql_mp);
// $row=mysqli_fetch_assoc($res);
$n_mp = 0;
while ($row_mp = mysqli_fetch_assoc($res_mp)) {
  $did_mp[$n_mp] = $row_mp['dept_id'];
  $dname_mp[$n_mp] = $row_mp['dept_name'];
  $n_mp++;
}
$sql_fbs = "select * from dept where faculty_name='fbs'";
$res_fbs = mysqli_query($con, $sql_fbs);
// $row=mysqli_fetch_assoc($res);
$n_fbs = 0;
while ($row_fbs = mysqli_fetch_assoc($res_fbs)) {
  $did_fbs[$n_fbs] = $row_fbs['dept_id'];
  $dname_fbs[$n_fbs] = $row_fbs['dept_name'];
  $n_fbs++;
}
$sql_ss = "select * from dept where faculty_name='ss'";
$res_ss = mysqli_query($con, $sql_ss);
// $row=mysqli_fetch_assoc($res);
$n_ss = 0;
while ($row_ss = mysqli_fetch_assoc($res_ss)) {
  $did_ss[$n_ss] = $row_ss['dept_id'];
  $dname_ss[$n_ss] = $row_ss['dept_name'];
  $n_ss++;
}
// for($i=0;$i<$n;$i++)
// {
//   echo $did[$i]. "  ".$dname[$i];
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JU e-Learning Platform</title>
  <link rel="icon" href="./dbfiles/icob.svg">
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
  <!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
  <link rel="stylesheet" href="css/card_home.css">
  

</head>

<body>
  <div class="container">
    <div class="navbar">

      <nav>
        <ul class="nav_links">
          <div class="dropdown">
            <button class="dropbtn">Faculties</button>
            <div class="dropdown-content">
              <a href="#iit">Institute of Information Technology</a>
              <a href="#mp">Faculty of Mathematical and Physical Sciences</a>
              <a href="#fbs">Faculty of Business Studies</a>
              <a href="#ss">Faculty of Social Sciences</a>
            </div>
          </div>
          <li><a href="notices.php">Notices</a></li>
        </ul>
      </nav>
      <a class="login" href="login.php"><button class="button1">Login</button></a>
    </div>
    <!-- <section class="intro" id="home">
        <h1 class="section__title section__title--intro">Hi, I am <strong>Arnab Purkaystha</strong></h1>
        <p class="section__subtitle section__subtitle--intro"><span class="auto-input"></span></p>
        <img src="image/arnab.jpg" height="230" width="184" alt="" class="intro-img">

    </section> -->
    <div class="row">
      <div class="col">
        <h1><strong>JU E-LEARNING PLATFORM</strong></h1>
        <p class="section__subtitle--intro" id="details_us"> Developed by <span class="auto-input"></span></p>
        <button id="button2" type="button"><a href="signup.php">Get Started</a></button>
      </div>
      <!-- <div class="col">
                <div class="card card1">
                    <h5>edu</h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, velit.</p>
                </div>
                <div class="card card2">
                    <h5>edu</h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, velit.</p>
                </div>
                <div class="card card3">
                    <h5>edu</h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, velit.</p>
                </div>
                <div class="card card4">
                    <h5>edu</h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, velit.</p>
                </div>
            </div> -->
    </div>

  </div>
  <section class="faculties" id="iit">
    <h2>Institute of Information Technology</h2>
    <div class="deptcard">
      <div class="cont_ainer">
        <?php for ($i = 0; $i < $n_iit; $i++) {  ?>
          <div class="card1">
            <div class="face hidden">
              <div class="content">
                <h2><?php echo $dname_iit[0]; ?></h2>
                <br>
                <p style="text-align: center;"><?php echo "Institute Code: " . $did_iit[0]; ?></p>
              </div>
            </div>
            <div class="face front">
              <!-- <i class="fa fa-star"></i> -->
              <h2><?php echo $dname_iit[0]; ?></h2>
            </div>
          </div>
        <?php  }  ?>
      </div>
    </section>
    <section class="faculties" id="mp">
      <h2>Faculty of Mathematical & Physical Sciences</h2>
      <div class="deptcard">
        <div class="cont_ainer">
          <?php for ($i = 0; $i < $n_mp; $i++) {  ?>
            <div class="card1">
              <div class="face hidden">
                <div class="content">
                  <h2><?php echo $dname_mp[$i]; ?></h2>
                  <br>
                  <p style="text-align: center;"><?php echo "Department Code: " . $did_mp[$i]; ?></p>
                </div>
              </div>
              <div class="face front">
                <!-- <i class="fa fa-star"></i> -->
                <h2><?php echo $dname_mp[$i]; ?></h2>
              </div>
            </div>
          <?php  }  ?>
        </div>
      </section>
      <section class="faculties" id="fbs">
        <h2>Faculty of Business Studies</h2>
        <div class="deptcard">
          <div class="cont_ainer">
            <?php for ($i = 0; $i < $n_fbs; $i++) {  ?>
              <div class="card1">
                <div class="face hidden">
                  <div class="content">
                    <h2><?php echo $dname_fbs[$i]; ?></h2>
                    <br>
                    <p style="text-align: center;"><?php echo "Department Code: " . $did_fbs[$i]; ?></p>
                  </div>
                </div>
                <div class="face front">
                  <!-- <i class="fa fa-star"></i> -->
                  <h2><?php echo $dname_fbs[$i]; ?></h2>
                </div>
              </div>
            <?php  }  ?>
          </div>
            </section>
        <section class="faculties" id="ss">
          <h2>Faculty of Social Sciences</h2>
          <div class="deptcard">
            <div class="cont_ainer">
              <?php for ($i = 0; $i < $n_ss; $i++) {  ?>
                <div class="card1">
                  <div class="face hidden">
                    <div class="content">
                      <h2><?php echo $dname_ss[$i]; ?></h2>
                      <br>
                      <p style="text-align: center;"><?php echo "Department Code: " . $did_ss[$i]; ?></p>
                    </div>
                  </div>
                  <div class="face front">
                    <!-- <i class="fa fa-star"></i> -->
                    <h2><?php echo $dname_ss[$i]; ?></h2>
                  </div>
                </div>
              <?php  }  ?>
            </div>
          </section>

          <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
          <script>
            var typed = new Typed(".auto-input", {
              strings: ["Shawon", "Arnab","Ayon","Eyenine"],
              typeSpeed: 50,
              backSpeed: 50,
              loop: true
            });
          </script>
          
          <footer class="footer-distributed">

    <div class="footer-left">
      <img src="./dbfiles/icob.svg" style="height:80px; width:80px;object-fit:cover;">
      <h3>JU<span> e-Learning Platform</span></h3>

      <p class="footer-links">
        <a href="/">Home</a>
        |
        <a href="/">About</a>
      </p>

      <p class="footer-company-name">© JU e-Learning Platform</p>
    </div>

    <div class="footer-center">
      <div>
        <i class="fa fa-map-marker"></i>
        <p><span>1342- Savar,  Dhaka</span>
            Jahangirnagar University</p>
      </div>

      <div>
        <i class="fa fa-phone"></i>
        <p>01768-503891</p>
      </div>
      <div>
        <i class="fa fa-envelope"></i>
        <p><a href="mailto:group67@ourprojectju.com">group67@ourprojectju.com</a></p>
      </div>
    </div>
    <div class="footer-right">
      <p class="footer-company-about">
        <span>About us</span>
        JU e learning platform is a technology-based learning platform that aims to give more effective and efficient learning. Main goal of this platform is to collect information about students, departments, teachers, courses, and so on to provide education anywhere, anytime.
      </p>
      <div class="footer-icons">
        <a href="https://www.facebook.com/arnab.bicarbonet"><i class="fa fa-facebook"></i></a>
        <a href="https://twitter.com/shawonn250"><i class="fa fa-twitter"></i></a>
        <a href="https://www.instagram.com/its_a_yo_n/"><i class="fa fa-instagram"></i></a>
        <a href="youtube.com"><i class="fa fa-youtube"></i></a>
      </div>
    </div>
  </footer>
</body>

</html>