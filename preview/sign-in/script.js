var log_in = true;
$(function () {
    $("#log-in").on("click", function () {
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