<?php
include_once "../../auth/index.php";
include_once "../../utils.php";

    session_start();

    function cancelRequests($conn, $travelerEmail, $returnToPage) {
        $cancelRequestsQuery = "CALL cancel_requests('$travelerEmail');";
        $cancelRequests = mysqli_query($conn, $cancelRequestsQuery);

        if($cancelRequests) {
            redirect("../../../../../account/" . $returnToPage);
        }
    }

    $returnLink = $_GET["previous_url"];
    $travelerEmailGet = $_GET["traveler_email"];

    cancelRequests($conn, $travelerEmailGet, $returnLink);
?>