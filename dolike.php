<?php
session_start();
$connect = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
$uid = $_SESSION['u_id'];
if (isset($_POST["pid"])) {
    $like1 = "select *from userpost_likes where u_id='$uid' and pid=" . $_POST["pid"] . "";
    $like2 = mysqli_query($connect, $like1);
    $like3 = mysqli_fetch_array($like2);


    $cnt1 = "select *from userpost where  pid=" . $_POST["pid"] . "";
    $cnt2 = mysqli_query($connect, $cnt1);
    $cnt3 = mysqli_fetch_array($cnt2);
    $y = $cnt3['likecount'];
    if (!$like3) {
        date_default_timezone_set('Asia/Dhaka');
        $monthNum = date('m');
        $monthName = date("F", mktime(0, 0, 0, $monthNum, 10));
        $ldate = $monthName . ' ' . date('d') . ', ' . date('Y');
        $ltime = date('h:i A');

        $y = $y + 1;
        $query = "insert into userpost_likes(ltime, ldate, pid, u_id) values('$ltime','$ldate'," . $_POST["pid"] . "," . $_SESSION["u_id"] . ");";
        $query5 = "update userpost set likecount='$y' where pid=" . $_POST["pid"] . "";
        if (mysqli_query($connect, $query) && mysqli_query($connect, $query5))
            echo "successfull";

        date_default_timezone_set('Asia/Dhaka');
        $ndate = date('Y-m-d');
        $ntime = date('H:i:s');
        $rup = mysqli_fetch_assoc(mysqli_query($connect, "select userpost.u_id FROM userpost_likes inner join userpost on userpost_likes.pid=userpost.pid where userpost_likes.pid=" . $_POST['pid'] . " limit 1"));
        if ($rup['u_id'] != $_SESSION['u_id'])
            mysqli_query($connect, "insert into notifications(type, sender, senderentity, ndate, ntime, u_id) values('userlike','$uid'," . $_POST['pid'] . ",'$ndate','$ntime'," . $rup['u_id'] . ")");
    } else {
        $y = $y - 1;
        $query = "delete from  userpost_likes where u_id='$uid' and pid=" . $_POST["pid"] . "";
        $query5 = "update userpost set likecount='$y' where pid=" . $_POST["pid"] . "";
        if (mysqli_query($connect, $query) && mysqli_query($connect, $query5))
            echo "deleted";
    }
}
if (isset($_POST["poid"])) {
    $cnt1 = "select *from userpost where pid=" . $_POST["poid"] . "";
    $cnt2 = mysqli_query($connect, $cnt1);
    $cnt3 = mysqli_fetch_array($cnt2);
    $y = $cnt3['likecount'];
    echo $y;
}
