<?php
session_start();
$connect = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
$uid = $_SESSION['u_id'];
if (isset($_POST["pid"])) {
    $like1 = "select *from grouppost_likes where memberid='$uid' and gpid=" . $_POST["pid"] . "";
    $like2 = mysqli_query($connect, $like1);
    $like3 = mysqli_fetch_array($like2);


    $cnt1 = "select *from grouppost where  gpid=" . $_POST["pid"] . "";
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
        $query = "insert into grouppost_likes(ltime, ldate, gpid, memberid) values('$ltime','$ldate'," . $_POST["pid"] . "," . $_SESSION["u_id"] . ");";
        $query5 = "update grouppost set likecount='$y' where gpid=" . $_POST["pid"] . "";
        if (mysqli_query($connect, $query) && mysqli_query($connect, $query5))
            echo "successfull";

        date_default_timezone_set('Asia/Dhaka');
        $ndate = date('Y-m-d');
        $ntime = date('H:i:s');
        $rup = mysqli_fetch_assoc(mysqli_query($connect, "select grouppost.memberid FROM grouppost_likes inner join grouppost on grouppost_likes.gpid=grouppost.gpid where grouppost_likes.gpid=" . $_POST['pid'] . " limit 1"));
        $bup=mysqli_fetch_assoc(mysqli_query($connect, "select *from group_member where memberid=".$rup['memberid']." and gid=".$cnt3['gid'].""));
        if ($rup['memberid'] != $_SESSION['u_id'] and $bup['mute']=='off')
            mysqli_query($connect, "insert into notifications(type, sender, senderentity, ndate, ntime, u_id) values('grouplike'," . $_SESSION["u_id"] . "," . $_POST['pid'] . ",'$ndate','$ntime'," . $rup['memberid'] . ")");
    } else {
        $y = $y - 1;
        $query = "delete from  grouppost_likes where memberid='$uid' and gpid=" . $_POST["pid"] . "";
        $query5 = "update grouppost set likecount='$y' where gpid=" . $_POST["pid"] . "";
        if (mysqli_query($connect, $query) && mysqli_query($connect, $query5))
            echo "deleted";
    }
}
if (isset($_POST["poid"])) {
    $cnt1 = "select *from grouppost where gpid=" . $_POST["poid"] . "";
    $cnt2 = mysqli_query($connect, $cnt1);
    $cnt3 = mysqli_fetch_array($cnt2);
    $y = $cnt3['likecount'];
    echo $y;
}
