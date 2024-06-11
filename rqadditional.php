<?php
session_start();
$connect = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
if (isset($_POST['rqpathaona'])) {
    $jau=$_POST['rqpathaona'];
    $doit = "select *from requests where rqfrom=" . $_SESSION['u_id'] . " and rqto='$jau'";
    $doitres = mysqli_query($connect, $doit);
    if (mysqli_fetch_assoc($doitres)) {
        $ebarkor = "delete from requests where rqfrom=" . $_SESSION['u_id'] . " and rqto='$jau'";
        mysqli_query($connect, $ebarkor);
        echo "plus";
    } else {
        $kkk = $_SESSION['u_id'];
        $ebarkor = "insert into requests(rqfrom, rqto) values('$kkk','$jau' )";

        date_default_timezone_set('Asia/Dhaka');
        $ndate = date('Y-m-d');
        $ntime = date('H:i:s');
        mysqli_query($connect, "insert into notifications(type, sender, senderentity, ndate, ntime, u_id) values('sent','$kkk','$kkk','$ndate','$ntime','$jau')");

        mysqli_query($connect, $ebarkor);
        echo 'minus';
    }
}

if (isset($_POST['accept'])) {
    $pi=$_POST['accept'];
    $ebarkor = "delete from requests where rqto=" . $_SESSION['u_id'] . " and rqfrom='$pi'";
    mysqli_query($connect, $ebarkor);

    $kkk = $_SESSION['u_id'];
    date_default_timezone_set('Asia/Dhaka');
    $ndate = date('Y-m-d');
    $ntime = date('H:i:s');
    mysqli_query($connect, "insert into notifications(type, sender, senderentity, ndate, ntime, u_id) values('accepted','$kkk','$kkk','$ndate','$ntime','$pi')");
    $query1 = "insert into user_friends(friendfrom, friendto) values('$kkk','$pi')";
    mysqli_query($connect, $query1);

    $query2 = "insert into user_friends(friendto, friendfrom) values('$kkk','$pi')";
    mysqli_query($connect, $query2);
    
    $frndcnt=mysqli_fetch_assoc(mysqli_query($connect, "select friends from user where u_id=".$_SESSION['u_id'].""));
    $frndct=$frndcnt['friends']+1;
    mysqli_query($connect, "update user set friends='$frndct' where u_id=".$_SESSION['u_id']."");

    $frndcnt=mysqli_fetch_assoc(mysqli_query($connect, "select friends from user where u_id='$pi'"));
    $frndct=$frndcnt['friends']+1;
    mysqli_query($connect, "update user set friends='$frndct' where u_id='$pi'");
}

if (isset($_POST['xd'])) {
    $jauna=$_POST['xd'];
    $doit = "select *from grouprequests where rqfrom=" . $_SESSION['u_id'] . " and rqto='$jauna'";
    $doitres = mysqli_query($connect, $doit);
    if (mysqli_fetch_assoc($doitres)) {
        $ebarkor = "delete from grouprequests where rqfrom=" . $_SESSION['u_id'] . " and rqto='$jauna'";
        mysqli_query($connect, $ebarkor);
        echo "plus";
    } else {
        $kkk = $_SESSION['u_id'];
        $ebarkor = "insert into grouprequests(rqfrom, rqto) values('$kkk','$jauna' )";
        mysqli_query($connect, $ebarkor);
        echo 'minus';
    }
}
