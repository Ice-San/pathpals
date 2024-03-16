<?php
include "../../server/auth.php";

$username = $_POST['username'];
$email = $_POST['email'];
$institutionCode = $_POST['instituion-code'];
$password = $_POST['password'];

$register_users = "CALL create_user('$username', '$email', 'Ruben', 'Costa', 'M', '$password', 'admin', 0)";

$create_user = mysqli_query($conn, $register_users);
?>