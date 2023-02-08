<?php
session_start();

$to_acc = $_POST['email'];
$from_acc = $_SESSION['email'];


$conn = new mysqli('localhost', 'root', '@DBMS15302sql', 'chat_app');
$sql = "SELECT DISTINCT id,email FROM acc_info WHERE email = '$to_acc' LIMIT 1;";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);

$to_acc_id = $row["id"];
echo $to_acc_id, '<br>';

$sql = "SELECT DISTINCT id,email FROM acc_info WHERE email = '$from_acc' LIMIT 1;";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);

$from_acc_id = $row['id'];

$sql = "INSERT INTO contacts (from_acc, to_acc, `status`) VALUES ('$from_acc_id', '$to_acc_id', 'pending');";
$result = $conn->query($sql);
?>