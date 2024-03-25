<?php
include "../utils.php";
include "../auth.php";

session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$check_password = $conn->prepare("SELECT p.pw_hashed_password FROM users AS u INNER JOIN passwords AS p ON u.u_id = p.u_id WHERE u.u_email = ?");
$check_password->bind_param("s", $email);
$check_password->execute();
$check_password->store_result();

if (!($check_password->num_rows > 0)) {
    $_SESSION['error_email_matches'] = "Não foi encontrado nenhum utilizador com esse email...";
    redirect("../../../signin/");
}

$check_password->bind_result($not_hashed_password);
$check_password->fetch();

$hashed_password = password_hash($not_hashed_password, PASSWORD_DEFAULT);

if(!(password_verify($password, $hashed_password))) {
    $_SESSION['error_password_matches'] = "A password esta incorrecta!";
    redirect("../../../signin/");
}

$_SESSION['signin'] = "online";
redirect("../../../account/requests");
?>