<?php
session_start();
function check_login($con)
{
    if(isset($_SESSION['u_id']))
    {
        $u_id=$_SESSION['u_id'];
        $query="select * from user where u_id= '$u_id'";
        $result=mysqli_query($con,$query);
        if($result && mysqli_num_rows($result)>0)
        {
            $user_data=mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    header("Location:../login.php");
    die;
}
?>