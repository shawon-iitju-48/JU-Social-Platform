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
        $("#pills-request-tab").removeClass("active");
        $("#pills-request").removeClass("show active");
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
    $("#pills-request-tab").click(function () {
        $("#pills-contact-tab").removeClass("active");
        $("#pills-contact").removeClass("show active");
        $("#pills-home-tab").removeClass("active");
        $("#pills-home").removeClass("show active");
        $("#pills-profile-tab").removeClass("active");
        $("#pills-profile").removeClass("show active");
        $("#pills-photos-tab").removeClass("active");
        $("#pills-photos").removeClass("show active");
        $("#pills-videos-tab").removeClass("active");
        $("#pills-videos").removeClass("show active");
        $("#pills-request-tab").addClass("active");
        $("#pills-request").addClass("show active");
        $(".rounded-circlee").css("display", "none");
    });
    $("#pills-profile-tab").click(function () {
        $("#pills-request-tab").removeClass("active");
        $("#pills-request").removeClass("show active");
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
        $('#dhukao').html("");

        $.ajax({
            url: "groupadditional.php",
            method: "POST",
            data: {
                dau: 45
            },
            cache: false,
            success: function (data) {
                $('#dhukao').append(data);
            }
        });
    });
    $("#pills-contact-tab").click(function () {
        $("#pills-request-tab").removeClass("active");
        $("#pills-request").removeClass("show active");
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
        $('#frienddau').html("");
        var limitf = 2;
        var startf = 0;
        var actionf = 'inactive';
        function load_country_dataf(limitf, startf) {
            $.ajax({
                url: "groupadditional.php",
                method: "POST",
                data: {
                    limitf: limitf,
                    startf: startf
                },
                cache: false,
                success: function (data) {
                    $('#frienddau').append(data);
                    if (data == '') {
                        actionf = 'active';
                    } else {
                        actionf = "inactive";
                    }
                }
            });
        }

        if (actionf == 'inactive') {
            actionf = 'active';
            load_country_dataf(limitf, startf);
        }
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() > $("#frienddau").height() && actionf == 'inactive') {
                actionf = 'active';
                console.log("wf");
                startf = startf + limitf;
                setTimeout(function () {
                    load_country_dataf(limitf, startf);
                }, 10);
            }
        });
    });
    $("#seefriend").click(function () {
        $("#pills-request-tab").removeClass("active");
        $("#pills-request").removeClass("show active");
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
        $('#frienddau').html("");
        var limitf = 2;
        var startf = 0;
        var actionf = 'inactive';
        function load_country_dataf(limitf, startf) {
            $.ajax({
                url: "groupadditional.php",
                method: "POST",
                data: {
                    limitf: limitf,
                    startf: startf
                },
                cache: false,
                success: function (data) {
                    $('#frienddau').append(data);
                    if (data == '') {
                        actionf = 'active';
                    } else {
                        actionf = "inactive";
                    }
                }
            });
        }

        if (actionf == 'inactive') {
            actionf = 'active';
            load_country_dataf(limitf, startf);
        }
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() > $("#frienddau").height() && actionf == 'inactive') {
                actionf = 'active';
                console.log("wf");
                startf = startf + limitf;
                setTimeout(function () {
                    load_country_dataf(limitf, startf);
                }, 10);
            }
        });
    });
    $("#seephotos").click(function () {
        $("#pills-request-tab").removeClass("active");
        $("#pills-request").removeClass("show active");
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
        $('#photodau').html("");
        var limitp = 4;
        var startp = 0;
        var actionp = 'inactive';
        function load_country_datap(limitp, startp) {
            $.ajax({
                url: "groupadditional.php",
                method: "POST",
                data: {
                    limitp: limitp,
                    startp: startp
                },
                cache: false,
                success: function (data) {
                    $('#photodau').append(data);
                    if (data == '') {
                        actionp = 'active';
                    } else {
                        actionp = "inactive";
                    }
                }
            });
        }

        if (actionp == 'inactive') {
            actionp = 'active';
            load_country_datap(limitp, startp);
        }
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() > $("#photodau").height() && actionp == 'inactive') {
                actionp = 'active';
                console.log("wp");
                startp = startp + limitp;
                setTimeout(function () {
                    load_country_datap(limitp, startp);
                }, 10);
            }
        });
    });
    $("#pills-photos-tab").unbind().click(function () {
        $("#pills-request-tab").removeClass("active");
        $("#pills-request").removeClass("show active");
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
        $('#photodau').html("");


        var limitp = 4;
        var startp = 0;
        var actionp = 'inactive';
        function load_country_datap(limitp, startp) {
            $.ajax({
                url: "groupadditional.php",
                method: "POST",
                data: {
                    limitp: limitp,
                    startp: startp
                },
                cache: false,
                success: function (data) {
                    $('#photodau').append(data);
                    if (data == '') {
                        actionp = 'active';
                    } else {
                        actionp = "inactive";
                    }
                }
            });
        }

        if (actionp == 'inactive') {
            actionp = 'active';
            load_country_datap(limitp, startp);
        }
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() > $("#photodau").height() && actionp == 'inactive') {
                actionp = 'active';
                console.log("wp");
                startp = startp + limitp;
                setTimeout(function () {
                    load_country_datap(limitp, startp);
                }, 10);
            }
        });
    });
    $("#pills-videos-tab").click(function () {
        $("#pills-request-tab").removeClass("active");
        $("#pills-request").removeClass("show active");
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
        $('#videodau').html("");
        var limitv = 1;
        var startv = 0;
        var actionv = 'inactive';
        function load_country_datav(limitv, startv) {
            $.ajax({
                url: "groupadditional.php",
                method: "POST",
                data: {
                    limitv: limitv,
                    startv: startv
                },
                cache: false,
                success: function (data) {
                    $('#videodau').append(data);
                    if (data == '') {
                        actionv = 'active';
                    } else {
                        actionv = "inactive";
                    }
                }
            });
        }

        if (actionv == 'inactive') {
            actionv = 'active';
            load_country_datav(limitv, startv);
        }
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() > $("#videodau").height() && actionv == 'inactive') {
                actionv = 'active';
                console.log("wv");
                startv = startv + limitv;
                setTimeout(function () {
                    load_country_datav(limitv, startv);
                }, 10);
            }
        });
    });







    var limit = 1;
    var start = 0;
    var action = 'inactive';
    function load_country_data(limit, start) {
        $.ajax({
            url: "fetchgrouppost.php",
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
    }
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive') {
            action = 'active';
            console.log("w");
            start = start + limit;
            setTimeout(function () {
                load_country_data(limit, start);
            }, 1);
        }
    });
    $("#sc").scroll(function () {
        if ($("#sc").scrollTop() + $("#sc").height() > $("#load_data").height() && action == 'inactive') {
            action = 'active';
            console.log("j");
            start = start + limit;
            setTimeout(function () {
                load_country_data(limit, start);
            }, 1);
        }
    });


    $("#khojkoro").keyup(function () {
        $('#frienddau').html("");
        console.log(khojkoro.value);
        $.ajax({
            url: "groupadditional.php",
            method: "POST",
            data: {
                omago: khojkoro.value
            },
            cache: false,
            success: function (data) {
                $('#frienddau').append(data);
            }
        });
    });
    $("#natore").keyup(function () {
        $('#suggested').html("");
        console.log(natore.value);
        $.ajax({
            url: "groupadditional.php",
            method: "POST",
            data: {
                natore: natore.value
            },
            cache: false,
            success: function (data) {
                $('#suggested').append(data);
            }
        });
    });




    var ltd = 5;
    var std = 0;
    var ana = 'inactive';

    function load_country_datatt(ltd, std) {
        $.ajax({
            url: "getmember.php",
            method: "POST",
            data: {
                ltd: ltd,
                std: std
            },
            cache: false,
            success: function (data) {
                $('#rqt').append(data);
                if (data == '') {
                    ana = 'active';
                } else {
                    ana = "inactive";
                }
            }
        });
    }

    if (ana == 'inactive') {
        ana = 'active';
        load_country_datatt(ltd, std);
    }
    $("#pills-request").scroll(function () {
        if ($("#pills-request").scrollTop() + $("#pills-request").height() > $("#rqt").height() && ana == 'inactive') {
            ana = 'active';
            console.log("rqt");
            std = std + ltd;
            setTimeout(function () {
                load_country_datatt(ltd, std);
            }, 1);
        }
    });

    function updated() {
        $.get("grouprefetch.php", function (data) {
            $('#kotorq2').html(data);
            window.setTimeout(updated, 1000);
        });
        console.log("ashlam mem");
    }
    updated();
});