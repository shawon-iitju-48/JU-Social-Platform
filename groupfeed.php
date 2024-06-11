<?php
session_start();
$con = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
include("php_util/isLogin.php");
$dow = check_login($con);
$name = $dow['fname'] . ' ' . $dow['lname'];
$dp = $dow['dp'];

?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Groups | JUSE</title>

    <link rel="stylesheet" href="css/searchSocial.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/groupfeed.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="images/icob.svg">

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {

            window.addEventListener('scroll', function() {

                if (window.scrollY >= 0) {
                    document.getElementById('navbar_top').classList.add('fixed-top');
                    // add padding top to show content behind navbar
                    navbar_height = document.querySelector('.navbar').offsetHeight;
                    document.body.style.paddingTop = navbar_height + 'px';
                } else {
                    document.getElementById('navbar_top').classList.remove('fixed-top');
                    // remove padding top from body
                    document.body.style.paddingTop = '0';
                }
            });
        });
        // DOMContentLoaded  end
    </script>

</head>

<body>

<nav id="navbar_top" class="navbar navbar-expand-lg navbar-dark bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand text-dark" href="home.php"><img style="transform: scale(2.5);height:20px;width:20px;object-fit:fill;border-radius: 50%;" src="images/logo.png" alt="JUSE"></a>
            <div class="navxx">
                <form action="searchinsocial.php" method="post">
                    <input name="skey" type="text" required placeholder="Search"></input>
                    <input name="searchkoro" type="submit" hidden>
                </form>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="main_nav">


                <ul class="navbar-nav ms-auto">
                    <li id="home250" class="nav-item f bc"><a class="nav-link text-dark" href="home.php"> <i class="fas fa-home text-dark fa-lg"></i> </a> </li>
                    <li id="friend250" class="nav-item f bg-d bc"><a class="nav-link text-dark" href="friends.php"> <i class="fas fa-user-friends text-dark fa-lg"></i> </a> <span id="kotorq1"></span></li>
                    <li id="group250" class="nav-item f bg-d bc"><a class="nav-link text-dark hover-underline-animation" href="#"><i class="fas fa-users text-dark fa-lg"></i> </a> </li>
                    <li id="classroom250" class="nav-item f bg-d bc"><a class="nav-link text-dark" href="#"><i class="fas fa-chalkboard-teacher text-dark fa-lg"></i> </a> </li>
                    <li id="messenger250" class="nav-item f bg-d bc"><a class="nav-link text-dark" href="#"> <i class="fab fa-facebook-messenger text-dark fa-lg"></i> </a><span id="kotomessage"></span></li>
                    <li id="notification250" class="nav-item f bg-d bc"><a class="nav-link text-dark" href="#"> <i class="fas fa-bell text-dark fa-lg"></i> </a><span id="kotonoti"></span></li>
                    <li id="user250" class="nav-item foru bg-d"><a class="nav-link text-dark" href="profile.php">
                            <div class="left">
                                <img src="<?php if (!empty($dp)) echo $dp;
                                            else echo "images/defaultdp.png"; ?>" alt="">
                                <small style="margin-left: .5rem; font-weight:500; width:80px;white-space: nowrap;overflow: hidden !important;text-overflow: ellipsis;"> <?php echo $name ?></small>
                            </div>
                        </a> </li>
                    <li id="logout250" class="nav-item f bg-d bc"><a class="nav-link text-dark" href="#"> <i class="fas fa-sign-out-alt text-dark fa-lg"></i> </a> </li>
                </ul>

            </div> <!-- navbar-collapse.// -->
        </div> <!-- container-fluid.// -->
    </nav>

    <div class="data">
        <div class="side">
            <h4 style="margin-bottom:1rem;margin-left:.5rem;font-weight: 700;">Groups</h4>
            <form action="" name="Form" autocomplete="off">
                <i style="margin-left:.5rem;" class="fa fa-search" aria-hidden="true"></i><input id="khojkoro" name="answer-a" type="text" placeholder="Search groups">
            </form>
            <button id="manage" class="active"><i style="margin-left:.5rem;margin-right:.5rem" class="fa-solid fa-users"></i>Groups you manage</button>
            <button id="joined"><i style="margin-left:.5rem;margin-right:.5rem" class="fa-solid fa-users"></i>Groups
                you've joined</button>
            <button id="discover"><i style="margin-left:.5rem;margin-right:.5rem" class="fa-solid fa-radar"></i>Discover
                groups</button>
            <button id="cholejau" class="onno"><i style="margin-left:.5rem;margin-right:.5rem" class="fa fa-plus"></i>Create group</button>
        </div>
        <div class="search">
            <div class="row-1 rokeya">
                <h4>Search results</h4><br>
                <div class="inner" id="sc">
                </div>
            </div>
            <div class="row-1 manage">
                <h4>Groups you manage</h4><br>
                <div class="inner" id="jaumanage">
                </div>
            </div>
            <div class="row-1 joined">
                <h4>Groups you've joined</h4><br>
                <div class="inner" id="jaujoined">
                </div>
            </div>
            <div class="row-1 discover">
                <h4>Suggested groups</h4><br>
                <div class="inner" id="suggest">
                </div>
            </div>
        </div>

    </div>
    <script src="js/nav.js"></script>
    <script src="js/navfetch.js"></script>
    <script>
        $(document).ready(function() {
            $("#khojkoro").keyup(function() {
                console.log(khojkoro.value);
                $('#sc').html("");
                $.ajax({
                    url: "feedadditional.php",
                    method: "POST",
                    data: {
                        omago: khojkoro.value
                    },
                    cache: false,
                    success: function (data) {
                        $('#sc').append(data);
                    }
                });
            });

            function update() {
                if (document.forms['Form'].khojkoro.value === "") {
                    $(".rokeya").css("display", "none");
                } else $(".rokeya").css("display", "block");
                window.setTimeout(update, 100);
                console.log("ashlam");
            }
            update();

            $("#manage").click(function() {
                $("#manage").addClass("active");
                $("#discover").removeClass("active");
                $("#joined").removeClass("active");
                $(".manage").css("display", "block");
                $(".discover").css("display", "none");
                $(".joined").css("display", "none");
            });
            $("#joined").click(function() {
                $("#jaujoined").html("");
                $("#joined").addClass("active");
                $("#discover").removeClass("active");
                $("#manage").removeClass("active");
                $(".joined").css("display", "block");
                $(".discover").css("display", "none");
                $(".manage").css("display", "none");

                var limitj = 4;
                var startj = 0;
                var actionj = 'inactive';

                function load_country_dataj(limitj, startj) {
                    $.ajax({
                        url: "feedadditional.php",
                        method: "POST",
                        data: {
                            limitj: limitj,
                            startj: startj
                        },
                        cache: false,
                        success: function(data) {
                            $('#jaujoined').append(data);
                            if (data == '') {
                                actionj = 'active';
                            } else {
                                actionj = "inactive";
                            }
                        }
                    });
                }

                if (actionj == 'inactive') {
                    actionj = 'active';
                    load_country_dataj(limitj, startj);
                }
                $(window).scroll(function() {
                    if ($(window).scrollTop() + $(window).height() > $("#jaujoined").height() && actionj == 'inactive') {
                        actionj = 'active';
                        console.log("wj");
                        startj = startj + limitj;
                        setTimeout(function() {
                            load_country_dataj(limitj, startj);
                        }, 1);
                    }
                });
                $(".search").scroll(function() {
                    if ($(".search").scrollTop() + $(".search").height() > $("#jaujoined").height() && actionj == 'inactive') {
                        actionj = 'active';
                        console.log("jj");
                        startj = startj + limitj;
                        setTimeout(function() {
                            load_country_dataj(limitj, startj);
                        }, 1);
                    }
                });

            });

            $("#discover").click(function() {
                $("#suggest").html("");
                $("#discover").addClass("active");
                $("#manage").removeClass("active");
                $("#joined").removeClass("active");
                $(".discover").css("display", "block");
                $(".manage").css("display", "none");
                $(".joined").css("display", "none");

                var limitd = 4;
                var startd = 0;
                var actiond = 'inactive';

                function load_country_datad(limitd, startd) {
                    $.ajax({
                        url: "feedadditional.php",
                        method: "POST",
                        data: {
                            limitd: limitd,
                            startd: startd
                        },
                        cache: false,
                        success: function(data) {
                            $('#suggest').append(data);
                            if (data == '') {
                                actiond = 'active';
                            } else {
                                actiond = "inactive";
                            }
                        }
                    });
                }

                if (actiond == 'inactive') {
                    actiond = 'active';
                    load_country_datad(limitd, startd);
                }
                $(window).scroll(function() {
                    if ($(window).scrollTop() + $(window).height() > $("#suggest").height() && actiond == 'inactive') {
                        actiond = 'active';
                        console.log("wd");
                        startd = startd + limitd;
                        setTimeout(function() {
                            load_country_datad(limitd, startd);
                        }, 1);
                    }
                });
                $(".search").scroll(function() {
                    if ($(".search").scrollTop() + $(".search").height() > $("#suggest").height() && actiond == 'inactive') {
                        actiond = 'active';
                        console.log("jd");
                        startd = startd + limitd;
                        setTimeout(function() {
                            load_country_datad(limitd, startd);
                        }, 1);
                    }
                });
            });
            $("#cholejau").click(function() {
                $(location).prop('href', "create-group.php")
            });



            var limit = 4;
            var start = 0;
            var action = 'inactive';

            function load_country_data(limit, start) {
                $.ajax({
                    url: "feedadditional.php",
                    method: "POST",
                    data: {
                        limit: limit,
                        start: start
                    },
                    cache: false,
                    success: function(data) {
                        $('#jaumanage').append(data);
                        if (data == '') {
                            action = 'active';
                        } else {
                            action = "inactive";
                        }
                    }
                });
            }

            if (action == 'inactive') {
                action = 'active';
                load_country_data(limit, start);
            }
            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() > $("#jaumanage").height() && action == 'inactive') {
                    action = 'active';
                    console.log("w");
                    start = start + limit;
                    setTimeout(function() {
                        load_country_data(limit, start);
                    }, 1);
                }
            });
            $(".search").scroll(function() {
                if ($(".search").scrollTop() + $(".search").height() > $("#jaumanage").height() && action == 'inactive') {
                    action = 'active';
                    console.log("j");
                    start = start + limit;
                    setTimeout(function() {
                        load_country_data(limit, start);
                    }, 1);
                }
            });

        });
    </script>
</body>

</html>