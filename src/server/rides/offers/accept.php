<?php
include_once "../../auth/index.php";
include_once "../../utils.php";

    session_start();

    function acceptOffers($conn, $offer_id, $returnToPage) {
        $acceptOffersQuery = "CALL accept_offer($offer_id, '". $_SESSION['email'] ."');";
        $acceptOffers = mysqli_query($conn, $acceptOffersQuery);

        if($acceptOffers) {
            redirect("../../../../../account/" . $returnToPage);
        }
    }

    $offerId = $_GET["ride_id"];
    $returnLink = $_GET["previous_url"];

    acceptOffers($conn, $offerId, $returnLink);
?>