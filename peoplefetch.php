<?php
session_start();
$connect = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
$uid = $_SESSION['pi'];
$dekho = "select *from user_friends where friendfrom=" . $_SESSION['u_id'] . " and friendto='$uid'";
$dekhores = mysqli_query($connect, $dekho);
if (mysqli_fetch_assoc($dekhores)) {
    if (isset($_POST["limit"], $_POST["start"])) {
        $query="select *from userpost_photos right join  (select pid as pod , ptime, pdate,pdetails,likecount,commentcnt, u_id from userpost order by pid desc limit " . $_POST["start"] . ", " . $_POST["limit"] . ") x  on x.pod=userpost_photos.pid NATURAL join user where u_id='$uid' limit 1";
        $queryv = "select *from userpost_videos right join  (select pid as pod , ptime, pdate,pdetails,likecount,commentcnt, u_id from userpost order by pid desc limit " . $_POST["start"] . ", " . $_POST["limit"] . ") x  on x.pod=userpost_videos.pid NATURAL join user where u_id='$uid' limit 1";

        $query1 = "select count(photosid) as koto from (select *from userpost order by pid desc limit " . $_POST["start"] . ", " . $_POST["limit"] . ")x left join  userpost_photos on x.pid=userpost_photos.pid where u_id='$uid' group by x.pid ";
        $query2 = "select count(videosid) as koto from (select *from userpost order by pid desc limit " . $_POST["start"] . ", " . $_POST["limit"] . ")x left join  userpost_videos on x.pid=userpost_videos.pid where u_id='$uid' group by x.pid ";
        $result = mysqli_query($connect, $query);
        $resultv = mysqli_query($connect, $queryv);
        $bow = mysqli_fetch_array($resultv);

        $kotor = mysqli_query($connect, $query1);
        $xd = mysqli_fetch_array($kotor);

        $kotorv = mysqli_query($connect, $query2);
        $xdv = mysqli_fetch_array($kotorv);


        $querydorkar = "select *from userpost order by pid desc limit " . $_POST["start"] . ", " . $_POST["limit"] . "";
        $dorkar = mysqli_query($connect, $querydorkar);
        $kire = mysqli_fetch_array($dorkar);
        if ($kire) {
            $like1 = "select *from userpost_likes where u_id=" . $_SESSION['u_id'] . " and pid=" . $kire['pid'] . "";
            $like2 = mysqli_query($connect, $like1);
            $like3 = mysqli_fetch_array($like2);
        }


        while ($row = mysqli_fetch_array($result)) {
            if ($row["gender"] == 'Male')
                $gender = 'his';
            else $gender = 'her';

            if (empty($row['pod']))
                $dana = $bow['pod'];
            else $dana = $row['pod'];
            echo '
        <div id="ba" class="row" style="margin-bottom:2rem;">
        <div class="posthead">
        <div class="left">
            <a href="peopleprofile.php?pi='.$row["u_id"].'"><img src="' . $row["dp"] . '" alt=""></a>

        </div>
        <div class="right">
            <a href="peopleprofile.php?pi='.$row["u_id"].'"><b>' . $row["fname"] . ' ' . $row["lname"] . '</b></a> ';
            if (($row["dp"] == $row["location"])) echo ' updated ' . $gender . ' profile picture.';
            else  if (($row["cover"] === $row["location"]))
                echo ' updated ' . $gender . ' cover photo.';
            echo ' <p style="font-size: .8rem;">' . $row["pdate"] . ' at ' . $row["ptime"] . '</p>
        </div>
    </div>
    <p>' . $row["pdetails"] . '</p>
    <div class="divide">';

            if (!empty($row["location"]))
                echo '
    <a href="post_view.php?pidd=' . $row['pod'] . '"><img id="' . $row['pod'] . $row['pod'] . '" src="' . $row["location"] . '" class="postphoto" alt=""></a>';

            if (!empty($bow["location"]))
                echo '<video id="' . $bow['pod'] . $bow['pod'] . '" src="' . $bow["location"] . '" width="100%" height="320" controls></video>';

            if ($xd || $xdv) {
                if ($xd["koto"] > 1 || $xdv["koto"] > 1)
                    echo '
        <div id="' . $dana . '" class="icoin boldami">
            <i class="fas fa-arrow-right" style="width: 30px;height:30px;font-size:1.5rem;color:rgb(138, 123, 123);background:#f7f7f7;border-radius: 50%;padding:5px 5px;"></i>
        </div>';
            }
            echo '
    </div>
    <div class="like" style="margin-bottom:-.8rem;">
        <div class="left">
            <h6><i style="margin-right:0.5rem;font-weight: 400;color:#2078F4" class="fa-duotone fa-thumbs-up"></i><span id="' . $kire['pid'] . '-' . '">' . $row["likecount"] . '</span>
            </h6>
        </div>
        <div class="right">
            <p><b><span id="' . $kire['pid'] . '-----' . '">' . $row["commentcnt"] . '</span> Comments</b></p>
        </div>
    </div>
    <hr>
    <div style="align-items:center;justify-content:center;display:flex;">
    <button id="' . $kire['pid'] . '_' . '" class="btn ButtonJolo kirebhai" style="width:45%;border-radius:5px;margin-top:-1rem;">';
            if (!$like3) echo '<i style="margin-right:0.5rem;font-weight: 400;" class="fa-thin fa-thumbs-up"></i>Like';
            else echo '<i style="margin-right:0.5rem;color:#2078F4" class="fa-solid fa-thumbs-up"></i>Liked';
            echo '</button>
    <button id="' . $kire['pid'] . '__' . '" class="btn ButtonJolo normi" style="width:45%;border-radius:5px;margin-top:-1rem;"><i style="margin-right:0.5rem;" class="fa-regular fa-message"></i>Comment</button></div>
    <hr>
    <div class="flexx" style="margin-bottom:1rem">
        <a href=""> <img src="' . $_SESSION['dp'] . '" alt=""></a>
        <form autocomplete="off" method="post" id="' . $kire['pid'] . '--' . '">
            <input name="bindas" class="btn btn-light" style="width:28rem;margin-left:1rem;border-radius:40px;text-align: left;cursor:text" placeholder="Write a comment..." id="' . $kire['pid'] . '___' . '" ></input>
            <input name="done" type="submit" hidden></input>
        </form>
    </div>
    <div id="' . $kire['pid'] . '____' . '">
    </div>
    
  ';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <script>
        $(document).ready(function() {

            $('form').unbind().on('submit', function() {
                var fid = this.id;
                var dog = fid.split("--")[0];
                var postdata = $("#" + fid).serialize() + "&pid=" + dog;
                $.post("comment.php", postdata, function(data) {
                    console.log(data);
                });

                $.ajax({
                    url: "comment.php",
                    method: "POST",
                    data: {
                        droid: dog
                    },
                    cache: false,
                    success: function(data) {
                        if (data != "") {
                            $('#' + dog + '____').html("");
                            $('#' + dog + '____').append(data);
                        }
                    }
                });

                $.ajax({
                    url: "comment.php",
                    method: "POST",
                    data: {
                        bhai: dog
                    },
                    cache: false,
                    success: function(data) {
                        $('#' + dog + "-----").html(data);
                    }
                });

                $("form").trigger('reset');
                return false;
            });

            $(".normi").unbind().click(function(e) {
                var normiid = this.id.split("__")[0];
                $.ajax({
                    url: "comment.php",
                    method: "POST",
                    data: {
                        droid: normiid
                    },
                    cache: false,
                    success: function(data) {
                        if (data != "") {
                            $('#' + normiid + '____').html("");
                            $('#' + normiid + '____').append(data);
                        }
                        //    console.log(data);
                    }
                });
                $(location).prop('href', "#" + this.id + '_');
            });

            $(".kirebhai").unbind().click(function() {
                var finalid = this.id.split("_")[0];
                var iid = this.id;
                var ss = finalid + "-";
                $.ajax({
                    url: "dolike.php",
                    method: "POST",
                    data: {
                        pid: finalid
                    },
                    cache: false,
                    success: function(data) {
                        console.log(data);
                        if (data == 'successfull')
                            $("#" + iid).html("<i style='margin-right:0.5rem;color:#2078F4' class='fa-solid fa-thumbs-up'></i>" + 'Liked');
                        else if (data == 'deleted') $("#" + iid).html("<i style='margin-right:0.5rem;font-weight: 400;' class='fa-thin fa-thumbs-up'></i>" + 'Like');
                    }
                });
                $.ajax({
                    url: "dolike.php",
                    method: "POST",
                    data: {
                        poid: finalid
                    },
                    cache: false,
                    success: function(data) {
                        $('#' + ss).html(data);
                    }
                });

            });

            var li = 1;
            var st = 0;
            var actionn = 'inac';
            var janao = "no";

            function load_post_data(li, st, tar) {
                $.ajax({
                    url: "postfetch.php",
                    method: "POST",
                    data: {
                        limit: li,
                        start: st,
                        pid: tar
                    },
                    cache: false,
                    success: function(data) {
                        console.log(st);
                        let img = document.getElementById(tar + tar);
                        if (data != '') {
                            janao = "no";
                            img.src = data;
                        } else
                            janao = "yes";
                    }
                });
            }
            $(".boldami").click(function(e) {
                if (actionn == 'inac') {
                    action = 'act';
                    st = st + li;
                    if (janao == "yes")
                        st = 0;
                    load_post_data(li, st, this.id);
                }
            });

        });
    </script>
</body>

</html>