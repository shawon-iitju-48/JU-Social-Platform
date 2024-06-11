<?php
session_start();
$connect = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
$query = "select count(rqfrom) as goa from requests where rqto=" . $_SESSION['u_id'] . "";
$result = mysqli_query($connect, $query);
if ($row = mysqli_fetch_array($result)) {
    if($row['goa']!=0)
    echo '<span id="kotorq" style="right:10px;" class="rounded-circle">'.$row['goa'].'</span>';
}
