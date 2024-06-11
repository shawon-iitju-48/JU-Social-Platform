<?php
session_start();
$connect = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
$dekho = "select *from user_friends where friendfrom=" . $_SESSION['u_id'] . " and friendto=" . $_SESSION['pi'] . "";
$dekhores = mysqli_query($connect, $dekho);
if (mysqli_fetch_assoc($dekhores)) {
    if (isset($_POST["limitp"], $_POST["startp"])) {
        $gui = "select *from userpost natural join userpost_photos where u_id=" . $_SESSION['pi'] . " order by pid desc LIMIT " . $_POST["startp"] . ", " . $_POST["limitp"] . "";
        $photo1 = mysqli_query($connect, $gui);
        while ($photo2 = mysqli_fetch_array($photo1)) {
            echo  '<div class="photos">
        <div class="left">
            <a href="#"><img src="' . $photo2['location'] . '" alt=""></a>
        </div>
    </div>';
        }
    }

    if (isset($_POST["limitv"], $_POST["startv"])) {
        $vui = "select *from userpost natural join userpost_videos where u_id=" . $_SESSION['pi'] . " order by pid desc LIMIT " . $_POST["startv"] . ", " . $_POST["limitv"] . "";
        $video1 = mysqli_query($connect, $vui);
        while ($video2 = mysqli_fetch_array($video1)) {

            echo ' <div class="photos">
    <div class="left">
        <a href="#"><video style="border-radius: 10px; object-fit: cover;" width="200" height="200" controls>
                <source src="' . $video2['location'] . '" type="video/mp4">
                Your browser does not support the video tag.
            </video></a>
    </div>
</div>';
        }
    }
}
if (isset($_POST["limitf"], $_POST["startf"])) {
    $fr = "select *from user NATURAL join (select friendto as u_id from user_friends where friendfrom=" . $_SESSION['pi'] . ")x where u_id<>" . $_SESSION['pi'] . " LIMIT " . $_POST["startf"] . ", " . $_POST["limitf"] . "";
    $fr0 = mysqli_query($connect, $fr);
    while ($fr4 = mysqli_fetch_array($fr0)) {
        echo '<div class="friend">
        <div class="left">
            <a href="peopleprofile.php?pi='.$fr4["u_id"].'"><img src="';
        if (!empty($fr4['dp'])) echo $fr4['dp'];
        else echo 'images/defaultdp.png';
        echo '" alt=""></a>
        </div>
        <div class="right">
            <a href="peopleprofile.php?pi='.$fr4["u_id"].'">
                <h5>' . $fr4['fname'] . ' ' . $fr4['lname'] . '</h5>
            </a>
            <p>' . $fr4['id_type'] . ' at ' . $fr4['university'] . '</p>
        </div>
    </div>';
    }
}
if (isset($_POST["omago"])) {
    $kh = "%" . $_POST['omago'] . "%";
    $fr = "select *from user NATURAL join (select friendto as u_id from user_friends where friendfrom=" . $_SESSION['pi'] . ")x where u_id<>" . $_SESSION['pi'] . " and (fname like '$kh' or lname like '$kh');";
    $fr0 = mysqli_query($connect, $fr);
    while ($fr4 = mysqli_fetch_array($fr0)) {
        echo '<div class="friend">
        <div class="left">
            <a href="#"><img src="';
        if (!empty($fr4['dp'])) echo $fr4['dp'];
        else echo 'images/defaultdp.png';
        echo '" alt=""></a>
        </div>
        <div class="right">
            <a href="#">
                <h5>' . $fr4['fname'] . ' ' . $fr4['lname'] . '</h5>
            </a>
            <p>' . $fr4['id_type'] . ' at ' . $fr4['university'] . '</p>
        </div>
    </div>';
    }
}

if (isset($_POST["dau"])) {
    $myself = "select *from user where u_id=" . $_SESSION['pi'] . "";
    $myself1 = mysqli_query($connect, $myself);
    while ($myself2 = mysqli_fetch_array($myself1)) {
        echo ' <div class="col-4" style="padding:1rem 1rem; background-color: rgb(255, 255, 255); margin-right: 1rem; border-radius: 10px;">
        <h4><b>About</b></h4>
        <button class="btn btn-light" style="width: 100%;text-align: left;font-size: 1.1rem;margin-bottom: .5rem;" id="work">Work
            and
            Education</button>
        <button class="btn btn-light" style="width: 100%;text-align: left;font-size: 1.1rem;margin-bottom: .5rem;" id="place">Places
            lived</button>
        <button class="btn btn-light" style="width: 100%;text-align: left;font-size: 1.1rem;margin-bottom: .5rem;" id="contact">Contact and
            Basic info</button>
        <button class="btn btn-light" style="width: 100%;text-align: left;font-size: 1.1rem;margin-bottom: .5rem;" id="status">Relationship status</button>
        <button class="btn btn-light" style="width: 100%;text-align: left;font-size: 1.1rem;margin-bottom: .5rem;" id="you">Details about
        ' . $myself2['lname'] . '</button>
    </div>

    <div class="col-7 inna" style="padding:1rem 1rem;background-color: rgb(255, 255, 255);border-radius: 10px;">
        <div class="info">
            <h4>Work</h4>
            <h6><i class="fas fa-school" style="margin-right:1rem;"></i><span>Studies at </span>' . $myself2['university'] . '</h6>
            <h4>University</h4>

            <h6><i class="fas fa-school" style="margin-right:1rem;"></i><span>Studies at
                </span>' . $myself2['university'] . '</h6>';
        if (!empty($myself2['college']))
            echo '
            <h4>College</h4>
            <h6><i class="fas fa-school" style="margin-right:1rem;"></i><span>Studied at </span>' . $myself2['college'] . '</h6>';
        if (!empty($myself2['highschool']))
            echo '
            <h4>High School</h4>
            <h6><i class="fas fa-school" style="margin-right:1rem;"></i><span>Studied at </span>' . $myself2['highschool'] . '</h6>';
        if (!empty($myself2['primaryschool']))
            echo '
            <h4>Primary School</h4>
            <h6><i class="fas fa-school" style="margin-right:1rem;"></i><span>Studied at </span>' . $myself2['primaryschool'] . '</h6>';
        echo '
        </div>
        <div class="places">
            <h4>Places Lived</h4>';
        if (!empty($myself2['currentaddr']))
            echo '
            <h6><i class="fas fa-home" style="margin-right:1rem;margin-top:1.5rem;"></i><span>Current
                    Location- </span>' . $myself2['currentaddr'] . '</h6>';
        if (!empty($myself2['permanentaddr']))
            echo '
            <h6><i class="fa fa-map-marker" style="margin-right:1rem;"></i><span>Hometown- </span>' . $myself2['permanentaddr'] . '
            </h6>';
        echo '
        </div>
        <div class="contact">
            <h4>Contact info</h4>';
        if (!empty($myself2['phone']))
            echo '
            <h6><i class="fas fa-phone" style="margin-right:1rem;margin-top:1.5rem;"></i><span>Phone
                    Number- </span>' . $myself2['phone'] . '</h6>';
        echo '
            <h6><i class="fa fa-envelope" style="margin-right:1rem;"></i><span>Email-
                </span>' . $myself2['email'] . '</h6>
            <h4>Basic info</h4>
            <h6><i class="fas fa-male" style="margin-right:1rem;margin-top:1.5rem;"></i><span>Gender-
                </span>' . $myself2['gender'] . '</h6>
            <h6><i class="fa fa-birthday-cake" style="margin-right:1rem;"></i><span>Date of Birth-
                </span>' . $myself2['dob'] . '</h6>
            <h6><i class="fa fa-medkit" style="margin-right:1rem;"></i><span>Blood Group- </span>' . $myself2['bg'] . '</h6>
        </div>
        <div class="relationship">
            <h4>Relationship</h4>';
        if (!empty($myself2['relationship']))
            echo '
            <h6><i class="fa fa-heart" style="margin-right:1rem;"></i>' . $myself2['relationship'] . '</h6>';
        echo '
        </div>
        <div class="aboutyou">
            <h4>About ' . $myself2['lname'] . '</h4>';
        if (!empty($myself2['about']))
            echo '
            <p>' . nl2br($myself2['about']) . '</p>';
        echo '
        </div>
    </div>
';
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
        $("#work").click(function() {
            $(".info").css("display", "block");
            $(".places").css("display", "none");
            $(".relationship").css("display", "none");
            $(".aboutyou").css("display", "none");
            $(".contact").css("display", "none");
        });
        $("#place").click(function() {
            $(".info").css("display", "none");
            $(".places").css("display", "block");
            $(".relationship").css("display", "none");
            $(".aboutyou").css("display", "none");
            $(".contact").css("display", "none");
        });
        $("#contact").click(function() {
            $(".info").css("display", "none");
            $(".places").css("display", "none");
            $(".relationship").css("display", "none");
            $(".aboutyou").css("display", "none");
            $(".contact").css("display", "block");
        });
        $("#status").click(function() {
            $(".info").css("display", "none");
            $(".places").css("display", "none");
            $(".relationship").css("display", "block");
            $(".aboutyou").css("display", "none");
            $(".contact").css("display", "none");
        });
        $("#you").click(function() {
            $(".info").css("display", "none");
            $(".places").css("display", "none");
            $(".relationship").css("display", "none");
            $(".aboutyou").css("display", "block");
            $(".contact").css("display", "none");
        });
    </script>
</body>

</html>