<?php
if(isset($_SESSION['u_id']))
{
  unset($_SESSION['u_id']); 
  setcookie('u_id', "", time() + (86400 * 30), "/");
}
//header("Location: login.php");
echo "<script>location.href = '../login.php';</script>";
?>