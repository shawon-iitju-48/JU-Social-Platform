<?php
session_start();
$connect = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
$query = "select count(tid) as mm from temp where karconvo=" . $_SESSION['u_id'] . " and seen='no'";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);
if ($row['mm'] != 0) {
    echo '<span id="kotomessage" class="rounded-circle">' . $row['mm'] . '</span>';
}
