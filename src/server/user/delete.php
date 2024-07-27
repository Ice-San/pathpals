<?php
    include_once "../auth/index.php";
    include_once "../utils.php";

    session_start();

    function deleteUsers($conn, $user_email, $returnToPage) {
        $deleteUsersQuery = "CALL delete_user('$user_email')";
        $deleteUsers = mysqli_query($conn, $deleteUsersQuery);

        if($deleteUsers) {
            redirect("../../../../../account/" . $returnToPage);
        }
    }

    $userEmail = $_GET["user_email"];
    $returnLink = $_GET["previous_url"];

    deleteUsers($conn, $userEmail, $returnLink);
?>