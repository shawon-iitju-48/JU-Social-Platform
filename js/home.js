$(document).ready(function () {

    $("#photos").click(function () {
        $(".photomodal").css("display", "block");
    });
    $("#depost").click(function () {
        $(".photomodal").css("display", "none");
    });
    $("#videos").click(function () {
        $(".photomodal").css("display", "block");
    });

    $("#bioedit").click(function () {
        $(".biolekho").css("display", "block");
        $(".1").css("display", "none");
        $("#bioeditcancel").css("display", "block");
        $("#bioedit").css("display", "none");
    });
    $("#bioeditcancel").click(function () {
        $("#bioedit").css("display", "block");
        $("#bioeditcancel").css("display", "none");
        $(".biolekho").css("display", "none");
        $(".1").css("display", "block");
    });
    $("#introedit").click(function () {
        $("#introedit").css("display", "none");
        $("#introeditcancel").css("display", "block");
        $(".myintro").css("display", "none");
        $(".editintro").css("display", "block");
    });
    $("#introeditcancel").click(function () {
        $("#introedit").css("display", "block");
        $("#introeditcancel").css("display", "none");
        $(".myintro").css("display", "block");
        $(".editintro").css("display", "none");
    });
    $("#aboutedit").click(function () {
        $("#aboutedit").css("display", "none");
        $("#abouteditcancel").css("display", "block");
        $(".myabout").css("display", "none");
        $(".editabout").css("display", "block");
    });
    $("#abouteditcancel").click(function () {
        $("#aboutedit").css("display", "block");
        $("#abouteditcancel").css("display", "none");
        $(".myabout").css("display", "block");
        $(".editabout").css("display", "none");
    });
    $("#bhnn").click(function () {
        $(".nai").css("display", "block");
        $(".bai").css("display", "block");
        $(".gai").css("display", "none");
        $(".fai").css("display", "block");
        $(".editintro").css("display", "none");
    });
    $("#bhn").click(function () {
        $(".editintro").css("display", "block");
        $(".nai").css("display", "none");
        $(".bai").css("display", "none");
        $(".gai").css("display", "block");
        $(".fai").css("display", "none");
    });

    $("#pills-home-tab").click(function () {
        $("#pills-contact-tab").removeClass("active");
        $("#pills-contact").removeClass("show active");
        $("#pills-home-tab").addClass("active");
        $("#pills-home").addClass("show active");
        $("#pills-profile-tab").removeClass("active");
        $("#pills-profile").removeClass("show active");
        $("#pills-photos-tab").removeClass("active");
        $("#pills-photos").removeClass("show active");
        $("#pills-videos-tab").removeClass("active");
        $("#pills-videos").removeClass("show active");
    });
    $("#pills-profile-tab").click(function () {
        $("#pills-contact-tab").removeClass("active");
        $("#pills-contact").removeClass("show active");
        $("#pills-home-tab").removeClass("active");
        $("#pills-home").removeClass("show active");
        $("#pills-profile-tab").addClass("active");
        $("#pills-profile").addClass("show active");
        $("#pills-photos-tab").removeClass("active");
        $("#pills-photos").removeClass("show active");
        $("#pills-videos-tab").removeClass("active");
        $("#pills-videos").removeClass("show active");
    });
    $("#pills-contact-tab").click(function () {
        $("#pills-home-tab").removeClass("active");
        $("#pills-home").removeClass("show active");
        $("#pills-profile-tab").removeClass("active");
        $("#pills-profile").removeClass("show active");
        $("#pills-contact-tab").addClass("active");
        $("#pills-contact").addClass("show active");
        $("#pills-photos-tab").removeClass("active");
        $("#pills-photos").removeClass("show active");
        $("#pills-videos-tab").removeClass("active");
        $("#pills-videos").removeClass("show active");
    });
    $("#seefriend").click(function () {
        $("#pills-home-tab").removeClass("active");
        $("#pills-home").removeClass("show active");
        $("#pills-profile-tab").removeClass("active");
        $("#pills-profile").removeClass("show active");
        $("#pills-contact-tab").addClass("active");
        $("#pills-contact").addClass("show active");
        $("#pills-photos-tab").removeClass("active");
        $("#pills-photos").removeClass("show active");
        $("#pills-videos-tab").removeClass("active");
        $("#pills-videos").removeClass("show active");
    });
    $("#seephotos").click(function () {
        $("#pills-home-tab").removeClass("active");
        $("#pills-home").removeClass("show active");
        $("#pills-profile-tab").removeClass("active");
        $("#pills-profile").removeClass("show active");
        $("#pills-contact-tab").removeClass("active");
        $("#pills-contact").removeClass("show active");
        $("#pills-photos-tab").addClass("active");
        $("#pills-photos").addClass("show active");
        $("#pills-videos-tab").removeClass("active");
        $("#pills-videos").removeClass("show active");
    });
    $("#pills-photos-tab").click(function () {
        $("#pills-home-tab").removeClass("active");
        $("#pills-home").removeClass("show active");
        $("#pills-profile-tab").removeClass("active");
        $("#pills-profile").removeClass("show active");
        $("#pills-contact-tab").removeClass("active");
        $("#pills-contact").removeClass("show active");
        $("#pills-photos-tab").addClass("active");
        $("#pills-photos").addClass("show active");
        $("#pills-videos-tab").removeClass("active");
        $("#pills-videos").removeClass("show active");
    });
    $("#pills-videos-tab").click(function () {
        $("#pills-home-tab").removeClass("active");
        $("#pills-home").removeClass("show active");
        $("#pills-profile-tab").removeClass("active");
        $("#pills-profile").removeClass("show active");
        $("#pills-contact-tab").removeClass("active");
        $("#pills-contact").removeClass("show active");
        $("#pills-photos-tab").removeClass("active");
        $("#pills-photos").removeClass("show active");
        $("#pills-videos-tab").addClass("active");
        $("#pills-videos").addClass("show active");
    });

    $("#work").click(function () {
        $(".info").css("display", "block");
        $(".places").css("display", "none");
        $(".relationship").css("display", "none");
        $(".aboutyou").css("display", "none");
        $(".contact").css("display", "none");
    });
    $("#place").click(function () {
        $(".info").css("display", "none");
        $(".places").css("display", "block");
        $(".relationship").css("display", "none");
        $(".aboutyou").css("display", "none");
        $(".contact").css("display", "none");
    });
    $("#contact").click(function () {
        $(".info").css("display", "none");
        $(".places").css("display", "none");
        $(".relationship").css("display", "none");
        $(".aboutyou").css("display", "none");
        $(".contact").css("display", "block");
    });
    $("#status").click(function () {
        $(".info").css("display", "none");
        $(".places").css("display", "none");
        $(".relationship").css("display", "block");
        $(".aboutyou").css("display", "none");
        $(".contact").css("display", "none");
    });
    $("#you").click(function () {
        $(".info").css("display", "none");
        $(".places").css("display", "none");
        $(".relationship").css("display", "none");
        $(".aboutyou").css("display", "block");
        $(".contact").css("display", "none");
    });





    var limit = 1;
    var start = 0;
    var action = 'inactive';
    function load_country_data(limit, start) {
        $.ajax({
            url: "fetchhome.php",
            method: "POST",
            data: {
                limit: limit,
                start: start
            },
            cache: false,
            success: function (data) {
                $('#load_data').append(data);
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
        start = start + limit;
        load_country_data(limit, start);
    }
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive') {
            action = 'active';
            console.log("w");
            start = start + limit;
            setTimeout(function () {
                load_country_data(limit, start);
            }, 10);
        }
    });
    $("#sc").scroll(function () {
        if ($("#sc").scrollTop() + $("#sc").height() > $("#load_data").height() && action == 'inactive') {
            action = 'active';
            console.log("j");
            start = start + limit;
            setTimeout(function () {
                load_country_data(limit, start);
            }, 10);
        }
    });



});