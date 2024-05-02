<?php
    include "../../utils.php";
    include "../../auth.php";

    session_start();

    function delete($conn, $offer_id) {
        $deleteOffersQuery = "CALL delete_offer('". $_SESSION['email'] . "', $offer_id)";
        $deleteOffers = mysqli_query($conn, $deleteOffersQuery);

        if($deleteOffers) {
            redirect("../../../../../account/offers");
        }
    }

    $offerId = $_GET["ride_id"];

    delete($conn, $offerId);
?>