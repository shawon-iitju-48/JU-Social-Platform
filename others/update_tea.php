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
    $sql = "select * from user natural join teacher natural join dept where u_id= '$uid' limit 1 ";
    $resl = mysqli_query($con, $sql);

    $row = mysqli_fetch_assoc($resl);
   
    $dname = $row['dept_name'];

    $idphoto = $row['id_image'];
    $dp = $row['dp'];
    $rinterest = $row['rinterest'];
    $designition = $row['designition'];

    if (isset($_POST['upload'])) {
          $str = bin2hex(random_bytes(15));

        if (!empty($_FILES["idphoto"]["name"])) {
            $iphoto = $_FILES["idphoto"]["name"];
            $tempnamee = $_FILES["idphoto"]["tmp_name"];
            $extensionn = strtolower(substr(strrchr($iphoto, '.'), 1));
            $newfilenamee = $uid . "_idphoto" .$str. "." . $extensionn;
            $idphoto = "dbfiles/" . $newfilenamee;
            move_uploaded_file($tempnamee, $idphoto);
        }

        


        if (!empty($_POST['rinterest']))
            $rinterest = $_POST['rinterest'];
        if (!empty($_POST['designition']))
            $designition = $_POST['designition'];


        $query = "update  teacher set designition='$designition', rinterest='$rinterest' where u_id='$uid'";
        mysqli_query($con, $query);
        $sql = "update user set id_image='$idphoto' where u_id='$uid'";
        mysqli_query($con, $sql);
        echo "<script>location.href = 'update_tea.php';</script>";
    }
    
    if(isset($_POST['rrin']))
    {
        $q="update  teacher set rinterest='' where u_id='$uid'";
        mysqli_query($con, $q);
        echo "<script>location.href = 'update_tea.php';</script>";
    }
    
   
    if(isset($_POST['ddesignition']))
    {
        $q="update  teacher set designition='' where u_id='$uid'";
        mysqli_query($con, $q);
        echo "<script>location.href = 'update_tea.php';</script>";
    }
    
    
    if(isset($_POST['iidphoto']))
    {
        $q="update  user set id_image='' where u_id='$uid'";
        mysqli_query($con, $q);
        echo "<script>location.href = 'update_tea.php';</script>";
    }
    
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="icon" href="./dbfiles/icob.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <!-- <link rel="stylesheet" href="css/ret.css"> -->
    <link rel="stylesheet" href="css/update.css">
</head>

<body>
    <header>
        <div class="container">
            <nav id="main-nav" class="flex items-center justify-between">
                <div class="left flex  items-center">
                    <div class="branding">
                        <a href="user_dashboard_t.php"><img style="width:60px;height:60px;object-fit:cover;border-radius:50%;border:3px solid var(--pure);" src="<?php if(isset($dp)) echo '../'.$dp; ?>" alt=""></a>
                    </div>
                    <div>
                        <a href="update_tea.php">edit profile</a>
                        <a href="class_tea.php">class room</a>
                        <div class="dropdown">
     
            <div class="dropdown-content">
                <form action="" method="post" enctype="multipart/form-data"> 
             
              <input type="submit" value="DESIGNITION" name="ddesignition"></input>
              <input type="submit" value="RESEARCH INTEREST" name="rrin"></input>
              
              
              <input type="submit" value="ID PHOTO" name="iidphoto"></input>
               
              </form>
            </div>
          </div>
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
            Update Your Profile
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="user-details">
                

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                
                
                
                <div class="input-box">
                    <span class="details">Designition</span>
                    <input type="text" id="designition" name='designition' placeholder="<?php if (isset($designition)) echo $designition; ?>"></input>
                </div>
                <div class="input-box" style="margin-right:15rem;">
                    <span class="details">Research Interest</span>
                    <input type="text" id="rinterest" name='rinterest' placeholder="<?php if (isset($rinterest)) echo $rinterest; ?>"></input>
                </div>

                
                <div class="input-box">
                    <span class="details"> Update your ID Card's photo</span>
                    <input class="upload" id="idphoto" type="file" name="idphoto">
                </div>
              
                <img src="<?php if (isset($idphoto)) echo $idphoto; ?>" alt="Your ID Card" style="object-fit: cover;margin:2rem 0;margin-right: 5rem;" height="300" width="300">
            </div>
            <div class="button up">
                <input style="width:100%;" type="submit" value="Update" name="upload">
            </div>
        </form>
    </div>
</div>
    <script>
        $('#cpd').on('keyup', function() {
            if ($('#pd').val() == $('#cpd').val()) {
                $('#demo').html('Matching').css('color', 'green');
            } else
                $('#demo').html('Not Matching').css('color', 'red');
        });
        $('#fname, #lname, #bg,#email,#pd, #phone, #house, #thana, #district, #designition, #rinterest, #dp, #idphoto').on('keyup', function() {
            $('#demo').html('').css('color', 'red');
        });
    </script>
</body>

</html>