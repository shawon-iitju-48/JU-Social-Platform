<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $con = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
    $sql = "select *from notices where notice_id='{$_GET['notice_id']}'";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($res);
    $noticeid = $row['notice_id'];
    $headline = $row['headline'];
    $date = $row['date'];
    $noticefile = $row['noticefile'];
    $description = nl2br($row['description']);
    ?>
    <script>
        window.onload = function() {
            var p = "<?php echo $noticefile ?>";
            if (p.length != 0)
                document.querySelector(".pdf").setAttribute("style", "display:block");
        };
    </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notices</title>
    <link rel="icon" href="./dbfiles/icob.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <!-- <link rel="stylesheet" href="../css/ret.css"> -->
    <link rel="stylesheet" href="css/update.css">
    <link rel="stylesheet" href="css/notice.css">
    <link rel="stylesheet" href="css/header.css">

</head>

<body>
     
    <div class="bodyy">
        <div class="containerr xddd">
            <div class="title" style="margin-bottom:1.5rem;">
                Notice
            </div>
            <div class="header">
                <h1><?php if (isset($headline)) echo $headline; ?></h1>
                <span><?php if (isset($date)) echo $date; ?></span>
            </div>

            <div class="notice">
                <p><?php if (isset($description)) echo $description; ?></p>
            </div>
            <div class="pdf">
                <embed type="application/pdf" src="<?php if (isset($noticefile)) echo "admin/".$noticefile; ?>" width="800px" height="620px">
            </div>
            <!-- <section id="blog" class="blog">
                <div class="container" style="margin-top:2rem;">
                    <div class="card-wrapper">
                        <div class="card tilt">
                            <div class="card-content">
                                <a href="details.php?notice_id=<?php if (isset($noticeid[$i])) echo $noticeid[$i]; ?>">
                                    <h1><?php if (isset($headline)) echo $headline; ?></h1>
                                </a>
                                <span><?php if (isset($date)) echo $date; ?></span>
                                <p><?php if (isset($description)) echo $description; ?></p>
                            </div>
                            <a class="read-more" href="#">Read More...</a>
                        </div>
                    </div>
                </div>
            </section> -->
        </div>
    </div>
</body>

</html>