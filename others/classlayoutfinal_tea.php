<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
session_start();
$_SESSION['c_id'] = $_GET['c_id'];
//Load Composer's autoloader
require('PHPMailer/Exception.php');
require('PHPMailer/SMTP.php');
require('PHPMailer/PHPMailer.php');
setcookie('c_id', $_GET['c_id'], time() + (86400 * 30), "/");
$con = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
include("functions.php");
$dow = check_login($con);
$uid = $dow['u_id'];
$id=$dow['id_type'];
$cid = $_SESSION['c_id'];
$sql = "select * from posts where c_id='$cid'";
$result = mysqli_query($con, $sql);
$sql_tea = "select * from course natural join user where c_id='$cid' ";
$result_tea = mysqli_query($con, $sql_tea);
$row_tea = mysqli_fetch_assoc($result_tea);
$class_sql = "select * from course where c_id='$cid'";
$class_execute_query = mysqli_query($con, $class_sql);
$class_data = mysqli_fetch_assoc($class_execute_query);
$n = 0;
while ($row = mysqli_fetch_assoc($result)) {
  $post_con[$n] = $row['post'];
  $post_date[$n] = $row['date'];
  $n++;
}
if (isset($_POST['upbtn'])) {
  $filecount = count($_FILES['file']['name']);
  for ($i = 0; $i < $filecount; $i++) {
    $fileName = $_FILES["file"]["name"][$i];
    // echo $fileName;
    $tempname = $_FILES["file"]["tmp_name"][$i];
    $extension = strtolower(substr(strrchr($fileName, '.'), 1));
    if ($extension == "pdf" || $extension == "PDF") {
      $cid = $_SESSION['c_id'];
      $sql = "select * from study_material";
      $result = mysqli_query($con, $sql);
      if ($result && mysqli_num_rows($result) == 0) {
        $uid = $_SESSION['u_id'];
        $mid = 1;
        $newfilename = $cid . $mid . "_" . $fileName;
        $folder = "study_materials/books/" . $newfilename;
        $sql2 = "insert into study_material(m_id,u_id,c_id) values('$mid','$uid','$cid')";
        $result2 = mysqli_query($con, $sql2);
        $sql3 = "insert into books(m_id,book) values('$mid','$folder')";
        $result3 = mysqli_query($con, $sql3);
        move_uploaded_file($tempname, $folder);
      } elseif ($result && mysqli_num_rows($result) > 0) {
        $sql = "select max(m_id) as m_id from study_material";
        $res = mysqli_query($con, $sql);
        $arr = mysqli_fetch_assoc($res);
        $mid = $arr['m_id'] + 1;
        $uid = $_SESSION['u_id'];
        $newfilename = $cid . $mid . "_" . $fileName;
        $folder = "study_materials/books/" . $newfilename;
        $sql2 = "insert into study_material(m_id,u_id,c_id) values('$mid','$uid','$cid')";
        $result2 = mysqli_query($con, $sql2);
        $sql3 = "insert into books(m_id,book) values('$mid','$folder')";
        $result3 = mysqli_query($con, $sql3);
        move_uploaded_file($tempname, $folder);
      }
    }
    if ($extension == "pptx" || $extension == "PPTX" || $extension == "ppt") {
      $cid = $_SESSION['c_id'];
      $sql = "select * from study_material";
      $result = mysqli_query($con, $sql);
      if ($result && mysqli_num_rows($result) == 0) {
        $uid = $_SESSION['u_id'];
        $mid = 1;
        $newfilename = $cid . $mid . "_" . $fileName;
        $folder = "study_materials/slides/" . $newfilename;
        $sql2 = "insert into study_material(m_id,u_id,c_id) values('$mid','$uid','$cid')";
        $result2 = mysqli_query($con, $sql2);
        $sql3 = "insert into slides(m_id,slide) values('$mid','$folder')";
        $result3 = mysqli_query($con, $sql3);
        move_uploaded_file($tempname, $folder);
      } elseif ($result && mysqli_num_rows($result) > 0) {
        $sql = "select max(m_id) as m_id from study_material";
        $res = mysqli_query($con, $sql);
        $arr = mysqli_fetch_assoc($res);
        $mid = $arr['m_id'] + 1;
        $uid = $_SESSION['u_id'];
        $newfilename = $cid . $mid . "_" . $fileName;
        $folder = "study_materials/slides/" . $newfilename;
        $sql2 = "insert into study_material(m_id,u_id,c_id) values('$mid','$uid','$cid')";
        $result2 = mysqli_query($con, $sql2);
        $sql3 = "insert into slides(m_id,slide) values('$mid','$folder')";
        $result3 = mysqli_query($con, $sql3);
        move_uploaded_file($tempname, $folder);
      }
    }
    if ($extension == "mp4" || $extension == "MP4" || $extension == "mkv" || $extension == "MKV") {
      $cid =$_SESSION['c_id'];
      $sql = "select * from study_material";
      $result = mysqli_query($con, $sql);
      if ($result && mysqli_num_rows($result) == 0) {
        $uid = $_SESSION['u_id'];
        $mid = 1;
        $newfilename = $cid . $mid . "_" . $fileName;
        $folder = "study_materials/records/" . $newfilename;
        $sql2 = "insert into study_material(m_id,u_id,c_id) values('$mid','$uid','$cid')";
        $result2 = mysqli_query($con, $sql2);
        $sql3 = "insert into records(m_id,video) values('$mid','$folder')";
        $result3 = mysqli_query($con, $sql3);
        move_uploaded_file($tempname, $folder);
      } elseif ($result && mysqli_num_rows($result) > 0) {
        $sql = "select max(m_id) as m_id from study_material";
        $res = mysqli_query($con, $sql);
        $arr = mysqli_fetch_assoc($res);
        $mid = $arr['m_id'] + 1;
        $uid = $_COOKIE['u_id'];
        $newfilename = $cid . $mid . "_" . $fileName;
        $folder = "study_materials/records/" . $newfilename;
        $sql2 = "insert into study_material(m_id,u_id,c_id) values('$mid','$uid','$cid')";
        $result2 = mysqli_query($con, $sql2);
        $sql3 = "insert into records(m_id,video) values('$mid','$folder')";
        $result3 = mysqli_query($con, $sql3);
        move_uploaded_file($tempname, $folder);
      }
    }
  }
 echo "<script>location.href = 'classlayoutfinal_tea.php?c_id=$cid';</script>";
  // move_uploaded_file($tempnamee, $folderr);
}
if (isset($_POST['post_button'])) {

  $post = $_POST['post_content'];
  if (!empty($post)) {
    $cid = $_SESSION['c_id'];
    $sql = "select * from posts order by p_id desc";
    $result = mysqli_query($con, $sql);
    if ($result && mysqli_num_rows($result) == 0) {
      $uid = $_SESSION['u_id'];
      $pid = 1;
      $date = date('Y-m-d');
      $sql2 = "insert into posts(p_id,post,date,c_id) values('$pid','$post','$date','$cid')";
      $result2 = mysqli_query($con, $sql2);
    } elseif ($result && mysqli_num_rows($result) > 0) {
      $sql = "select max(p_id) as p_id from posts";
      $res = mysqli_query($con, $sql);
      $arr = mysqli_fetch_assoc($res);
      $pid = $arr['p_id'] + 1;
      $uid = $_SESSION['u_id'];
      $date = date('Y-m-d');
      $sql2 = "insert into posts(p_id,post,date,c_id) values('$pid','$post','$date','$cid')";
      $result2 = mysqli_query($con, $sql2);
    }
  }

  $sq = "select email from enroll natural join user where c_id='$cid'";
  $re = mysqli_query($con, $sq);
  while ($row = mysqli_fetch_assoc($re)) {
    $email = $row['email'];

    $mail = new PHPMailer(true);

    try {
      //Server settings
      // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'mail.ourprojectju.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
       $mail->Username   = 'ourproject6@ourprojectju.com';                     //SMTP username
            $mail->Password   = 'RF==ti%KrSqr';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                       //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
      $mail->setFrom('group67@ourprojectju.com', $dow['fname'] . ' ' . $dow['lname']);
      $mail->addAddress($email);     //Add a recipient
      // //Attachments
      // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
      // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = 'New announcement from ' . $dow['fname'] . ' ' . $dow['lname'];
      $mail->Body    = nl2br($post);
      // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      $mail->send();
    } catch (Exception $e) {
      echo "<script>alert('Something went wrong!');</script>";
    }
  }
  //Create an instance; passing `true` enables exceptions








  echo "<script>location.href = 'classlayoutfinal_tea.php?c_id=$cid';</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Class Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="icon" href="./dbfiles/icob.svg">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/cstyle.css">
</head>

<body>

  <!-- Vertical navbar -->
  <div class="vertical-nav bg-white" id="sidebar">
    <div class="py-3 px-3 mb-4 bg-light">
      <div class="media d-flex align-items-center">
        <img loading="lazy" src="<?php if (isset($row_tea['dp'])) echo '../'.$row_tea['dp']; ?>" alt="" style="object-fit:cover;border-radius:50%;width:100px;height:100px;" class="mr-3 rounded-circle img-thumbnail shadow-sm">
        <div class="media-body">
          <h6 class="m-0"><?php echo $row_tea['fname'] . " " . $row_tea['lname'] ?></h6>
          <!-- <p class="font-weight-normal text-muted mb-0">Web developer</p> -->
        </div>
      </div>
    </div>

    <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0"> Class Recourses</p>

    <ul class="nav flex-column bg-white mb-0">
      <li class="nav-item">
        <a href="slides.php" id="slides" class="nav-link text-dark">
          <i class="fa fa-slideshare mr-3 text-primary fa-fw"></i>
          Slides
        </a>
      </li>
      <li class="nav-item">
        <a href="books.php" id="books" class="nav-link text-dark">
          <i class="fa fa-book mr-3 text-primary fa-fw"></i>
          Books
        </a>
      </li>
      <li class="nav-item">
        <a href="videos.php" id="videos" class="nav-link text-dark">
          <i class="fa fa-file-video-o mr-3 text-primary fa-fw"></i>
          Videos
        </a>
      </li>
    </ul>
    <p class="text-gray font-weight-bold text-uppercase px-3 small py-4 mb-0">Tasks</p>

    <ul class="nav flex-column bg-white mb-0">
      <li class="nav-item">
        <a href="exam_tea.php" class="nav-link text-dark">
          <i class="fa fa-bookmark mr-3 text-primary fa-fw"></i>
          Exam/Assignment
        </a>
      </li>
      <li class="nav-item">
        <a href="progress_tea.php" class="nav-link text-dark">
          <i class="fa fa-spinner mr-3 text-primary fa-fw"></i>
          Course Progress
        </a>
      </li>
    </ul>
    <p class="text-gray font-weight-bold text-uppercase px-3 small py-4 mb-0">User Dashboard</p>

    <ul class="nav flex-column bg-white mb-0">
      <li class="nav-item">
        <a href="user_dashboard_t.php" class="nav-link text-dark">
          <i class="fa fa-home mr-3 text-primary fa-fw"></i>
          home
        </a>
      </li>
      <li class="nav-item">
        <a href="class_tea.php" class="nav-link text-dark bg-light">
          <i class="fa fa-slideshare mr-3 text-primary fa-fw"></i>
          classroom
        </a>
      </li>
      <li class="nav-item">
        <a href="logout.php" class="nav-link text-dark">
          <i class="fa fa-sign-out mr-3 text-primary fa-fw"></i>
          logout
        </a>
      </li>
    </ul>
  </div>
  <!-- End vertical navbar -->

  <!-- Page content holder -->
  <div class="page-content p-5" id="content">
    <!-- Toggle button -->
    <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4" onclick="myfunc()"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">class menu</small></button>

    <!-- Demo content -->
    <h3 class="display-4 text-dark"><?php echo $class_data['cname']; ?></h3>
    <h6 class="py-1 font-weight-light text-uppercase text-secondary">Course code - <?php echo $cid; ?></h6>
    <!-- <button id="buttton_id"><a class="button"  href="#popup1">Let me Pop up</a></button> -->
    <hr>
    <a class="button" id="APBTN" href="#popup1"> <button type="button" class="btn btn-secondary" style="color:#9b59b6;width:100%;margin-top:1rem;height:4rem;background:transparent;   border:1px solid #ccc;border-bottom-width: 3px;" onclick="myfunc()">Announce something to your class</button></a>
    <div class="col-lg-7 cfg">


      <div class="d-grid gap-2 col-6 ">
      </div>
      <?php for ($i = 0; $i < $n; $i++) { ?>

        <div class="lead display_in" id="dis_div">
          <div class="xd">
            <img src="<?php if (isset($row_tea['dp'])) echo '../'.$row_tea['dp']; ?>" alt="" width="40" height="40" style="object-fit: cover;border-radius: 100%;">
            <div class="intr">
              <b><?php echo $row_tea['fname'] . " " . $row_tea['lname'] ?></b>
              <small><?php echo $post_date[$n - 1 - $i]; ?></small>
            </div>
          </div>
          <div>
            <p class="x">
              <?php if (isset($post_con[$i])) echo nl2br($post_con[$n - 1 - $i]); ?>
            </p>

          </div>
        </div>
      <?php } ?>
      <div class="box">

      </div>
      <div id="popup1" class="ovrllly">
        <div class="popup">
          <h4>Announce Something to your class</h4>
          <a class="close" href="#" onclick="unvisible_test()">&times;</a>
          <div class="content">
            <div id="box">
              <form method="post" enctype="multipart/form-data">
                <!-- <input
                type="text"
                name="post_content"
                id="text"
                placeholder="Announce something to your class"
              /> -->
                <textarea class="form-control" name="post_content" id="exampleFormControlTextarea1" rows="10" placeholder="Enter your post here"></textarea>

                <br />
                <div class="buttons">
                  <div class="upload_btn">
                    <button type="button" name="upload" class="btn btn-outline-info xxx" style="border:1px solid white;" onclick="mydunc()">
                      <!-- <span class="button__text">UPLOAD</span> -->
                      <a href="#popup2" style="text-decoration:none;">
                        <span class="button__icon">
                          Upload Files
                        </span>
                      </a>
                    </button>
                  </div>
                  <div class="post_btn">
                    <button type="submit" name="post_button" id="post_id" class="btn btn-outline-info xxx" style="border:1px solid white;width:10rem;">
                      <span class="button__icon">
                        Post
                      </span>
                    </button>
                  </div>
                </div>
                <div class="buttons"></div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="file-upload ovrllly" id="popup2">
        <div class="popup">
          <h4>Select your file</h4>
          <a class="close" href="#">&times;</a>
          <div class="content" style=" margin-top:-2rem;">
            <!-- Thank to pop me out of that button, but now i'm done so you can close this window. -->
            <form method="post" enctype="multipart/form-data">
              <input class="file-upload__input" type="file" name="file[]" id="file" multiple />
              <button class="file-upload__button" type="button">
                Choose File(s)
              </button>
              <span class="file-upload__label"></span>

              <input type="submit" id="upbtn" name="upbtn" class="btn btn-info xxx" value="UPLOAD" style="background: #4267B2;margin-top:15%;margin-left: -5rem;margin-right:auto;border:1px solid white;width:10rem;">
            </form>

          </div>

        </div>
      </div>

    </div>
    <!-- End demo content -->

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script>
      Array.prototype.forEach.call(
        document.querySelectorAll(".file-upload__button"),
        function(button) {
          const hiddenInput = button.parentElement.querySelector(
            ".file-upload__input"
          );
          const label = button.parentElement.querySelector(".file-upload__label");
          const defaultLabelText = "No file(s) selected";

          // Set default text for label
          label.textContent = defaultLabelText;
          label.title = defaultLabelText;

          button.addEventListener("click", function() {
            hiddenInput.click();
          });

          hiddenInput.addEventListener("change", function() {
            const filenameList = Array.prototype.map.call(hiddenInput.files, function(
              file
            ) {
              return file.name;
            });

            label.textContent = filenameList.join(", ") || defaultLabelText;
            label.title = label.textContent;
          });
        }
      );
    </script>
    <script>
    </script>
    <script>
      function myfunc() {
        document.querySelector("#popup1").setAttribute("style", "display:block");
      }

      function mydunc() {
        document.querySelector("#popup2").setAttribute("style", "display:block");
      }
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
</body>

</html>