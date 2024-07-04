<?php
include_once "../auth/index.php";
include_once "../utils.php";

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

$check_institution_code = "SELECT * FROM institutions WHERE i_code ='$institutionCode'";
$check_institution_code_exists = mysqli_query($conn, $check_institution_code);

if($check_institution_code_exists->num_rows == 0) {
    $_SESSION['error_institutions'] = "Não existe nenhuma instituição com esse código...";
    redirect("../../../signup/"); 
}

$register_users = "CALL create_user('$username', '$email', '', '', '', '$password', 'user', 3, '$institutionCode')";
$create_user = mysqli_query($conn, $register_users);

if($create_user) {
    redirect("../../../signin/");
}
?>