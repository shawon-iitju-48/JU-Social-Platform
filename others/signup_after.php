<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $con = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_e_learning");
    if (isset($_GET['token'])) {
        $token = $_GET['token'];

        $sql = "select token from user where token='$token'";
        $res = mysqli_query($con, $sql);
        if (mysqli_num_rows($res) >= 1) {
            $ss = "Successfull";
            $body = "We'll send you another confirmation email
    after further verificaton of your provided information. Thank you!";
            $sql = "update user set ustat='active' where token='$token'";
            mysqli_query($con, $sql);
        } else {
            $ss = "Unsuccessfull";
            $body = "Please provide valid link or token information to begin using JU e-Learning Platform. Thank you!";
        }
    }
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification</title>
    <link rel="icon" href="./dbfiles/icob.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
</head>

<body style="background:var(--light)">
    <div class="container" style="width:65rem;">
        <div class="activate" style="padding:5rem 0rem;display: <?php if (isset($_GET['email'])) echo "block";
                                                                else echo "none"; ?>">
            <h1 calss="text-gray" style="text-align:center;font-size:65px;">Activation Email Sent!</h1>
            <h3 style="text-align:center;padding:2rem 5rem;">We've sent an email to <?php echo $_GET['email']; ?>.
                Click the confirmation link in that email to begin using JU e-Learning Platform.</h3>
            <div class="signup">
                <a href="https://mail.google.com/mail/" target="_blank"><button class="btn btn-secondary">Open Gmail</button></a>
                <a href="https://outlook.live.com/mail/" target="_blank"><button class="btn btn-secondary">Open Outlook</button></a>
            </div>
        </div>
        <div class="after-activate" style="padding:8rem 0rem;display: <?php if (isset($token)) echo "block";
                                                                        else echo "none"; ?>">

            <h1 calss="text-gray" style="text-align:center;font-size:65px;">Email Verification <?php if (isset($ss)) echo $ss;
                                                                                                ?>!</h1>
            <h3 style="text-align:center;padding:2rem 5rem;"><?php if (isset($body)) echo $body;
                                                                ?></h3>
        </div>
    </div>
</body>

</html>