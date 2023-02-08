var log_in = true;
$(function () {
    $("#log-in").on("click", function log_in() {
        $("#log-in").animate({
            backgroundColor: "rgb(123, 123, 123)",
            color: "#fff"
        }, 500);
        $("#sign-up").animate({
            backgroundColor: "rgb(241, 241, 241)",
            color: "#000"
        }, 500);
        $("#conferm").text("log in");
        var selectedEffect = 'drop';
        var options = { to: { width: 200, height: 60 } };
        $("#first-name").hide(selectedEffect, options, 500);
        setTimeout(() => {
            $("#second-name").hide(selectedEffect, options, 500);
            setTimeout(() => {
                $("#pwd").show(selectedEffect, options, 1000);
            }, 550);
        }, 550);
        log_in = true;
    });

    $("#sign-up").on("click", function () {
        $("#log-in").animate({
            backgroundColor: "rgb(241, 241, 241)",
            color: "#000"
        }, 500);
        $("#sign-up").animate({
            backgroundColor: "rgb(123, 123, 123)",
            color: "#fff"
        }, 500);
        $("#conferm").text("send my verification code");
        log_in = false;
    });
    /*
        $("#lg-in-options").on("click", function () {
            if (log_in) {
            } else {
            }
            log_in = !log_in;
        });*/
});

$(function () {
    // run the currently selected effect
    function runEffect() {
        // get effect type from
        var selectedEffect = 'drop';

        // Most effect types need no options passed by default
        var options = {};
        // some effects have required parameters
        if (selectedEffect === "scale") {
            options = { percent: 50 };
        } else if (selectedEffect === "size") {
            options = { to: { width: 200, height: 60 } };
        }

        // Run the effect
        $("#pwd").hide(selectedEffect, options, 500);
        setTimeout(() => {
            $("#first-name").show(selectedEffect, options, 500);
            setTimeout(() => {
                $("#second-name").show(selectedEffect, options, 500);
            }, 550);
        }, 550);
    };

    // Callback function to bring a hidden box back
    function callback() {
        setTimeout(function () {
            $("#pwd").removeAttr("style").hide().fadeIn();
        }, 10);
    };

    // Set effect from select menu value
    $("#sign-up").on("click", function () {
        runEffect();
    });
});

$(function () {
    var inp_no = 1;
    $("#n" + inp_no).on('keyup', function move_focus() {
        if ($(this).val().length > 0) {
            inp_no += 1;
            $("#n" + inp_no).focus();
            $("#n" + inp_no).on('keyup', function move_focus() {
                if ($(this).val().length > 0) {
                    inp_no += 1;
                    $("#n" + inp_no).focus();
                    $("#n" + inp_no).on('keyup', function move_focus() {
                        if ($(this).val().length > 0) {
                            inp_no += 1;
                            $("#n" + inp_no).focus();
                            $("#n" + inp_no).on('keyup', function move_focus() {
                                if ($(this).val().length > 0) {
                                    inp_no += 1;
                                    $("#n" + inp_no).focus();
                                    $("#n" + inp_no).on('keyup', function move_focus() {
                                        if ($(this).val().length > 0) {
                                            inp_no += 1;
                                            $("#n" + inp_no).focus();
                                        }
                                    });
                                }
                            });
                        }
                    });
                }
            });
        }
    });
});

var on_step = 0;
function confirm() {
    if (log_in) {
        var email = $("#email").val();
        var pwd = $("#pwd").val();
        if (on_step == 0){
            var form3 = new FormData();
            form3.append('email',email);
            form3.append('pwd',pwd);

            var xmlhttp3 = new XMLHttpRequest();
            xmlhttp3.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var response3 = this.responseText;
                    if (response3 == 'sucess'){
                        window.location.replace("../");
                    }
                }
            }
            xmlhttp3.open("POST", "php/log-in.php", true);
            xmlhttp3.send(form3);
        }
    } else {
        var email = $("#email").val();
        if (on_step == 0) {
            var first_name = $("#first-name").val();
            var last_name = $("#second-name").val();
            var form = new FormData();
            form.append('method', 'sign_up');
            form.append('email', email);
            form.append('first_name', first_name);
            form.append('last_name', last_name);
            var xmlhttp = new XMLHttpRequest();

            var selectedEffect = 'fold';
            var options = { to: { width: 200, height: 60 } };

            xmlhttp.onreadystatechange = function () {
                if (this.readyState < 2 && this.readyState > 0) {
                    $("#log-in-info").hide(selectedEffect, options, 500);
                    $("#conferm").hide(selectedEffect, options, 500);
                    $("#sending-email").css('display', 'flex');
                    $("#sending-email").hide(selectedEffect, options, 0);
                    $("#sending-email").show(selectedEffect, options, 500);
                }
                if (this.readyState == 4 && this.status == 200) {
                    var response = this.responseText;
                    if (response == 'send'){
                        $("#sending-email").hide(selectedEffect, options, 0);
                        $("#confirm-email").css('display', 'flex');
                        $("#confirm-email").hide(selectedEffect, options, 0);
                        $("#confirm-email").show(selectedEffect, options, 500);
                        $("#conferm").text("verify my code");
                        $("#conferm").show(selectedEffect, options, 500);
                        on_step = 1;
                    }
                    /*var response = this.responseText;
                    if(response){
                        console.log(response);
                    }*/
                }
            };
            xmlhttp.open("POST", "php/sign-in.php", true);
            xmlhttp.send(form);
        }
        if (on_step == 1) {
            var vri_code = $("#n1").val() + $("#n2").val() + $("#n3").val() + $("#n4").val() + $("#n5").val() + $("#n6").val();
            var form1 = new FormData();
            form1.append('method', 'verify_the_code');
            form1.append('email', email);
            form1.append('verify_code', vri_code);

            var xmlhttp1 = new XMLHttpRequest();

            xmlhttp1.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    response = this.responseText;
                    if (response == 'sucess'){
                        $("#confirm-email").hide(selectedEffect, options, 0);
                        $("#enter-password").css('display', 'flex');
                        $("#enter-password").hide(selectedEffect, options, 0);
                        $("#enter-password").show(selectedEffect, options, 500);
                        $("#conferm").text("create new password");
                        on_step = 2;
                    }
                }
            }
            xmlhttp1.open("POST", "php/verify.php", true);
            xmlhttp1.send(form1);
        }
        if(on_step == 2){
            var pwd = $("#pwd1").val();

            var form2 = new FormData();
            form2.append('email',email);
            form2.append('pwd',pwd);

            var xmlhttp2 = new XMLHttpRequest();
            xmlhttp2.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    response = this.responseText;
                    if (response == 'sucess'){
                        log_in();
                    }
                }
            }
            xmlhttp2.open("POST", "php/add_pwd.php", true);
            xmlhttp2.send(form2);
        }
    }
}

/*
$(function () {
    $("#conferm").on("click", function () {
        if (log_in) {
        } else {
            var email = $("#email").val();
            var first_name = $("#first-name").val();
            var last_name = $("#second-name").val();
            var form = new FormData();
            form.append('method','sign_up');
            form.append('email',email);
            form.append('first_name',first_name);
            form.append('last_name',last_name);
            var xmlhttp = new XMLHttpRequest();

            var selectedEffect = 'fold';
            var options = { to: { width: 200, height: 60 } };

            xmlhttp.onreadystatechange = function () {
                if(this.readyState < 2 && this.readyState > 0){
                    $("#log-in-info").hide(selectedEffect, options, 500);
                    $("#conferm").hide(selectedEffect, options, 500);
                    $("#sending-email").css('display', 'flex');
                    $("#sending-email").hide(selectedEffect, options, 0);
                    $("#sending-email").show(selectedEffect, options, 500);
                }
                if (this.readyState == 4 && this.status == 200) {
                    $("#sending-email").hide(selectedEffect, options, 0);
                    $("#confirm-email").css('display', 'flex');
                    $("#confirm-email").hide(selectedEffect, options, 0);
                    $("#confirm-email").show(selectedEffect, options, 500);
                    $("#conferm").text("verify my code");
                    $("#conferm").show(selectedEffect, options, 500);
                    $("#conferm").on("click", function () {
                        vri_code = $("#n1").val() + $("#n2").val() +$("#n3").val() + $("#n4").val() + $("#n5").val() + $("#n6").val();
                        form1 = new FormData();
                        form1.append('method','verify_the_code');
                        form1.append('email',email);
                        form1.append('verify_code', vri_code);

                        var xmlhttp1 = new XMLHttpRequest();

                        xmlhttp1.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                res = this.responseText;
                                //alert(res);
                            }
                        }
                        xmlhttp1.open("POST", "php/verify.php", true);
                        xmlhttp1.send(form1);
                    });
                    var response = this.responseText;
                    if(response){
                        console.log(response);
                    }
                }
            };
            xmlhttp.open("POST", "php/sign-in.php", true);
            xmlhttp.send(form);
        }
    });
});*/

/*$.ajax({
    type: "POST",
    beforeSend: function(request) {
      request.setRequestHeader("Authority", authorizationToken);
    },
    url: "entities",
    data: "json=" + escape(JSON.stringify(createRequestObject)),
    processData: false,
    success: function(msg) {
      $("#results").append("The result =" + StringifyPretty(msg));
    }
  }); */
/*
$(function () {
    /*
    $("#conferm").on("click",function(){
        if (log_in){
            var email = 
        }/*
        if (str.length == 0) {
            document.getElementById("txtHint").innerHTML = "";
            return;
          } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
              }
            };
            xmlhttp.open("GET", "gethint.php?q=" + str, true);
            xmlhttp.send();
          }
    })
});*/