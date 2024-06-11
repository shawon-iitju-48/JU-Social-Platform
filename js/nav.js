$(document).ready(function () {
    $("#home250").hover(function(e) { 
        $(".bc").attr('data-after','Home');
    })
    $("#friend250").hover(function(e) { 
        $(".bc").attr('data-after','Friends');
    })
    $("#group250").hover(function(e) { 
        $(".bc").attr('data-after','Groups');
    })
    $("#messenger250").hover(function(e) { 
        $(".bc").attr('data-after','Messenger');
    })
    $("#notification250").hover(function(e) { 
        $(".bc").attr('data-after','Notifications');
    })
    $("#user250").hover(function(e) { 
        $(".bc").attr('data-after','Profile');
    })
    $("#classroom250").hover(function(e) { 
        $(".bc").attr('data-after','Classroom');
    })
    $("#logout250").hover(function(e) { 
        $(".bc").attr('data-after','Logout');
    })

    $("#logout250").click(function(e) { 
        window.location.href = "logout.php";
    })
    $("#notification250").click(function(e) { 
        window.location.href = "notifications.php";
    })
    $("#home250").click(function(e) { 
        window.location.href = "home.php";
    })
    $("#friend250").click(function(e) { 
        window.location.href = "friends.php";
    })
    $("#group250").click(function(e) { 
        window.location.href = "groupfeed.php";
    })

    $("#messenger250").click(function(e) { 
        window.location.href = "users.php";
    })
    $("#user250").click(function(e) { 
        window.location.href = "profile.php";
    })
    $("#classroom250").click(function(e) { 
        window.location.href = "others/user_type.php";
    })
    $("#brandd").click(function(e) { 
        window.location.href = "home.php";
    })
});