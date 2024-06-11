<?php
session_start();
if (isset($_POST["limit"], $_POST["start"], $_POST["pid"])) {
    $connect = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
    $query = "SELECT * FROM userpost_photos where pid=" . $_POST["pid"] . "  LIMIT " . $_POST["start"] . ", " . $_POST["limit"] . "";
    $result = mysqli_query($connect, $query);
    while ($row = mysqli_fetch_array($result)) {
        echo $row['location'];
    }

    $query = "SELECT * FROM userpost_videos where pid=" . $_POST["pid"] . "  LIMIT " . $_POST["start"] . ", " . $_POST["limit"] . "";
    $result = mysqli_query($connect, $query);
    while ($row = mysqli_fetch_array($result)) {
        echo $row['location'];
    }
}
