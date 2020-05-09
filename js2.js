//Form & Login,SignUp,UserAction & FormValidate & Cookie

function AutoLogin() {
    if (GetCookie('mytoken') != "") {
        var div = $('<a href="javascript:;" id="sidebar-toggle">Menu</a>');
        div.appendTo($("#login-menu"));
    } else {
        //alert('???')
        var div = $('<a href="javascript:;" onclick="Form()">Login</a>');
        div.appendTo($("#login-menu"));
    }
}

function Form() {
    if (document.getElementById("login-div")) { return false }
    $.get('./php/form.php').then(
        function (response) {
            var div = $(response);
            div.appendTo($("body"));
            //$("form").remove();
            //console.log(response);
        },
        function (xhr) {
            console.log(xhr.status, xhr.statusText);
        }
    )
    enableInput(false)
}

function Login(email, password) {
    $.post("./php/process.php", {
        type: "login",
        email: email,
        password: password
    }).then(
        function (response) {
            console.log(response);
            if (response != "Login Failed!") {
                SetCookie('mytoken', response);
                window.location.href = 'index.html';
            }
        },
        function (xhr) { console.log(xhr.status, xhr.statusText); alert('Login Error!'); }
    )
}

function UserAction() {
    $.post("./php/process.php", {
        type: "useraction",
        token: GetCookie('mytoken'),
        data: ''
    }).then(
        function (response) { console.log(response); },
        function (xhr) { console.log(xhr.status, xhr.statusText); }
    )
}

function RecreateTable() {
    $.post("./php/process.php", { type: "recreatetable" }).then(
        function (response) { console.log(response); },
        function (xhr) { console.log(xhr.status, xhr.statusText) })
}

function SignUp(email, password) {
    $.post("./php/process.php", { type: "signup", email: email, password: password }).then(
        function (response) { console.log(response); },
        function (xhr) { console.log(xhr.status, xhr.statusText) })
}

function invalidForm() {
    var form = $(".login-form .button");
    form.addClass("ani-ring");
    setTimeout(function () {
        form.removeClass("ani-ring");
    }, 1000);
}

function validateForm() {
    $(".login-form").animate({
        opacity: 0
    });
}

function SetCookie(cname, cvalue) {
    document.cookie = cname + "=" + cvalue;
}

function GetCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i].trim();
        if (c.indexOf(name) == 0) { return c.substring(name.length, c.length); }
    }
    return "";
}