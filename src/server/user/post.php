<?php
include_once "../../src/server/auth/index.php";
include_once "../../src/server/utils.php";

session_start();

$username = $_POST['username'];
$email = $_POST['email'];
$institutionCode = $_POST['institution-code'];
$password = $_POST['password'];

$check_email = "SELECT * FROM users WHERE u_email='$email'";
$check_email_exists = mysqli_query($conn, $check_email);

if($check_email_exists->num_rows > 0) {
    $_SESSION['error_email'] = "Já existe um utilizador com esse email!";
    redirect("../../../signup/"); 
}

$register_users = "CALL create_user('$username', '$email', '', '', '', '$password', 'user', 3)";
$create_user = mysqli_query($conn, $register_users);

if($create_user) {
    redirect("../../../signin/");
}
?>