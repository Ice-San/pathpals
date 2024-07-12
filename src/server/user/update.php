<?php
include_once "../auth/index.php";
include_once "../utils.php";

session_start();

function updateUsers($conn, $user_email, $new_firstname, $new_lastname, $new_age, $new_username, $new_career, $new_class, $new_location, $new_aboutme, $new_password) {
    $updateUsersQuery = "CALL update_user_info('$user_email', '$new_firstname', '$new_lastname', '$new_age', '$new_username', '$new_career', '$new_class', '$new_location', '$new_aboutme', '$new_password')";
    $updateUsers = mysqli_query($conn, $updateUsersQuery);

    if($updateUsers) {
        redirect("../../../account/profile");
    } else {
        echo "Erro ao atualizar informações do usuário: " . mysqli_error($conn);
    }
}

$userEmail = $_SESSION['email'];
$newUsername = $_POST["new_username"];
$newName = $_POST["new_name"];
$newCareer = $_POST["new_career"];
$newAge = $_POST["new_age"];
$newClass = $_POST["new_class"];
$newLocation = $_POST["new_location"];
$newAboutMe = $_POST["new_aboutme"];
$newPassword = $_POST["new_password"];

$name_parts = explode(" ", $newName);
$newFirstname = $name_parts[0];
$newLastname = end($name_parts);

if(empty($newPassword)) {
    redirect("../../../account/profile?error=password_empty");
}

updateUsers($conn, $userEmail, $newFirstname, $newLastname, $newAge, $newUsername, $newCareer, $newClass, $newLocation, $newAboutMe, $newPassword);
?>