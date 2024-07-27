<?php
include_once "../../auth/index.php";
include_once "../../utils.php";

    session_start();

    function acceptRequests($conn, $request_id, $returnToPage) {
        $acceptOffersQuery = "CALL accept_request($request_id, '". $_SESSION['email'] ."');";
        $acceptOffers = mysqli_query($conn, $acceptOffersQuery);

        if($acceptOffers) {
            redirect("../../../../../account/" . $returnToPage);
        }
    }

    $requestId = $_GET["ride_id"];
    $returnLink = $_GET["previous_url"];

    acceptRequests($conn, $requestId, $returnLink);
?>