<?php
session_start();
$uid = $_SESSION['u_id'];
$connect = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
if (isset($_POST['bindas'], $_POST['pid'])) {
    date_default_timezone_set('Asia/Dhaka');
    $monthNum = date('m');
    $monthName = date("F", mktime(0, 0, 0, $monthNum, 10));
    $comdate = $monthName . ' ' . date('d') . ', ' . date('Y');
    $comtime = date('h:i A');
    $ok = $_POST['bindas'];

    $cnt1 = "select *from grouppost where  gpid=" . $_POST["pid"] . "";
    $cnt2 = mysqli_query($connect, $cnt1);
    $cnt3 = mysqli_fetch_array($cnt2);
    $y = $cnt3['commentcnt'];
    $y = $y + 1;
    $query5 = "update grouppost set commentcnt='$y' where gpid=" . $_POST["pid"] . "";
    $query = "insert into grouppost_comments(comtime, comdate, gpid, memberid,comdetails) values('$comtime','$comdate'," . $_POST['pid'] . ",'$uid','$ok')";
    if (mysqli_query($connect, $query) && mysqli_query($connect, $query5))
        echo "commentDone";
    else echo "UnsuccessCommment";

    date_default_timezone_set('Asia/Dhaka');
    $ndate = date('Y-m-d');
    $ntime = date('H:i:s');
    $rup = mysqli_fetch_assoc(mysqli_query($connect, "select grouppost.memberid FROM grouppost_comments inner join grouppost on grouppost_comments.gpid=grouppost.gpid where grouppost_comments.gpid=" . $_POST['pid'] . " limit 1"));
    $bup=mysqli_fetch_assoc(mysqli_query($connect, "select *from group_member where memberid=".$rup['memberid']." and gid=".$cnt3['gid'].""));
    if ($rup['memberid'] != $_SESSION['u_id'] and $bup['mute']=='off')
        mysqli_query($connect, "insert into notifications(type, sender, senderentity, ndate, ntime, u_id) values('groupcomment','$uid'," . $_POST['pid'] . ",'$ndate','$ntime'," . $rup['memberid'] . ")");
}
if (isset($_POST['droid'])) {
    $com = "select *from grouppost inner join grouppost_comments on grouppost.gpid=grouppost_comments.gpid inner join user on grouppost_comments.memberid=user.u_id where grouppost.gpid=" . $_POST['droid'] . " order by comid desc limit 2;";
    $com2 = mysqli_query($connect, $com);
    $c = 0;
    while ($com3 = mysqli_fetch_assoc($com2)) {
        $c++;
        echo '<div class="comment"> 
       <div class="left">
           <a href="peopleprofile.php?pi=' . $com3["memberid"] . '"><img src="' . $com3["dp"] . '" alt=""></a>
       </div>
       <div class="right">
           <a href="peopleprofile.php?pi=' . $com3["memberid"] . '"><b>' . $com3["fname"] . ' ' . $com3["lname"] . '</b></a>
           <p style="font-size: .8rem;margin-bottom: .5rem;">' . $com3["comdate"] . ' at ' . $com3["comtime"] . '</p>
           <p>' . $com3["comdetails"] . '</p>
       </div>
   </div>';
    }
    if ($c == 2)
        echo '<p class="view-more" id="' . $_POST['droid'] . '____' . '">View more comments</p>';
}
if (isset($_POST['boid'])) {
    $com = "select *from grouppost inner join grouppost_comments on grouppost.gpid=grouppost_comments.gpid inner join user on grouppost_comments.memberid=user.u_id where grouppost.gpid=" . $_POST['boid'] . " order by comid desc;";
    $com2 = mysqli_query($connect, $com);
    while ($com3 = mysqli_fetch_assoc($com2)) {
        echo '<div class="comment"> 
       <div class="left">
           <a href="peopleprofile.php?pi=' . $com3["memberid"] . '"><img src="' . $com3["dp"] . '" alt=""></a>
       </div>
       <div class="right">
           <a href="peopleprofile.php?pi=' . $com3["memberid"] . '"><b>' . $com3["fname"] . ' ' . $com3["lname"] . '</b></a>
           <p style="font-size: .8rem;margin-bottom: .5rem;">' . $com3["comdate"] . ' at ' . $com3["comtime"] . '</p>
           <p>' . $com3["comdetails"] . '</p>
       </div>
   </div>';
    }
}
if (isset($_POST["bhai"])) {
    $cnt1 = "select *from grouppost where  gpid=" . $_POST["bhai"] . "";
    $cnt2 = mysqli_query($connect, $cnt1);
    $cnt3 = mysqli_fetch_array($cnt2);
    $y = $cnt3['commentcnt'];
    echo $y;
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
            $(".view-more").unbind().click(function() {
                var boid = this.id.split("_")[0];
                $.ajax({
                    url: "groupcomment.php",
                    method: "POST",
                    data: {
                        boid: boid
                    },
                    cache: false,
                    success: function(data) {
                        if (data != "") {
                            $('#' + boid + '____').html("");
                            $('#' + boid + '____').append(data);
                        }
                        //    console.log(data);
                    }
                });
            });
        });
    </script>
</body>

</html>