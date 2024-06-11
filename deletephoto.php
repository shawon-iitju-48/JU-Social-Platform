<?php
session_start();
$con = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
if (isset($_POST['paisi'], $_POST['podd'])) {
    $pid = $_POST['podd'];
    $q4 = "select count(pid) as kotore from userpost natural join userpost_photos where pid='$pid'";
    $q4res = mysqli_query($con, $q4);
    $q4res1 = mysqli_fetch_assoc($q4res);

    $query = "select *from userpost_photos natural join userpost natural join user where pid='$pid' and photosid=" . $_POST['paisi'] . "";
    $queryres = mysqli_query($con, $query);
    $shawon = mysqli_fetch_assoc($queryres);
    if ($shawon['location'] == $shawon['dp'])
        {
            mysqli_query($con, "update user set dp='images/defaultdp.png' where u_id=" . $shawon['u_id'] . "");
            $_SESSION['dp']="images/defaultdp.png";
        }
    $q2 = "delete from userpost_photos where pid='$pid' and photosid=" . $_POST['paisi'] . "";
    mysqli_query($con, $q2);
    if ($q4res1['kotore'] == 1) {
        $q5 = "delete from userpost_likes where pid='$pid'";
        mysqli_query($con, $q5);
        $q5 = "delete from userpost_comments where pid='$pid'";
        mysqli_query($con, $q5);
        $q5 = "delete from userpost where pid='$pid'";
        mysqli_query($con, $q5);
        echo "susu";
    } else echo "baba";
}

if (isset($_POST['paisii'], $_POST['poddi'])) {
    $pid = $_POST['poddi'];
    $q4 = "select count(gpid) as kotore from grouppost natural join grouppost_photos where gpid='$pid'";
    $q4res = mysqli_query($con, $q4);
    $q4res1 = mysqli_fetch_assoc($q4res);

    $query = "select *from grouppost_photos natural join grouppost inner join  user on user.u_id= grouppost.memberid where gpid='$pid' and photosid=" . $_POST['paisii'] . "";
    $queryres = mysqli_query($con, $query);
    $shawon = mysqli_fetch_assoc($queryres);
    
    $q2 = "delete from grouppost_photos where gpid='$pid' and photosid=" . $_POST['paisii'] . "";
    mysqli_query($con, $q2);
    if ($q4res1['kotore'] == 1) {
        $q5 = "delete from grouppost_likes where gpid='$pid'";
        mysqli_query($con, $q5);
        $q5 = "delete from grouppost_comments where gpid='$pid'";
        mysqli_query($con, $q5);
        $q5 = "delete from grouppost where gpid='$pid'";
        mysqli_query($con, $q5);
        echo "susu";
    } else echo "baba";
}
