<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $con = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
    $sql = "select *from notices";
    $res = mysqli_query($con, $sql);
    $n = 0;
    $v = 0;
    while ($row = mysqli_fetch_assoc($res)) {
        $noticeid[$n] = $row['notice_id'];
        $headline[$n] = $row['headline'];
        $date[$n] = $row['date'];
        $noticefile[$n] = $row['noticefile'];
        $description[$n] = nl2br($row['description']);
        $n++;
    }
    ?>
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
        <div class="containerr">
            <div class="title" style="margin-bottom:1.5rem;">
                Notices
            </div>
            <section id="blog" class="blog">
                <div class="container" style="margin-top:2rem;">
                    <div class="card-wrapper">
                        <?php for ($i = 0; $i < $n; $i++) { ?>
                            <div class="card tilt">
                                <div class="img-wrapper">
                                    <img src="./dbfiles/notice.jpg" alt="">
                                </div>
                                <div class="card-content">
                                    <a href="Noticedetails.php?notice_id=<?php if (isset($noticeid[$i])) echo $noticeid[$i]; ?>">
                                        <h1><?php if (isset($headline[$i])) echo $headline[$i]; ?></h1>
                                    </a>
                                    <span><?php if (isset($date[$i])) echo $date[$i]; ?></span>
                                    <p><?php if (isset($description[$i])) echo $description[$i]; ?></p>
                                </div>
                                <a class="read-more" href="Noticedetails.php?notice_id=<?php if (isset($noticeid[$i])) echo $noticeid[$i]; ?>">Read More...</a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.7.0/vanilla-tilt.min.js"></script>
    <script>
        VanillaTilt.init(document.querySelectorAll('.tilt'), {
            max: 10
        });
    </script>

</body>

</html>