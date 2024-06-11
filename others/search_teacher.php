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
    $id = $dow['id_type'];
    $dpp=$dow['dp'];
    $n = 0;
    $db = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
    if (isset($_POST['upload'])) {

         $sql = "select fname, lname, email, phone,designition, rinterest,dp from user natural join teacher natural join dept where ";
        if(isset($_POST['gender1']))
        {
            $gender1=$_POST['gender1'];
            $skey_fn=$_POST['skey_fn'];
            $sql=$sql."$gender1 like '%$skey_fn%' and ";
        }
        if(isset($_POST['gender2']))
        {
            $gender2=$_POST['gender2'];
            $skey_des=$_POST['skey_des'];
            $sql=$sql."$gender2 = '$skey_des' and ";
        }
        if(isset($_POST['gender3']))
        {
            $gender3=$_POST['gender3'];
            $skey_rin=$_POST['skey_rin'];
            $sql=$sql."$gender3 like '%$skey_rin%' and ";
        }
        if(isset($_POST['gender4']))
        {
            $gender4=$_POST['gender4'];
            $skey_d=$_POST['skey_d'];
            $sql=$sql."$gender4 like '%$skey_d%' and ";
        }
        $sql=substr($sql,0,-4);
       // echo $sql;
        $res = mysqli_query($db, $sql);
        $num=mysqli_num_rows($res);
        while ($row = mysqli_fetch_assoc($res)) {
            $name[$n] = $row['fname'] . " " . $row['lname'];
            $email[$n] = $row['email'];
            $phone[$n] = $row['phone'];
            $dp[$n] = $row['dp'];
            $designition[$n] = $row['designition'];
            $rinterest[$n] = $row['rinterest'];
            $n++;
        }
    }
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search any teacher</title>
     <link rel="icon" href="./dbfiles/icob.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="css/update.css">
    <link rel="stylesheet" href="css/bet.css">
    <link rel="stylesheet" href="css/search.css">
</head>

<body>
    <header>
        <div class="container">
            <nav id="main-nav" class="flex items-center justify-between">
                <div class="left flex  items-center">
                    <div class="branding">
                        <a href="<?php if ($id == "Teacher") {
                                        echo "user_dashboard_t.php";
                                    } else {
                                        echo "user_dashboard.php";
                                    } ?>"><img style="width:60px;height:60px;object-fit:cover;border-radius:50%;border:3px solid var(--pure);" src="<?php if(isset($dpp)) echo '../'.$dpp; ?>" alt=""></a>
                    </div>
                    <div>
                        <a href="<?php if($id=="Teacher"){echo "update_tea.php";} else {echo "update_stu.php";} ?>">edit profile</a>
                        <a href="<?php if($id=="Teacher"){echo "class_tea.php";} else {echo "class_stu.php";} ?>">class room</a>
                        <div class="dropdown">
                            <button class="dropbtn">SEARCH</button>
                            <div class="dropdown-content">
                                <a href="search_student.php">Search Any Student</a>
                                <a href="search_teacher.php">Search Any Teacher</a>
                            </div>
                        </div>
                    </div>
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
        </div>
    </header>
    <div class="bodyy">
        <div class="containerr">
            <div class="title">
                SEARCH ANY TEACHER
            </div>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="gender-details" style="margin-top:1rem;">
                    <span class="gender-title">
                        Search By
                    </span>
                    <input type="radio" name="gender1" value="fname" id="dot-1">
                    <input type="radio" name="gender2" value="designition" id="dot-2">
                    <input type="radio" name="gender3" value="rinterest" id="dot-3">
                    <input type="radio" name="gender4" value="dept_name" id="dot-5">
                     <div class="category">
                        <label for="dot-1" onclick=func6()>
                            <span class="dot one"></span>
                            <span class="gender">First Name</span>
                        </label>
                        <label for="dot-2" onclick=func7()>
                            <span class="dot two"></span>
                            <span class="gender">Designition</span>
                        </label>
                        <label for="dot-3" onclick=func8()>
                            <span class="dot three"></span>
                            <span class="gender">Research Interest</span>
                        </label>
                        <label for="dot-5" onclick=func9()>
                            <span class="dot five"></span>
                            <span class="gender">Department</span>
                        </label>
                    </div>
                </div>
                <div class="user-details1">

                    <div class="input-box1" id="fnt">
                        <span class="details1">Search Key(First Name)</span>
                        <input type="text" name="skey_fn" placeholder="Enter Search Key" >
                    </div>
                    <div class="input-box1" id="dt">
                        <span class="details1">Search Key(designition)</span>
                        <input type="text" name="skey_des" placeholder="Enter Search Key" >
                    </div>
                    <div class="input-box1" id="rint">
                        <span class="details1">Search Key(Research Interest)</span>
                        <input type="text" name="skey_rin" placeholder="Enter Search Key" >
                    </div>
                    <div class="input-box1" id="dept">
                        <span class="details1">Search Key(Department)</span>
                        <input type="text" name="skey_d" placeholder="Enter Search Key" >
                    </div>
                </div>
                <div class="button">
                    <input type="submit" value="Search" name="upload" id="searchtea">
                </div>
                <div class="num">
                    <p><?php if(isset($num)) echo "Number of results: ".$num;?></p>
                </div>
                <?php for ($i = 0; $i < $n; $i++) { ?>
                    <div class="ret">
                        <img src="<?php if (isset($dp[$i])) echo '../'.$dp[$i]; ?>" alt="Your Profile Picture" style="object-fit: cover;margin-left:3rem" height="250" width="250">
                        <div class="user-details">
                            <div class="input-box">
                                <span class="details"> Name</span>
                                <p><?php if (isset($name[$i])) echo $name[$i]; ?></p>
                            </div>
                            <div class="input-box">
                                <span class="details"> Email</span>
                                <p><?php if (isset($email[$i])) echo $email[$i]; ?></p>
                            </div>
                            <div class="input-box">
                                <span class="details"> Phone Number</span>
                                <p><?php if (isset($phone[$i])) echo $phone[$i]; ?></p>
                            </div>
                            <div class="input-box">
                                <span class="details"> Designition</span>
                                <p><?php if (isset($designition[$i])) echo $designition[$i]; ?></p>
                            </div>
                            <div class="input-box">
                                <span class="details"> Research Interest</span>
                                <p><?php if (isset($rinterest[$i])) echo $rinterest[$i]; ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </form>
        </div>
    </div>
    <script src="js/search.js"></script>
    <script src="js/script.js"></script>
</body>

</html>