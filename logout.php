<?php
session_start();
$con = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
if(isset($_SESSION['u_id']))
{
  unset($_SESSION['u_id']);
  $u_id=$_SESSION['u_id'];
  mysqli_query($con, "update user set sstatus='Offline' where u_id='$u_id'");
}
header("Location: login.php");
