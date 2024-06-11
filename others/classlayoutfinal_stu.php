<?php
setcookie('c_id', $_GET['c_id'], time() + (86400 * 30), "/");
session_start();
$_SESSION['c_id'] = $_GET['c_id'];
$hhhhhh=$_GET['c_id'];;
$con = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
include("functions.php");
$dow = check_login($con);
$uid = $dow['u_id'];
$cid = $_SESSION['c_id'];
$sql = "select fname, lname, dp,id_type from user where u_id='$uid'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$name = $row['fname'] . " " . $row['lname'];
$dp = $row['dp'];
$id = $row['id_type'];

$sql = "select * from posts where c_id='$cid'";
$result = mysqli_query($con, $sql);
$sql_tea = "select * from course natural join user where c_id='$cid' ";
$result_tea = mysqli_query($con, $sql_tea);
$row_tea = mysqli_fetch_assoc($result_tea);
$class_sql = "select * from course where c_id='$cid'";
$class_execute_query = mysqli_query($con, $class_sql);
$class_data = mysqli_fetch_assoc($class_execute_query);
$name_tea = $row_tea['fname'] . " " . $row['lname'];
$dp_tea = $row_tea['dp'];
$n = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $post_con[$n] = $row['post'];
    $post_date[$n] = $row['date'];
    $n++;
}
if(isset($_POST['send']))
{
  // $sql_teacher="select * from course natural join user where";
//   $u_id=3;
$sql90 = "select fname, lname, dp,u_id,batch from user natural join student where u_id='$uid'";
$result90 = mysqli_query($con, $sql90);
$row90 = mysqli_fetch_assoc($result90);
$name = $row90['fname'] . " " . $row90['lname'];
$dp = $row90['dp'];
$id = $row90['u_id'];
$batch=$row90['batch'];
$course=$row_tea['cname'];
if($row_tea['gender']==='Male')
$messege = "Dear Sir,\n".$_POST['message_content']."\n\nYours obedient,\n$name \nID - $id \nBatch -$batch\nCourse - $course ";
else
$messege = "Dear Mam,\n".$_POST['message_content']."\n\nYours obedient,\n$name \nID - $id \nBatch -$batch\nCourse - $course ";



//echo $message;
$mobile =  $row_tea['phone'];

$apikey = '$2y$10$In6lKPuI3xQa31/svT/Z3eRgmzcNZvCqdAuiOu.CjdfBMO5O5H05i';
$sendto = '88'.$mobile;
$msg = urlencode($messege);

$url='http://smsp1.durjoysoft.com/smsapi/non-masking?api_key='.$apikey.'&smsType=text&mobileNo='.$sendto.'&smsContent='.$msg.'';

if ( !empty($mobile)  && !empty($apikey)) {
		$curl = curl_init();
		curl_setopt_array($curl, array(
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_URL =>$url,
				CURLOPT_USERAGENT =>'My Browser'
			));
			$resp = curl_exec($curl);
			curl_close($curl);
			header("Location: classlayoutfinal_stu.php?c_id=$hhhhhh");
}
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
                <img loading="lazy" src="<?php if (isset($dp)) echo '../'.$dp; ?>" alt="" style="object-fit:cover;border-radius:50%;width:100px;height:100px;" class="mr-3 rounded-circle img-thumbnail shadow-sm">
                <div class="media-body">
                    <h6 class="m-0"><?php echo $name; ?></h6>
                    <!-- <p class="font-weight-normal text-muted mb-0">Web developer</p> -->
                </div>
            </div>
        </div>
        <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0"> Class Recourses</p>

        <ul class="nav flex-column bg-white mb-0">
            <li class="nav-item">
                <a href="slides.php" class="nav-link text-dark">
                    <i class="fa fa-slideshare mr-3 text-primary fa-fw"></i>
                    Slides
                </a>
            </li>
            <li class="nav-item">
                <a href="books.php" class="nav-link text-dark">
                    <i class="fa fa-book mr-3 text-primary fa-fw"></i>
                    Books
                </a>
            </li>
            <li class="nav-item">
                <a href="videos.php" class="nav-link text-dark">
                    <i class="fa fa-file-video-o mr-3 text-primary fa-fw"></i>
                    Videos
                </a>
            </li>
        </ul>
        <p class="text-gray font-weight-bold text-uppercase px-3 small py-4 mb-0">Tasks</p>

        <ul class="nav flex-column bg-white mb-0">
            <li class="nav-item">
                <a href="<?php if ($id == "Teacher") {
                                echo "exam_tea.php";
                            } else {
                                echo "exam_stu.php";
                            } ?>" class="nav-link text-dark">
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
                <a href="user_dashboard.php" class="nav-link text-dark">
                    <i class="fa fa-home mr-3 text-primary fa-fw"></i>
                    home
                </a>
            </li>
            <li class="nav-item">
                <a href="class_stu.php" class="nav-link text-dark bg-light">
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
         <div id="modid1">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left-text-fill" viewBox="0 0 16 16">
        <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793V2zm3.5 1a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
      </svg>
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Urgent Message</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="post">
            <textarea class="form-control" name="message_content" id="exampleFormControlTextarea1" rows="10" placeholder="Enter your urgent message you want to deliver to the course teacher"></textarea>

            <br />
            <!-- <div class="buttons">
              <div class="upload_btn">
                <button type="button" name="upload" class="btn btn-outline-info xxx" style="border:1px solid white;" onclick="mydunc()">
                  <span class="button__text">UPLOAD</span> 
                  <a href="#popup2" style="text-decoration:none;">
                    <span class="button__icon">
                      Upload Files
                    </span>
                  </a>
                </button> -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <!-- <button type="button" class="btn btn-primary">Understood</button> -->
          <button type="submit" name="send" class="btn btn-primary">Send</button>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>
        <!-- <button id="buttton_id"><a class="button"  href="#popup1">Let me Pop up</a></button> -->
        <hr>

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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="js/main.js"></script>
</body>

</html>