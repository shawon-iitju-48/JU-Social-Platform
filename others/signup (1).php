<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require('PHPMailer/Exception.php');
    require('PHPMailer/SMTP.php');
    require('PHPMailer/PHPMailer.php');

    //Create an instance; passing `true` enables exceptions
   $db = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_e_learning");
    if (isset($_POST['upload'])) {
         $str = bin2hex(random_bytes(15));

        $uid = $_POST['uid'];

        $dp = $_FILES["dp"]["name"];
        $idphoto = $_FILES["idphoto"]["name"];

        $extension = strtolower(substr(strrchr($dp, '.'), 1));
        $newfilename = $uid . "_dp".$str."." . $extension;
        $folder = "dbfiles/" . $newfilename;
        $tempname = $_FILES["dp"]["tmp_name"];

        $tempnamee = $_FILES["idphoto"]["tmp_name"];
        $extensionn = strtolower(substr(strrchr($idphoto, '.'), 1));
        $newfilenamee = $uid . "_idphoto" .$str. "." . $extensionn;
        $folderr = "dbfiles/" . $newfilenamee;

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];

        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $cpassword = $_POST['cpassword'];

        $phone = $_POST['phone'];
        $house = $_POST['house'];
        $thana = $_POST['thana'];
        $dob = $_POST['dob'];
        $district = $_POST['district'];
        $bg = $_POST['bg'];
        $gender = $_POST['gender'];
        $jobtype = $_POST['jobtype'];
        date_default_timezone_set('Asia/Dhaka');
        $token = $dob . $uid . $phone . date('Ymdhis');

        $sql = "INSERT INTO `user`(`u_id`, `email`, `fname`, `lname`, `password`, `district`, `house_no`, `thana`, `phone`, `bg`, `status`, `id_type`, `gender`, `dob`, `dp`, `id_image`,`token`,`ustat`) VALUES ('$uid','$email','$firstname','$lastname','$password','$district','$house','$thana','$phone','$bg','no','$jobtype','$gender','$dob','" . $folder . "','" . $folderr . "','$token','inactive')";
        mysqli_query($db, $sql);
        move_uploaded_file($tempname, $folder);
        move_uploaded_file($tempnamee, $folderr);
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
            $mail->setFrom('ourproject6@ourprojectju.com', 'JU e-Learning Platform');
            $mail->addAddress($email);     //Add a recipient
            // //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Please activate your account';
            $msgbody = "Hello " . "" . $firstname . ",<br> To activate your account, please click on the link below to verify your email address. Once activated, you’ll have full access to JU e-Learning Platform." . " <br> Link : <a href='https://www.ourprojectju.com//signup_after.php?token=$token'> https://www.ourprojectju.com//signup_after.php?token=$token</a>";
            $mail->Body    = $msgbody;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->send();
        } catch (Exception $e) {
            echo "<script>alert('Something went wrong!');</script>";
        }
        // header('Location: '."signup_after.php?email=$email");
         echo "<script>location.href = 'signup_after.php?email=$email';</script>";
    }
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="icon" href="./dbfiles/icob.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="containerrrr">
        <div class="navbar">
            <nav>
                <ul class="nav_links">
                    <li><a href="/">Home</a></li>
                    <li><a href="notices.php">Notices</a></li>
                </ul>
            </nav>
            <a class="login" href="login.php"><button class="button1">Login</button></a>
        </div>
    </div>
    <div class="container" style="margin-top:-36rem;">
        <div class="title">
            User Registration
        </div>
        <form method="post"  enctype="multipart/form-data">
            <div class="user-details">
                <div class="input-box">
                    <span class="details"> Name</span>
                    <div class="name">
                        <input class="n" type="text" name="firstname" placeholder="First name" required>
                        <input type="text" name="lastname" placeholder="Last name" required>
                    </div>
                </div>
                <div class="input-box">
                    <span class="details">User ID</span>
                    <input type="text" name="uid" placeholder="Enter your ID" required>
                </div>
                <div class="input-box">
                    <span class="details"> Email</span>
                    <input type="email" name="email" placeholder="Enter your email " required>
                </div>
                <div class="input-box">
                    <span class="details"> Password</span>
                    <input type="password" id="pd" name="password" placeholder="Enter your password" required>
                </div>
                <div class="input-box">
                    <span class="details"> Confirm Password</span>
                    <input type="password" id="cpd" name="cpassword" placeholder="Confirm your password" required><br>
                    <b id="demo" style="color:red;margin-top:-2rem;font-size:14px;"></b>
                </div>
                <div class="input-box">
                    <span class="details"> Phone Number</span>
                    <input type="text" name="phone" placeholder="01xxxxxxxxx" required>
                </div>

                <div class="input-box">
                    <span class="details"> House No.</span>
                    <input type="text" name="house" placeholder="Enter your house number" required>
                </div>

                <div class="input-box">
                    <span class="details"> Thana</span>
                    <input type="text" name="thana" placeholder="Enter your thana" required>
                </div>
                <div class="input-box">
                    <span class="details"> District</span>
                    <input type="text" name="district" placeholder="Enter your district" required>
                </div>

                <div class="input-box">
                    <span class="details"> Blood Group</span>
                    <input type="text" name="bg" placeholder="Enter your blood group" required>
                </div>
                <div class="input-box">
                    <span class="details"> Date of Birth</span>
                    <input type="date" name="dob" placeholder="Enter your date of birth" required>
                </div>

                <div class="input-box">
                    <span class="details"> Upload your photo</span>
                    <input class="upload" type="file" name="dp" required>
                </div>
                <div class="input-box">
                    <span class="details"> Upload your ID Card's photo</span>
                    <input class="upload" type="file" name="idphoto" required>
                </div>
            </div>
            <div class="gender-details">
                <span class="gender-title">
                    Gender
                </span>
                <input type="radio" name="gender" value="Male" id="dot-1">
                <input type="radio" name="gender" value="Female" id="dot-2">
                <input type="radio" name="gender" value="null" id="dot-3">
                <div class="category">
                    <label for="dot-1">
                        <span class="dot one"></span>
                        <span class="gender">Male</span>
                    </label>
                    <label for="dot-2">
                        <span class="dot two"></span>
                        <span class="gender">Female</span>
                    </label>
                    <label for="dot-3">
                        <span class="dot three"></span>
                        <span class="gender">Prefer not to say</span>
                    </label>
                </div>
            </div>
            <div class="gender-details">
                <span class="gender-title">
                    Job Type
                </span>
                <input type="radio" name="jobtype" value="Teacher" id="dott-1">
                <input type="radio" name="jobtype" value="Student" id="dott-2">
                <div class="category xd">
                    <label for="dott-1">
                        <span class="dot one"></span>
                        <span class="gender">Teacher</span>
                    </label>
                    <label for="dott-2">
                        <span class="dot two"></span>
                        <span class="gender">Student</span>
                    </label>
                </div>
            </div>
            <div class="button">
                <input type="submit" onclick="checkPassword()" value="Register" name="upload">
            </div>
        </form>
    </div>
    <script src="js/script.js"></script>
</body>

</html>