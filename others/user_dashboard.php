<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
      
    $con = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
    include("functions.php");
    $dow = check_login($con);
    $uid = $dow['u_id'];
    $sql = "select * from user natural join student natural join dept where u_id= '$uid' limit 1 ";
    $resl = mysqli_query($con, $sql);
    if ($resl && mysqli_num_rows($resl) > 0) {
        $row = mysqli_fetch_assoc($resl);
        $name = $row['fname'] . " " . $row['lname'];
        $email = $row['email'];
        $phone = $row['phone'];
        $dname = $row['dept_name'];
        $address = $row['thana'] . ", " . $row['district'];
        $dp = $row['dp'];
        $skills = $row['skills'];
        $hall = $row['hall'];
        $jobtype = $row['id_type'];
        $gender = $row['gender'];
        $dob = $row['dob'];
        $house = $row['house_no'];
        $bg = $row['bg'];
    }
    if (isset($_POST['upload'])) {
        $tid = $_POST['tid'];
        $amount = $_POST['amount'];
        date_default_timezone_set('Asia/Dhaka');
        $pdate = date('Y-m-d');
        $semester = $_POST['semester'];
        $sql = "insert into payment(t_id,amount,pdate,semester,pstatus,u_id) values('$tid','$amount', '$pdate','$semester', 'no', '$uid')";
        mysqli_query($con, $sql);
        echo '<script>alert("Your payment information is on processing. Admin will update you soon.")</script>';
    }
    $sql = "select pstatus from payment inner join user on user.u_id=payment.u_id where user.u_id='$uid';";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) >= 1) {
        $row = mysqli_fetch_assoc($result);
        $pstatus = $row['pstatus'];
    }
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
      <link rel="icon" href="./dbfiles/icob.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="css/dash.css">
    <link rel="stylesheet" href="css/class.css">
</head>

<body>
    <header id="head">
        <div class="container">
            <nav id="main-nav" class="flex items-center justify-between">
                <div class="left flex  items-center">
                    <div class="branding">
                        <a href="user_dashboard.php"><img style="width:60px;height:60px;object-fit:cover;border-radius:50%;border:3px solid var(--pure);" src="<?php if(isset($dp)) echo '../'.$dp; ?>" alt=""></a>
                    </div>
                    <div>
                        <a href="update_stu.php">edit profile</a>
                        <a href="class_stu.php">class room</a>
                         <a href="../home.php">social media</a>
                        <div class="dropdown">
                            <button class="dropbtn">SEARCH</button>
                            <div class="dropdown-content">
                                <a href="search_student.php">Search Any Student</a>
                                <a href="search_teacher.php">Search Any Teacher</a>
                            </div>
                        </div>
                    </div>
                    <button class="btn-dorkar pay <?php if ($pstatus == "yes") echo "naihoyejabe"; ?>" onclick=openForm()>PAYMENT</button>
                </div>

                <div class="right">
                    <button class="btn btn-primary" onclick="location.href='logout.php';">
                        <div class="social">
                            <div class="a"><img src="./dbfiles/logo.svg" alt=""></div>
                            <h3 style="color:white;">Logout...</h3>
                        </div>
                    </button>
                </div>
            </nav>
            <div id="home" class="intro flex items-center justify-between">
                <div class="left flex-1 flex justify-center">
                    <img style="object-fit:cover;border-radius:2%;" src="<?php if (isset($dp)) echo '../'.$dp; ?>" alt="">
                </div>
                <div class="right flex-1">
                    <h1><?php if (isset($name)) echo $name; ?></h1>
                    <h6><?php if (isset($jobtype)) echo $jobtype; ?></h6>
                    <h5>Email: <span><?php if (isset($email)) echo $email; ?></span></h5>
                    <h5>Deptartment: <span><?php if (isset($dname)) echo $dname; ?></span></h5>
                    <h5>Hall: <span><?php if (isset($hall)) echo $hall; ?></span></h5>
                    
                </div>
            </div>
        </div>
    </header>
    <div class="form-popup" style="top:18%;" id="myForm">
        <form action="" class="form-container" method="post" enctype="multipart/form-data">

            <label for="tid"><b>Transaction ID</b></label>
            <input type="text" placeholder="Enter you bkash transaction ID" name="tid" required>
            <label for="amount"><b>Amount</b></label>
            <input type="text" placeholder="Enter amount" name="amount" required>
            <label for="semester"><b>Semester</b></label>
            <input type="text" placeholder="Enter semester" name="semester" required>
            <button type="submit" class="btn" name="upload">SUBMIT</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        </form>
    </div>
    <section id="about" class="about">
        <div class="container expand">
            <div class="title">
                MY INFO
            </div>
            <div class="user-details">
                <div class="input-box">
                    <span class="details">User ID</span>
                    <p><?php if (isset($uid)) echo $uid; ?></p>
                </div>

                <div class="input-box">
                    <span class="details"> Address</span>
                    <p><?php if (isset($address)) echo $address; ?></p>
                </div>
                <div class="input-box">
                    <span class="details"> Skills</span>
                    <p><?php if (isset($skills)) echo $skills; ?></p>
                </div>

                <div class="input-box">
                    <span class="details"> Phone Number</span>
                    <p><?php if (isset($phone)) echo $phone; ?></p>
                </div>

                <div class="input-box">
                    <span class="details"> Gender</span>
                    <p><?php if (isset($gender)) echo $gender; ?></p>
                </div>

                <div class="input-box">
                    <span class="details">Date of Birth</span>
                    <p><?php if (isset($dob)) echo $dob; ?></p>
                </div>

                <div class="input-box">
                    <span class="details"> House No.</span>
                    <p><?php if (isset($house)) echo $house; ?></p>
                </div>

                <div class="input-box">
                    <span class="details"> Blood Group</span>
                    <p><?php if (isset($bg)) echo $bg; ?></p>
                </div>
            </div>
        </div>
    </section>
    <script src="js/user.js"></script>
    <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";
            document.getElementById("home").style.display = "none";
            document.getElementById("about").style.display = "none";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
            document.getElementById("home").style.display = "flex";
        }
    </script>
</body>

</html>