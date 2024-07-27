<?php
    include "../../utils.php";
    include "../../auth.php";

    session_start();

    function deleteOffers($conn, $offer_id, $returnToPage) {
        $deleteOffersQuery = "CALL delete_offer('". $_SESSION['email'] . "', $offer_id)";
        $deleteOffers = mysqli_query($conn, $deleteOffersQuery);

        if($deleteOffers) {
            redirect("../../../../../account/" . $returnToPage);
        }
    }

    $offerId = $_GET["ride_id"];
    $returnLink = $_GET["previous_url"];

    deleteOffers($conn, $offerId, $returnLink);
?>