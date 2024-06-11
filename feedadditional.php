<?php
session_start();
$connect = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
if (isset($_POST["limit"], $_POST["start"])) {
    $gui = "select *from user_groups where u_id=" . $_SESSION['u_id'] . " LIMIT " . $_POST["start"] . ", " . $_POST["limit"] . "";
    $photo1 = mysqli_query($connect, $gui);
    while ($row = mysqli_fetch_array($photo1)) {
        echo  '<div class="cd">
        <div class="left">
            <a href="group.php?gid=' . $row['gid'] . '"><img src="' . $row['cover'] . '" alt=""></a>
        </div>
        <div class="mid">
            <a href="group.php?gid=' . $row['gid'] . '">' . $row['gname'] . '</a>
            <small> Private Group . ' . $row['member'] . ' Member</small>
            <p class="truncate">' . $row['about'] . '</p>
        </div>
    </div>';
    }
}

if (isset($_POST["limitj"], $_POST["startj"])) {
    $gui = "select *from user_groups NATURAL join (select god as gid from (select gid as god from group_member where memberid=" . $_SESSION['u_id'] . ")x left join (select gid as pod from user_groups where u_id=" . $_SESSION['u_id'] . ")y on god=pod where pod is null)z LIMIT " . $_POST["startj"] . ", " . $_POST["limitj"] . "";
    $photo1 = mysqli_query($connect, $gui);
    while ($row = mysqli_fetch_array($photo1)) {
        echo  '<div class="cd">
        <div class="left">
            <a href="group.php?gid=' . $row['gid'] . '"><img src="' . $row['cover'] . '" alt=""></a>
        </div>
        <div class="mid">
            <a href="group.php?gid=' . $row['gid'] . '">' . $row['gname'] . '</a>
            <small> Private Group . ' . $row['member'] . ' Member</small>
            <p class="truncate">' . $row['about'] . '</p>
        </div>
    </div>';
    }
}


if (isset($_POST["limitd"], $_POST["startd"])) {
    $gui = "select *from user_groups left join (select god as gidd from (select gid as god from group_member where memberid=" . $_SESSION['u_id'] . ")x union select gid as pod from user_groups where u_id=" . $_SESSION['u_id'] . ")f on user_groups.gid=f.gidd where f.gidd is null LIMIT " . $_POST["startd"] . ", " . $_POST["limitd"] . "";
    $photo1 = mysqli_query($connect, $gui);
    while ($row = mysqli_fetch_array($photo1)) {
        echo  '<div class="cd">
        <div class="left">
            <a href="group.php?gid=' . $row['gid'] . '"><img src="' . $row['cover'] . '" alt=""></a>
        </div>
        <div class="mid">
            <a href="group.php?gid=' . $row['gid'] . '">' . $row['gname'] . '</a>
            <small> Private Group . ' . $row['member'] . ' Member</small>
            <p class="truncate">' . $row['about'] . '</p>
        </div>
    </div>';
    }
}


if (isset($_POST["omago"])) {
    $kh = "%" . $_POST['omago'] . "%";
    $gui = "select *from user_groups NATURAL join (select gid from group_member where memberid=" . $_SESSION['u_id'] . ")x  where gname like '$kh'";
    $photo1 = mysqli_query($connect, $gui);
    while ($row = mysqli_fetch_array($photo1)) {
        echo  '<div class="cd">
        <div class="left">
            <a href="group.php?gid=' . $row['gid'] . '"><img src="' . $row['cover'] . '" alt=""></a>
        </div>
        <div class="mid">
            <a href="group.php?gid=' . $row['gid'] . '">' . $row['gname'] . '</a>
            <small> Private Group . ' . $row['member'] . ' Member</small>
            <p class="truncate">' . $row['about'] . '</p>
        </div>
    </div>';
    }
}
