<?php
session_start();
$con = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
$pid = $_GET['pidd'];
$noid = $_GET['noid'];
$nomi = mysqli_fetch_assoc(mysqli_query($con, "select *from notifications where no_id='$noid'"));
mysqli_query($con, "update notifications set isseen='yes' where no_id='$noid'");
if($nomi['type'] == 'sent' || $nomi['type'] == 'accepted')
header("Location: peopleprofile.php?pi=$pid");
else if ($nomi['type'] == 'grouplike' || $nomi['type'] == 'groupcomment' || $nomi['type'] == 'grouppost')
    header("Location: group_view_only_post.php?pidd=$pid");
else if ($nomi['type'] == 'group' || $nomi['type'] == 'groupinvite')
    header("Location: group.php?gid=$pid");
else
    header("Location: view_only_post.php?pidd=$pid");
