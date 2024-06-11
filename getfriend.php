<?php
session_start();
if (isset($_POST["limit"], $_POST["start"])) {
    $connect = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
    // $query = "select *from user left join (select friendto from user_friends where friendfrom=" . $_SESSION['u_id'] . ")x on user.u_id=x.friendto where x.friendto is null limit " . $_POST["start"] . ", " . $_POST["limit"] . "";
    $query = "select *from (select *from user left join (select friendto from user_friends where friendfrom=" . $_SESSION['u_id'] . ")x on user.u_id=x.friendto where x.friendto is null)z left join (select rqfrom from requests where rqto=" . $_SESSION['u_id'] . " union select rqto from requests where rqfrom=" . $_SESSION['u_id'] . ")d on z.u_id=d.rqfrom where d.rqfrom is null limit " . $_POST["start"] . ", " . $_POST["limit"] . "";
    $result = mysqli_query($connect, $query);
    while ($row = mysqli_fetch_array($result)) {
        echo '<div class="card">
       <a href="peopleprofile.php?pi=' . $row["u_id"] . '"><img src="';
        if (!empty($row['dp'])) echo '' . $row['dp'] . '';
        else echo 'images/defaultdp.png';
        echo '" alt=""></a>
       <a href="peopleprofile.php?pi=' . $row["u_id"] . '" style="text-align: center;"><b>' . $row['fname'] . ' ' . $row['lname'] . '</b></a>
       <p style="text-align: center;">Lives in ' . $row['currentaddr'] . '</p>
       <button id="' . $row['u_id'] . '" class="btn btn-primary snt" style="width: 80%;margin-left:1.5rem;margin-bottom:1rem;">Add
           Friend</button>
   </div>';
    }
}

if (isset($_POST["lt"], $_POST["st"])) {
    $connect = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
    $query = "select *from user natural join (select rqfrom as u_id from requests where rqto=" . $_SESSION['u_id'] . ")x limit " . $_POST["st"] . ", " . $_POST["lt"] . "";
    $result = mysqli_query($connect, $query);
    $fl = 0;
    while ($row = mysqli_fetch_array($result)) {
        $fl++;
        echo '<div class="card">
       <a href="peopleprofile.php?pi=' . $row["u_id"] . '"><img src="';
        if (!empty($row['dp'])) echo '' . $row['dp'] . '';
        else echo 'images/defaultdp.png';
        echo '" alt=""></a>
       <a href="peopleprofile.php?pi=' . $row["u_id"] . '" style="text-align: center;"><b>' . $row['fname'] . ' ' . $row['lname'] . '</b></a>
       <p style="text-align: center;">Lives in ' . $row['currentaddr'] . '</p>
       <button id="' . $row['u_id'] . '" class="btn btn-secondary accept" style="width: 80%;margin-left:1.5rem;margin-bottom:1rem;">Confirm Request</button>
   </div>';
    }
}

if (isset($_POST["bhaija"])) {
    $connect = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
    $query = "delete from requests where rqfrom=" . $_POST["bhaija"] . " and rqto=" . $_SESSION['u_id'] . "";
    mysqli_query($connect, $query);
    $a = $_POST["bhaija"];
    $u = $_SESSION['u_id'];

    date_default_timezone_set('Asia/Dhaka');
    $ndate = date('Y-m-d');
    $ntime = date('H:i:s');
    mysqli_query($connect, "insert into notifications(type, sender, senderentity, ndate, ntime, u_id) values('accepted','$u','$u','$ndate','$ntime','$a')");

    $query1 = "insert into user_friends(friendfrom, friendto) values('$a','$u')";
    mysqli_query($connect, $query1);

    $query2 = "insert into user_friends(friendto, friendfrom) values('$a','$u')";
    
    $frndcnt=mysqli_fetch_assoc(mysqli_query($connect, "select friends from user where u_id=".$_SESSION['u_id'].""));
    $frndct=$frndcnt['friends']+1;
    mysqli_query($connect, "update user set friends='$frndct' where u_id=".$_SESSION['u_id']."");

    $frndcnt=mysqli_fetch_assoc(mysqli_query($connect, "select friends from user where u_id='$a'"));
    $frndct=$frndcnt['friends']+1;
    mysqli_query($connect, "update user set friends='$frndct' where u_id='$a'");
    
    mysqli_query($connect, $query2);
}

if (isset($_POST["asho"])) {
    $a = $_POST["asho"];
    $u = $_SESSION['u_id'];
    $connect = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
    $query1 = "insert into requests(rqfrom, rqto) values('$u','$a')";
    mysqli_query($connect, $query1);

    date_default_timezone_set('Asia/Dhaka');
        $ndate = date('Y-m-d');
        $ntime = date('H:i:s');
        mysqli_query($connect, "insert into notifications(type, sender, senderentity, ndate, ntime, u_id) values('sent','$u','$u','$ndate','$ntime','$a')");
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
                    url: "getfriend.php",
                    method: "POST",
                    data: {
                        bhaija: this.id
                    },
                    cache: false,
                    success: function(data) {

                        console.log(data);
                    }
                });
                $(location).prop('href', "friends.php");
            });
            $(".snt").unbind().click(function(e) {
                console.log(this.id);
                $.ajax({
                    url: "getfriend.php",
                    method: "POST",
                    data: {
                        asho: this.id
                    },
                    cache: false,
                    success: function(data) {

                        console.log(data);
                    }
                });
                $(location).prop('href', "friends.php");
            });
        });
    </script>
</body>

</html>