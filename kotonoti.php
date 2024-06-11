<?php
session_start();
$connect = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
$query = "select seen from seen where u_id=" . $_SESSION['u_id'] . "";
$a = mysqli_fetch_assoc(mysqli_query($connect, "select count(no_id) as noo from notifications where u_id=" . $_SESSION['u_id'] . ""));
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);
if ($a) {
    $d = $a['noo'] - $row['seen'];
    if ($d != 0)
        echo '<span id="kotonoti" class="rounded-circle">' . $d . '</span>';
}
