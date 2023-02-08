$(function () {
    var selectedEffect = 'fade';
    var options = {};
    $('#popup1').hide( selectedEffect, options, 0);
})

function popup(method,options = null) {
    var selectedEffect = 'fade';
    var options = {};
    if (method == 'add_new_c') {
        $('#popup1').css('visibility', 'visible');
        $('#popup1').show( selectedEffect, options, 100);
    }

    if (method == 'close'){
        $('#popup1').hide( selectedEffect, options, 200);
    }
}


function action(method){
    if (method == 'add_new_c'){
        var email = $('#new-c-email').val();
        $('#action-image').attr('src','images/svg/sync-outline.svg');
        $('#action-image').css('animation-name','rotate');
        $('#action-image').css('animation-duration','2s');
        $('#action-image').css('animation-iteration-count','infinite');

        var form = new FormData();
        form.append('email',email);

        xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "php/add_new_c.php", true);
        xmlhttp.send(form);
    }
}

function load_chat_history(acc_id, acc_email, status, ohter){
    alert(acc_email);
}