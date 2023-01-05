<?php
//hide all errors/wornings/notices
//error_reporting(E_ALL ^ E_NOTICE);

$email = $_POST['email'];
$pwd = $_POST['pwd'];

//retrive data to the database
$conn = new mysqli('localhost', 'root', '@DBMS15302sql', 'chat_app');
$sql = "SELECT * FROM acc_info WHERE email = '$email' LIMIT 1;";
$result = $conn->query($sql);

$row = mysqli_fetch_assoc($result);
if (is_null($row["first_name"])) {
    echo 'bad_verify';
} else {

    $sql = "INSERT INTO acc_pwd (email, `password`) VALUES ('$email', $pwd);";
    $result = $conn->query($sql);

    echo 'sucess';
}

    //$sql = "INSERT INTO users (email,first_name,last_name) VALUES ('$email','$first_name','$last_name');";
