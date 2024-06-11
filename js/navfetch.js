$(document).ready(function () {
    function update() {
        $.get("fetchnav.php", function (data) {
            $('#kotorq1').html(data);
            window.setTimeout(update, 1000);
        });
        console.log("ashlam");
    }
    update();



    function updated() {
        $.get("kotonoti.php", function (data) {
            $('#kotonoti').html(data);
            window.setTimeout(updated, 1000);
        });
        console.log("noti");
    }
    updated();

    function updatedd() {
        $.get("kotomessage.php", function (data) {
            $('#kotomessage').html(data);
            window.setTimeout(updatedd, 1000);
        });
        console.log("message");
    }
    updatedd();
});
