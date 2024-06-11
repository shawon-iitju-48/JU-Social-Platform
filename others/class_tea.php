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
    $dpp=$dow['dp'];
    if (isset($_POST['upload'])) {
        $cidd = $_POST['cid'];
        $cnamee = $_POST['cname'];
        $creditt = $_POST['credit'];
        $semesterr = $_POST['semester'];
        $sql = "insert into course(c_id,credit,cname,semester,cstatus,u_id) values('$cidd', '$creditt','$cnamee', '$semesterr', '0','$uid')";
        mysqli_query($con, $sql);
        echo "<script>location.href = 'class_tea.php';</script>";
    }
    $sql = "select *from course natural join user where u_id=$uid";
    $resl = mysqli_query($con, $sql);
    $n = 0;
    while ($row = mysqli_fetch_assoc($resl)) {
        $cc[$n]=$row['c_id'];
        $tname[$n] = $row['fname'] . " " . $row['lname'];
        $cname[$n] = $row['cname'];
        $dp[$n] = $row['dp'];
        $n++;
    }
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classroom</title>
    <link rel="icon" href="./dbfiles/icob.svg">
    <link rel="stylesheet" href="css/class.css">
    <link rel="stylesheet" href="css/update.css">
</head>

<body>
    <header>
        <div class="container">
            <nav id="main-nav" class="flex items-center justify-between">
                <div class="left flex  items-center">
                    <div class="branding">
                        <a href="user_dashboard_t.php"><img style="width:60px;height:60px;object-fit:cover;border-radius:50%;border:3px solid var(--pure);" src="<?php if(isset($dpp)) echo '../'.$dpp; ?>" alt=""></a>
                    </div>
                    <div>
                        <a href="update_tea.php" style="font-size:15px;">edit profile</a>
                        <a href="class_tea.php" style="font-size:15px;">class room</a>
                        <div class="dropdown">
                            <button class="dropbtn" style="font-size:15px;">SEARCH</button>
                            <div class="dropdown-content">
                                <a href="search_student.php">Search Any Student</a>
                                <a href="search_teacher.php">Search Any Teacher</a>
                            </div>
                        </div>
                        <button class="btn-dorkar" onclick=openForm()>CREATE CLASS</button>
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
    <div class="form-popup" style="top:18%;" id="myForm">
        <form action="" class="form-container" method="post" enctype="multipart/form-data">

            <label for="cid"><b>Course ID</b></label>
            <input type="text" placeholder="Enter course ID" name="cid" required>
            <label for="cname"><b>Course Name</b></label>
            <input type="text" placeholder="Enter course name" name="cname" required>
            <label for="credit"><b>Course Credit</b></label>
            <input type="text" placeholder="Enter course credit" name="credit" required>
            <label for="semester"><b>Semester</b></label>
            <input type="text" placeholder="Enter semester" name="semester" required>
            <button type="submit" class="btn" name="upload">SUBMIT</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        </form>
    </div>
    <div class="bodyy" id="mybody">
        <div class="containerr">
            <div class="card-wrapper">
                <?php for ($i = 0; $i < $n; $i++) { ?>
                    <a href="classlayoutfinal_tea.php?c_id=<?php echo $cc[$i];?>">
                        <div class="card">
                            <img style="height: 120px;width:120px;object-fit:cover;border-radius:100%;" src="<?php if (isset($dp[$i])) echo '../'.$dp[$i]; ?>" alt="">
                            <h2><?php if (isset($cname[$i])) echo $cname[$i]; ?></h2>
                            <p><?php if (isset($tname[$i])) echo $tname[$i]; ?>
                            </p>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
    <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";
            document.getElementById("mybody").style.display = "none";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
            document.getElementById("mybody").style.display = "flex";
        }
    </script>
</body>

</html>