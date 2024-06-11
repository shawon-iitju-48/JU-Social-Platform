<?php
session_start();
$connect = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
if (isset($_POST["limitp"], $_POST["startp"])) {
    $gui = "select *from grouppost natural join grouppost_photos where gid=" . $_SESSION['gid'] . " order by gpid desc LIMIT " . $_POST["startp"] . ", " . $_POST["limitp"] . "";
    $photo1 = mysqli_query($connect, $gui);
    while ($photo2 = mysqli_fetch_array($photo1)) {
        echo  '<div class="photos">
        <div class="left">
            <a href="groupphotoview.php?pidd='.$photo2['gpid'] .'"><img src="' . $photo2['location'] . '" alt=""></a>
        </div>
    </div>';
    }
}
if (isset($_POST["limitf"], $_POST["startf"])) {
    $fr = "select fname, lname, dp, user.u_id, id_type, university from user inner join (select *from group_member NATURAL join user_groups where gid=" . $_SESSION['gid'] . ")x on x.memberid=user.u_id where user.u_id<>" . $_SESSION['u_id'] . " LIMIT " . $_POST["startf"] . ", " . $_POST["limitf"] . "";
    $fr0 = mysqli_query($connect, $fr);
    while ($fr4 = mysqli_fetch_array($fr0)) {
        echo '<div class="friend">
        <div class="left">
            <a href="peopleprofile.php?pi=' . $fr4["u_id"] . '"><img src="';
        if (!empty($fr4['dp'])) echo $fr4['dp'];
        else echo 'images/defaultdp.png';
        echo '" alt=""></a>
        </div>
        <div class="right">
            <a href="peopleprofile.php?pi=' . $fr4["u_id"] . '">
                <h5>' . $fr4['fname'] . ' ' . $fr4['lname'] . '</h5>
            </a>
            <p>' . $fr4['id_type'] . ' at ' . $fr4['university'] . '</p>';
        if ($_SESSION['admin'] == $fr4['u_id'])
            echo '<p class="btn btn-primary"><i class="fa fa-user" style="margin-right:.5rem"></i>Admin</p>';
        echo '
        </div>
    </div>';
    }
}

if (isset($_POST["limitv"], $_POST["startv"])) {
    $vui = "select *from grouppost natural join grouppost_videos where gid=" . $_SESSION['gid'] . " order by gpid desc LIMIT " . $_POST["startv"] . ", " . $_POST["limitv"] . "";
    $video1 = mysqli_query($connect, $vui);
    while ($video2 = mysqli_fetch_array($video1)) {

        echo ' <div class="photos">
    <div class="left">
        <a href="#"><video style="border-radius: 10px; object-fit: cover;" width="865" height="480" controls>
                <source src="' . $video2['location'] . '" type="video/mp4">
                Your browser does not support the video tag.
            </video></a>
    </div>
</div>';
    }
}

if (isset($_POST["omago"])) {
    $kh = "%" . $_POST['omago'] . "%";
    $fr = "select fname, lname, dp,user.u_id,id_type, university  from user inner join (select *from group_member NATURAL join user_groups where gid=" . $_SESSION['gid'] . ")x on x.memberid=user.u_id where user.u_id<>" . $_SESSION['u_id'] . " and (fname like '$kh' or lname like '$kh' or concat_ws(' ',fname, lname) like '$kh')";
    $fr0 = mysqli_query($connect, $fr);
    while ($fr4 = mysqli_fetch_array($fr0)) {
        echo '<div class="friend">
        <div class="left">
            <a href="peopleprofile.php?pi=' . $fr4["u_id"] . '"><img src="';
        if (!empty($fr4['dp'])) echo $fr4['dp'];
        else echo 'images/defaultdp.png';
        echo '" alt=""></a>
        </div>
        <div class="right">
            <a href="peopleprofile.php?pi=' . $fr4["u_id"] . '">
                <h5>' . $fr4['fname'] . ' ' . $fr4['lname'] . '</h5>
            </a>
            <p>' . $fr4['id_type'] . ' at ' . $fr4['university'] . '</p>';
        if ($_SESSION['admin'] == $fr4['u_id'])
            echo '<p class="btn btn-primary"><i class="fa fa-user" style="margin-right:.5rem"></i>Admin</p>';
        echo '

        </div>
    </div>';
    }
}
if (isset($_POST["natore"])) {
    $kh = "%" . $_POST['natore'] . "%";
    $q = "select *from (select *from user NATURAL join (select friendto as u_id from user_friends where 
    friendfrom=" . $_SESSION['u_id'] . " and friendto<>" . $_SESSION['u_id'] . ")x)y left join (select rqfrom as xxx from grouprequests where rqto=" . $_SESSION['gid'] . " union select memberid as xxx from group_member where gid=" . $_SESSION['gid'] . ")z on y.u_id=z.xxx where z.xxx is null and ( fname like '$kh' or lname like '$kh' or concat_ws(' ',fname, lname) like '$kh')";
    $subres = mysqli_query($connect, $q);
    $DON = mysqli_query($connect, $q);
    $DON2 = mysqli_fetch_array($DON);
    if (!$DON2)
        echo '<p>No results found.</p>';

    while ($res = mysqli_fetch_array($subres)) {
        echo '<div class="invite">
        <input class="form-check-input" id="xd" name="lang[]" type="checkbox" value="' . $res['u_id'] . '">
        <p style="margin-left:.5rem">' . $res['fname'] . ' ' . $res['lname'] . '</p>
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
        $("#work").click(function() {
            $(".info").css("display", "block");
            $(".places").css("display", "none");
            $(".relationship").css("display", "none");
            $(".aboutyou").css("display", "none");
            $(".contact").css("display", "none");
        });
        $("#place").click(function() {
            $(".info").css("display", "none");
            $(".places").css("display", "block");
            $(".relationship").css("display", "none");
            $(".aboutyou").css("display", "none");
            $(".contact").css("display", "none");
        });
        $("#contact").click(function() {
            $(".info").css("display", "none");
            $(".places").css("display", "none");
            $(".relationship").css("display", "none");
            $(".aboutyou").css("display", "none");
            $(".contact").css("display", "block");
        });
        $("#status").click(function() {
            $(".info").css("display", "none");
            $(".places").css("display", "none");
            $(".relationship").css("display", "block");
            $(".aboutyou").css("display", "none");
            $(".contact").css("display", "none");
        });
        $("#you").click(function() {
            $(".info").css("display", "none");
            $(".places").css("display", "none");
            $(".relationship").css("display", "none");
            $(".aboutyou").css("display", "block");
            $(".contact").css("display", "none");
        });
    </script>
</body>

</html>