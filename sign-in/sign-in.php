<?php
    $method = $_POST['method'];

    if ($method == 'sign_up'){
        $email = $_POST['email'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $random_number = rand(111111, 999999);

        //enter data to the database
        $conn = new mysqli('localhost','root','@DBMS15302sql','chat_app');
        $sql = "INSERT INTO veri_code (email, first_name, last_name, vefi_code_number)
        VALUES ('$email','$first_name','$last_name','$random_number') 
        ON DUPLICATE KEY UPDATE vefi_code_number = $random_number, sent_date = DEFAULT;";
        $conn->query($sql);

        /*
        $sql = "SELECT * FROM veri_code WHERE email = 'wmkavinduudhara@gmail.com';";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $vefi_code_number = $row["vefi_code_number"];*/
    }

    //send the verification code
    require 'SMTP.php';
    require 'PHPMailer.php';
    require 'Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;

    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'wmkavinduudhara@gmail.com';
    $mail->Password = 'cjfcqlphodmnprkm';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('wmkavinduudhara@gmail.com', 'chat_app');
    $mail->addReplyTo('wmkavinduudhara@gmail.com', 'no_reply');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'verify your email address';
    $bodyContent = "Hi, $first_name! <br>";
    $bodyContent .= "your verification code is $random_number";
    $mail->Body    = $bodyContent;

    if (!$mail->send()){
        echo 'not_send';
    }else{
        echo 'send';
    }
?>