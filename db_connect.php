<?php
$server_name = "localhost";
$user_name = "root";
$user_password = "";
$database_name = "music_user";

$conn = mysqli_connect($server_name, $user_name, $user_password, $database_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
