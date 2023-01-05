<?php
$email = $_POST['email'];
$pwd = $_POST['pwd'];

$conn = new mysqli('localhost', 'root', '@DBMS15302sql', 'chat_app');
$sql = "SELECT * FROM acc_pwd WHERE email = '$email' AND password = '$pwd' LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0){
    session_start();
    $_SESSION['email'] = $email;
    echo 'sucess';
} else{
    echo "error";
    echo "Error Description: ", $conn -> error;
}

$conn->close();
?>