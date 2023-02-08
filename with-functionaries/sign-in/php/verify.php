<?php
    //hide all errors/wornings/notices
    //error_reporting(E_ALL ^ E_NOTICE);

    $email = $_POST['email'];
    $verify_code = $_POST['verify_code'];

    //retrive data to the database
    $conn = new mysqli('localhost','root','@DBMS15302sql','chat_app');
    $sql = "SELECT * FROM veri_code WHERE email = '$email' LIMIT 1;";
    $result = $conn->query($sql);

    $row = mysqli_fetch_assoc($result);
    if(is_null($row["first_name"])){
        echo 'code_exp';
    } else{
        $first_name = $row["first_name"];
        $last_name = $row['last_name'];
        $veri_code = $row['vefi_code_number'];
        
        
        if($veri_code == $veri_code){
            echo ('sucess');

            $sql = "INSERT INTO acc_info (email,first_name,last_name) VALUES ('$email','$first_name','$last_name');";
            $result = $conn->query($sql);
        }
    }
?>