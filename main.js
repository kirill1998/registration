
$("#registrationForm").submit(function () {
    var str= $(this).serialize();
    $.ajax({
        url: "registration.php",
        type: "POST",
        dataType: "json",
        data: str,
        async: true,
        success: function (data)
        {
            if(data=== "success"){
                window.location ="index.html"
            }
            else
            {
                $("#info").html( data);
            }
        }
    });
    return false;
});

$("#loginForm").submit(function () {
    var str= $(this).serialize();
    $.ajax({
        url: "auth.php",
        type: "POST",
        dataType: "json",
        data: str,
        async: true,
        success: function (data)
        {
            if(data=== "success"){
              window.location ="hello.php"
            }
            else
            {
              $("#info").html( data);
            }

        }
    });
    return false;
});
