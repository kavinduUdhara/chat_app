<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if(isset($_SESSION['email'])){
    header(('Location: ../'));
}
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sigin-in to the chat app</title>
    <link rel="stylesheet" href="../jquery-ui-1.13.2/jquery-ui.css">
    <script src="../j-query/jquery-3.6.1.min.js"></script>
    <script src="../jquery-ui-1.13.2/jquery-ui.js"></script>
    <script src="./script.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="holder">
        <div class="left">
            <div class="txt">Lets chat with your lovers!</div>
        </div>
        <div class="right">
            <div class="log-in-options" id="lg-in-options">
                <div class="option selected" id="log-in">log in</div>
                <div class="option non-selected" id="sign-up">sign up</div>
            </div>
            <div class="log-in-tab" id="log-in-tab">
                <div class="log-in-info" id="log-in-info">
                    <input type="email" id="email" placeholder="e - mail">
                    <input type="password" id="pwd" placeholder="password">
                    <input type="text" id="first-name" placeholder="First Name">
                    <input type="text" id="second-name" placeholder="Second Name">
                </div>
                <div class="sending-email" id="sending-email">
                    <img src="../images/svg/mail-outline.svg" alt="">
                    <div>your email is on the way</div>
                </div>
                <div class="confirm-email" id="confirm-email">
                    <div>Conferm your verification code below</div>
                    <div class="verifi_code">
                        <input type="text" id="n1">
                        <input type="text" id="n2">
                        <input type="text" id="n3">
                        <input type="text" id="n4">
                        <input type="text" id="n5">
                        <input type="text" id="n6">
                    </div>
                    <div style="font-size: smaller;">your verification code will expire in 5m</div>
                </div>
                <div class="enter-password" id="enter-password">
                    <div>Enter a password for your account</div>
                    <input type="password" id="pwd1">
                </div>
            </div>
            <div class="conferm">
                <div class="bttn" id="conferm" onclick="confirm()">log in</div>
            </div>
        </div>
        <!--delete from demo where duedate < (now() - interval 5 minute);-->
        <!-- select cast(RAND() * 1000000 as float);-->
        <!--insert into veri_code (email,first_name,last_name) values ('wmkavinduudhara@gmail.com','kavindu','udhara') on duplicate key update first_name=values(first_name)-->
        <!-- insert into veri_code (email,first_name,last_name) values ('wmkavinduudhara@gmail.com','kavindu','udhara') on duplicate key update vefi_code_number = default;-->

        <!--
            -- create a timer to update this table automatically

DROP EVENT IF EXISTS `et_update_your_trigger_name`;
CREATE EVENT `et_update_your_trigger_name`  ON SCHEDULE EVERY 1 MINUTE 
STARTS '2010-01-01 00:00:00' 
DO 
DELETE FROM `DB_NAME`.`table_name` where DATEDIFF(now(),`timestamp`) > 1;

ALTER EVENT `et_update_your_trigger_name` ON  COMPLETION PRESERVE ENABLE;
        -->
    </div>
</body>
</html>