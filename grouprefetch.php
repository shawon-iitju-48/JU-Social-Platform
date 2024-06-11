<?php
session_start();
$connect = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
$query = "select count(rqfrom) as goa from grouprequests where rqto=" . $_SESSION['gid'] . "";
$result = mysqli_query($connect, $query);
if ($row = mysqli_fetch_array($result)) {
    if ($row['goa'] != 0)
        echo '<span id="kotorq" style="right:10px;" class="rounded-circlee">' . $row['goa'] . '</span>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>

    </title>
    <link rel="icon" href="images/icob.svg">

</head>

<body>
    <script>
    </script>
</body>

</html>