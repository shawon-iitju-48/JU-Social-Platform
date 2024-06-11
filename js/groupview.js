$(document).ready(function () {
    $("#edit-post-btn").click(function () {
        $(".edit-post-form").css("display", "none");
        $(".gayeb").css("display", "block");
    });
    $("#edit-koro").click(function () {
        $(".edit-post-form").css("display", "block");
        $(".gayeb").css("display", "none");
    });
    $(".view-more").click(function (e) {
        $("." + e.target.id).css("display", "flex");
        $("#" + e.target.id).css("display", "none");
    });
});
// var ok= $('.active').find('img').attr('id');
var elem = "";
function update() {
    elem = document.getElementById($('.active').find('img').attr('id'));
    console.log(elem);
    window.setTimeout(update, 100);
}
update();
function openFullscreen() {
    if (elem.requestFullscreen) {
        elem.requestFullscreen();
    } else if (elem.webkitRequestFullscreen) { /* Safari */
        elem.webkitRequestFullscreen();
    } else if (elem.msRequestFullscreen) { /* IE11 */
        elem.msRequestFullscreen();
    }
}



$('#shawon').on('click', function () {
    var src = $('.active').find('img').attr('id');
    var pokat = $('.active').find('img').attr('class');
    $.ajax({
        url: "deletephoto.php",
        method: "POST",
        data: {
            paisii: src,
            poddi: pokat
        },
        cache: false,
        success: function (data) {
            console.log(data);
            if (data == 'susu') {

                $(location).prop('href', "groupphotoview.php");
            }
            else {

                $(location).prop('href', "groupphotoview.php?pidd=" + pokat);
            }
        }
    });
});

$(".kirebhai").unbind().click(function () {
    var finalid = this.id;
    var ss = finalid + "-";
    $.ajax({
        url: "grouplike.php",
        method: "POST",
        data: {
            pid: finalid
        },
        cache: false,
        success: function (data) {
            console.log(data);
            if (data == 'successfull')
                $("#" + finalid).html("<i style='margin-right:0.5rem;color:#2078F4' class='fa-solid fa-thumbs-up'></i>"+ 'Liked');
            else if (data == 'deleted') $("#" + finalid).html("<i style='margin-right:0.5rem;font-weight: 400;' class='fa-thin fa-thumbs-up'></i>" + 'Like');
        }
    });
    $.ajax({
        url: "grouplike.php",
        method: "POST",
        data: {
            poid: finalid
        },
        cache: false,
        success: function (data) {
            $('#' + ss).html(data);
        }
    });

});

$('form').unbind().on('submit', function () {
    var fid = this.id;
    var dog = fid.split("--")[0];
    var postdata = $("#" + fid).serialize() + "&pid=" + dog;
    $.post("groupcomment.php", postdata, function (data) {
        console.log(data);
    });

    $.ajax({
        url: "groupcomment.php",
        method: "POST",
        data: {
            droid: dog
        },
        cache: false,
        success: function (data) {
            if (data != "") {
                $('#' + dog + '____').html("");
                $('#' + dog + '____').append(data);
            }
        }
    });

    $.ajax({
        url: "groupcomment.php",
        method: "POST",
        data: {
            bhai: dog
        },
        cache: false,
        success: function (data) {
            $('#' + dog + "-----").html(data);
        }
    });

    $("form").trigger('reset');
    return false;
});
$(".normi").unbind().click(function (e) {
    var normiid = this.id.split("__")[0];
    $.ajax({
        url: "groupcomment.php",
        method: "POST",
        data: {
            droid: normiid
        },
        cache: false,
        success: function (data) {
            if (data != "") {
                $('#' + normiid + '____').html("");
                $('#' + normiid + '____').append(data);
            }
            //    console.log(data);
        }
    });
    $(location).prop('href', "#" + this.id + '_');
});