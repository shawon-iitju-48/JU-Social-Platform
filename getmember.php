<?php
session_start();
$connect = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
if (isset($_POST["ltd"], $_POST["std"])) {
    $connect = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
    $query = "select *from user natural join (select rqfrom as u_id from grouprequests where rqto=" . $_SESSION['gid'] . ")x limit " . $_POST["std"] . ", " . $_POST["ltd"] . "";
    $result = mysqli_query($connect, $query);
    $fl = 0;
    while ($row = mysqli_fetch_array($result)) {
        $fl++;
        echo '<div class="card">
       <a href=""><img src="';
        if (!empty($row['dp'])) echo '' . $row['dp'] . '';
        else echo 'images/defaultdp.png';
        echo '" alt=""></a>
       <a href="" style="text-align: center;"><b>' . $row['fname'] . ' ' . $row['lname'] . '</b></a>
       <p style="text-align: center;">Lives in ' . $row['currentaddr'] . '</p>
       <div style="display:flex;padding:0rem 1rem;">
       <button id="' . $row['u_id'] . '" class="btn btn-primary accept" style="width: 45%;margin-bottom:1rem;">Confirm </button>
       <button id="' . $row['u_id'] . '-" class="btn btn-secondary deny" style="width: 45%;margin-left:1.5rem;margin-bottom:1rem;">Cancel</button></div>
   </div>
   </div>';
    }
}
if (isset($_POST["bhaija"])) {
    $connect = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
    $query = "delete from grouprequests where rqfrom=".$_POST["bhaija"]." and rqto=".$_SESSION['gid']."";
    mysqli_query($connect, $query);
    $a=$_POST["bhaija"];
    $u=$_SESSION['gid'];
    $sender=$_SESSION['u_id'];
    date_default_timezone_set('Asia/Dhaka');
    $ndate = date('Y-m-d');
    $ntime = date('H:i:s');
    mysqli_query($connect, "insert into notifications(type, sender, senderentity, ndate, ntime, u_id) values('group','$sender','$u','$ndate','$ntime','$a')");

    $query1 = "insert into group_member(memberid, gid) values('$a','$u')";
    mysqli_query($connect, $query1);
    $query10 = "select *from user_groups where gid=".$_SESSION['gid']."";
    $res10=mysqli_query($connect, $query10);
    $res11=mysqli_fetch_array($res10);
    $mem=$res11['member'];
    $mem=$mem+1;
    $query15 = "update user_groups set member='$mem' where gid=".$_SESSION['gid']."";
    mysqli_query($connect, $query15);

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="icon" href="images/icob.svg">

</head>

<body>
    <script>
        $(document).ready(function() {

            $(".accept").unbind().click(function(e) {
                console.log(this.id);
                $.ajax({
                    url: "getmember.php",
                    method: "POST",
                    data: {
                        bhaija: this.id
                    },
                    cache: false,
                    success: function(data) {

                        console.log(data);
                    }
                });
                $(location).prop('href', "group.php?gid=<?php echo $_SESSION['gid']?>");
            });
      
        });
    </script>
</body>

</html>