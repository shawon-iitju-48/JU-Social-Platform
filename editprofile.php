<?php
session_start();
$connect = mysqli_connect("localhost", "ourproje_group6", "LJ83tpPZRM3hrH4", "ourproje_juse");
if (isset($_POST["dau"])) {
    $myself = "select *from user where u_id=" . $_SESSION['u_id'] . "";
    $myself1 = mysqli_query($connect, $myself);
    while ($myself2 = mysqli_fetch_array($myself1)) {
        echo '
            <form autocomplete="off" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="nai">
                        <div class="dp">
                            <div class="left">
                                <h4>Profile Picture</h4>
                            </div>
                            <div class="right">
                                <input id="shawo" name="dpneu" onchange="previewFile(this)" type="file" class="form-control">
                            </div>
                        </div>
                        <div class="chobi"><img id="ekhane" src="';
        if (!empty($myself2['dp'])) echo '' . $myself2['dp'] . '';
        else echo 'images/defaultdp.png';
        echo '" alt=""></div>
                        <div class="dp" style="margin-top:2rem;">
                            <div class="left">
                                <h4>Cover Photo</h4>
                            </div>
                            <div class="right">
                                <input id="shawon" onchange="previewFilec(this)" name="coverneu" type="file" class="form-control">
                            </div>
                        </div>
                        <div class="cover-chobi"><img id="ekhan" src="';
        if (!empty($myself2['cover'])) echo '' . $myself2['cover'] . '';
        else echo 'images/default-cover.png';
        echo '"alt=""></div>
                        <div class="dp" style="margin-top:2rem;">
                            <div class="left">
                                <h4>Bio</h4>
                            </div>
                            <div class="right">

                                <h5 id="bioedit">Edit</h5>

                                <h5 id="bioeditcancel">Cancel</h5>

                            </div>
                        </div>';
        if (!empty($myself2['bio']))
            echo '
                        <p style="text-align: center;" class="1">' . $myself2['bio'] . '</p>';
        echo '
                        <textarea class="biolekho" name="bioneu" id="" cols="40" rows="10">';
        if (!empty($myself2['bio'])) echo '' . $myself2['bio'] . '';
        echo '</textarea>

                        <div class="dp" style="margin-top:2rem;">
                            <div class="left">
                                <h4>Customize Your Intro</h4>
                            </div>
                            <div class="right">

                                <h5 id="introedit">Edit</h5>

                                <h5 id="introeditcancel">Cancel</h5>

                            </div>
                        </div>
                        <div class="myintro">
                            <h6><i class="fas fa-school" style="margin-right:1rem;"></i><span>Studies at
                                </span>' . $myself2['university'] . '</h6>';
        if (!empty($myself2['college']))
            echo '
                            <h6><i class="fas fa-graduation-cap" style="margin-right:1rem;"></i><span>Studied at
                                </span>' . $myself2['college'] . '</h6>';
        if (!empty($myself2['currentaddr']))
            echo '
                            <h6><i class="fas fa-home" style="margin-right:1rem;"></i><span>Lives in
                                </span>' . $myself2['currentaddr'] . '</h6>';
        if (!empty($myself2['permanentaddr']))
            echo '
                            <h6><i class="fa fa-map-marker" style="margin-right:1rem;"></i><span>From
                                </span>' . $myself2['permanentaddr'] . '</h6>';
        if (!empty($myself2['relationship']))
            echo '
                            <h6><i class="fa fa-heart" style="margin-right:1rem;"></i>' . $myself2['relationship'] . '</h6>';
        echo '
                        </div>
                    </div>


                    <div class="editintro">
                        <h6><i class="fas fa-school" style="margin-right:1rem;"></i><span>Studies at
                            </span><input name="universityneu" type="text" placeholder="' . $myself2['university'] . '"></h6>
                        <h6><i class="fas fa-graduation-cap" style="margin-right:1rem;"></i><span>Studied at
                            </span><input name="collegeneu" type="text" placeholder="' . $myself2['college'] . '"></h6>
                        <h6><i class="fas fa-home" style="margin-right:1rem;"></i><span>Lives in
                            </span><input name="currentaddrneu" type="text" placeholder="' . $myself2['currentaddr'] . '"></h6>
                        <h6><i class="fa fa-map-marker" style="margin-right:1rem;"></i><span>From
                            </span><input name="permanentaddrneu" type="text" placeholder="' . $myself2['permanentaddr'] . '"></h6>
                        <h6><i class="fa fa-heart" style="margin-right:1rem;"></i><span>Relationship
                                Status
                            </span><input name="relationshipneu" type="text" placeholder="' . $myself2['relationship'] . '"></h6>
                    </div>
                    <div class="bai">
                        <div class="dp" style="margin-top:2rem;">
                            <div class="left">
                                <h4>Customize Your About Info</h4>
                            </div>
                            <div class="right">

                                <h5 id="aboutedit">Edit</h5>

                                <h5 id="abouteditcancel">Cancel</h5>

                            </div>
                        </div>

                        <div class="editabout">
                            <h6><i class="fas fa-school" style="margin-right:1rem;"></i><span>High School

                                </span><input name="highschoolneu" type="text" placeholder="' . $myself2['highschool'] . '">
                            </h6>
                            <h6><i class="fas fa-graduation-cap" style="margin-right:1rem;"></i><span>Primary School
                                </span><input name="primaryschoolneu" type="text" placeholder="' . $myself2['primaryschool'] . '">
                            </h6>
                            <h6><i class="fas fa-phone" style="margin-right:1rem;"></i><span>Phone
                                    Number </span><input name="phoneneu" type="text" placeholder="' . $myself2['phone'] . '"></h6>
                            <h6><i class="fa fa-envelope" style="margin-right:1rem;"></i><span>Email
                                </span><input name="emailneu" type="text" placeholder="' . $myself2['email'] . '"></h6>
                            <h6><i class="fas fa-male" style="margin-right:1rem;"></i><span>Gender
                                </span><input name="genderneu" type="text" placeholder="' . $myself2['gender'] . '"></h6>
                            <h6><i class="fa fa-birthday-cake" style="margin-right:1rem;"></i><span>Date
                                    of Birth
                                </span><input name="dobneu" type="date"></h6>
                            <h6><i class="fa fa-medkit" style="margin-right:1rem;"></i><span>Blood
                                    Group </span><input name="bgneu" type="text" placeholder="' . $myself2['bg'] . '"></h6>
                            <h5>About you</h5>
                            <textarea name="aboutneu" id="" cols="100%" rows="10">' . $myself2['about'] . '</textarea>
                        </div>
                        <div class="myabout">
                            <h6><i class="fas fa-school" style="margin-right:1rem;"></i><span>High School
                                    -
                                </span>' . $myself2['highschool'] . '</h6>';
        if (!empty($myself2['primaryschool']))
            echo '
                            <h6><i class="fas fa-graduation-cap" style="margin-right:1rem;"></i><span>Primary School -
                                </span>' . $myself2['primaryschool'] . '</h6>';
        if (!empty($myself2['phone']))
            echo '
                            <h6><i class="fas fa-phone" style="margin-right:1rem;"></i><span>Phone
                                    Number- </span>' . $myself2['phone'] . '</h6>';
        echo '   
                            <h6><i class="fa fa-envelope" style="margin-right:1rem;"></i><span>Email-
                                </span>' . $myself2['email'] . '</h6>
                            <h6><i class="fas fa-male" style="margin-right:1rem;"></i><span>Gender-
                                </span>' . $myself2['gender'] . '</h6>
                            <h6><i class="fa fa-birthday-cake" style="margin-right:1rem;"></i><span>Date
                                    of Birth-
                                </span>' . $myself2['dob'] . '</h6>
                            <h6><i class="fa fa-medkit" style="margin-right:1rem;"></i><span>Blood
                                    Group- </span>' . $myself2['bg'] . '</h6>
                            <h5>About you</h5>
                            <p>';
        if (!empty($myself2['about'])) echo '' . nl2br($myself2['about']) . '';
        echo '</p>
                        </div>
                    </div>



                </div>
                <div class="modal-footer">
                    <input name="diyedau" type="submit" value="Save Changes" class="btn btn-primary" style="width:100%">
                </div>
            </form>';
    }
}
if (isset($_POST["bau"])) {
    $myself = "select *from user where u_id=" . $_SESSION['u_id'] . "";
    $myself1 = mysqli_query($connect, $myself);
    while ($myself2 = mysqli_fetch_array($myself1)) {
        echo '
            <form autocomplete="off" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                    <div class="editintro" style="display:block">
                        <h6><i class="fas fa-school" style="margin-right:1rem;"></i><span>Studies at
                            </span><input name="universityneu" type="text" placeholder="' . $myself2['university'] . '"></h6>
                        <h6><i class="fas fa-graduation-cap" style="margin-right:1rem;"></i><span>Studied at
                            </span><input name="collegeneu" type="text" placeholder="' . $myself2['college'] . '"></h6>
                        <h6><i class="fas fa-home" style="margin-right:1rem;"></i><span>Lives in
                            </span><input name="currentaddrneu" type="text" placeholder="' . $myself2['currentaddr'] . '"></h6>
                        <h6><i class="fa fa-map-marker" style="margin-right:1rem;"></i><span>From
                            </span><input name="permanentaddrneu" type="text" placeholder="' . $myself2['permanentaddr'] . '"></h6>
                        <h6><i class="fa fa-heart" style="margin-right:1rem;"></i><span>Relationship
                                Status
                            </span><input name="relationshipneu" type="text" placeholder="' . $myself2['relationship'] . '"></h6>
                    </div>
                    </div>
                <div class="modal-footer">
                    <input name="diyedau" type="submit" value="Save Changes" class="btn btn-primary" style="width:100%">
                </div>
            </form>';
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
        function previewFile(input) {
            var file = $("#shawo").get(0).files[0];

            if (file) {
                var reader = new FileReader();

                reader.onload = function() {
                    $("#ekhane").attr("src", reader.result);
                }

                reader.readAsDataURL(file);
            }
        }
        function previewFilec(input){
        var files = $("#shawon").get(0).files[0];
 
        if(files){
            var readers = new FileReader();
 
            readers.onload = function(){
                $("#ekhan").attr("src", readers.result);
            }
 
            readers.readAsDataURL(files);
        }
    }
        $("#bioedit").click(function() {
            $(".biolekho").css("display", "block");
            $(".1").css("display", "none");
            $("#bioeditcancel").css("display", "block");
            $("#bioedit").css("display", "none");
        });
        $("#bioeditcancel").click(function() {
            $("#bioedit").css("display", "block");
            $("#bioeditcancel").css("display", "none");
            $(".biolekho").css("display", "none");
            $(".1").css("display", "block");
        });
        $("#introedit").click(function() {
            $("#introedit").css("display", "none");
            $("#introeditcancel").css("display", "block");
            $(".myintro").css("display", "none");
            $(".editintro").css("display", "block");
        });
        $("#introeditcancel").click(function() {
            $("#introedit").css("display", "block");
            $("#introeditcancel").css("display", "none");
            $(".myintro").css("display", "block");
            $(".editintro").css("display", "none");
        });
        $("#aboutedit").click(function() {
            $("#aboutedit").css("display", "none");
            $("#abouteditcancel").css("display", "block");
            $(".myabout").css("display", "none");
            $(".editabout").css("display", "block");
        });
        $("#abouteditcancel").click(function() {
            $("#aboutedit").css("display", "block");
            $("#abouteditcancel").css("display", "none");
            $(".myabout").css("display", "block");
            $(".editabout").css("display", "none");
        });
    </script>
</body>

</html>