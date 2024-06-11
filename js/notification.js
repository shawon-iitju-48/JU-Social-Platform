$(document).ready(function () {
    $(".cd").click(function (e) {
        $(location).prop('href', e.target.id)
    });
    $(".cd .mid").click(function (e) {
        $(location).prop('href', e.target.id)
    });

});