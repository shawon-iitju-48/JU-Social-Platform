<?php
session_start();
$_SESSION['kotore'] = 0;
$con = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
$resc = mysqli_fetch_array(mysqli_query($con, "select count(no_id) as nnn from (select *from notifications where u_id=" . $_SESSION['u_id'] . ")x inner join user on x.sender=user.u_id order by no_id desc"));
if ($resc['nnn'] > $_SESSION['kotore']) {
    $res = mysqli_query($con, "select *from (select *from notifications where u_id=" . $_SESSION['u_id'] . ")x inner join user on x.sender=user.u_id order by no_id desc limit " . $_SESSION['kotore'] . "," . $resc['nnn'] . "");
    $_SESSION['kotore'] = $resc['nnn'];
    while ($row = mysqli_fetch_assoc($res)) {
        echo '<div ';
        if ($row['isseen'] == 'yes') echo 'style="color:#65676B"';
        echo 'class="cd" id="' . $row['senderentity'] . '--' . $row['no_id'] . '">
        <div class="left">';
        if ($row['type'] == 'group') {
            $temp = mysqli_fetch_assoc(mysqli_query($con, "select *from user_groups where gid=" . $row['senderentity'] . ""));
            echo '<a href="group.php?gid=' . $row['senderentity'] . '"><img src="' . $temp['cover'] . '" alt=""></a>';
        } else echo '
            <a href="peopleprofile.php?pi=' . $row['sender'] . '"><img src="' . $row['dp'] . '" alt=""></a>';
        echo '
        </div>
        <div class="mid">
            <p>';
        if ($row['type'] != 'group') {
            echo '<a href="peopleprofile.php?pi=' . $row['sender'] . '" ';
            if ($row['isseen'] == 'yes') echo 'style="color:#65676B"';
            echo '>' . $row['fname'] . ' ' . $row['lname'] . '</a>';
        }
        if ($row['type'] == 'usercomment')
            echo 'commented on your post';
        else if ($row['type'] == 'userlike')
            echo 'liked your post';
        else if ($row['type'] == 'accepted')
            echo 'accepted your friend request.';
        else if ($row['type'] == 'sent')
            echo 'sent you a friend request.';
        else if ($row['type'] == 'groupcomment') {
            $matha = mysqli_fetch_assoc(mysqli_query($con, "select *from grouppost natural join user_groups where gpid=" . $row['senderentity'] . ""));
            echo 'commented on your post in <a href="group.php?gid=' . $matha['gid'] . '" ';
            if ($row['isseen'] == 'yes') echo 'style="color:#65676B"';
            echo '>' . $matha['gname'] . '</a>';
        } else if ($row['type'] == 'grouplike') {
            $matha = mysqli_fetch_assoc(mysqli_query($con, "select *from grouppost natural join user_groups where gpid=" . $row['senderentity'] . ""));
            echo 'liked your post in <a href="group.php?gid=' . $matha['gid'] . '" ';
            if ($row['isseen'] == 'yes') echo 'style="color:#65676B"';
            echo '>' . $matha['gname'] . '</a>';
        } else if ($row['type'] == 'group') {
            $matha = mysqli_fetch_assoc(mysqli_query($con, "select *from user_groups where gid=" . $row['senderentity'] . ""));
            echo 'Welcome to <a href="group.php?gid=' . $matha['gid'] . '" ';
            if ($row['isseen'] == 'yes') echo 'style="color:#65676B"';
            echo '>' . $matha['gname'] . '</a>' . ', Admin has approved your request to join.';
        } else if ($row['type'] == 'grouppost') {
            $matha = mysqli_fetch_assoc(mysqli_query($con, "select *from grouppost natural join user_groups where gpid=" . $row['senderentity'] . ""));
            echo 'posted in <a href="group.php?gid=' . $matha['gid'] . '" ';
            if ($row['isseen'] == 'yes') echo 'style="color:#65676B"';
            echo '>' . $matha['gname'] . '</a>';
        }
        else if ($row['type'] == 'groupinvite') {
            $matha = mysqli_fetch_assoc(mysqli_query($con, "select *from user_groups where gid=" . $row['senderentity'] . ""));
            echo 'has invited you in <a href="group.php?gid=' . $matha['gid'] . '" ';
            if ($row['isseen'] == 'yes') echo 'style="color:#65676B"';
            echo '>' . $matha['gname'] . '</a>';
        } 
        echo '</p>
        
        </div>
        <small style="color:blue;margin-left:.5rem;';
        date_default_timezone_set('Asia/Dhaka');
        $ndate = date('Y-m-d');
        $ntime = date('H:i:s');
        $date1 = $row['ndate'] . ' ' . $row['ntime'];
        $date2 = $ndate . ' ' . $ntime;

        $diff = abs(strtotime($date2) - strtotime($date1));

        $years   = floor($diff / (365 * 60 * 60 * 24));
        $months  = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days    = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

        $hours   = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));

        $minuts  = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);

        $seconds = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));


        if ($row['isseen'] == 'yes') echo 'color:#65676B';
        echo '">';
        if ($years != 0)
            echo $years . ' years';
        else if ($months != 0)
            echo $months . ' months';
        else if ($days != 0)
            echo $days . ' days';
        else if ($hours != 0)
            echo $hours . ' hours';
        else if ($minuts != 0)
            echo $minuts . ' minuts';
        else if ($seconds != 0)
            echo $seconds . ' seconds';

        echo ' ago</small>
    </div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <script>
        $(document).ready(function() {
            $(".cd").unbind().click(function(e) {
                var normiid = this.id.split("--")[0];
                var noid = this.id.split("--")[1]
                $(location).prop('href', "normaladd.php?pidd=" + normiid + "& noid=" + noid);
            });
        });
    </script>
</body>

</html>