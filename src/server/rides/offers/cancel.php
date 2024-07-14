<?php
include_once "../../auth/index.php";
include_once "../../utils.php";

    session_start();

    function cancelOffers($conn, $driverEmail, $returnToPage) {
        $cancelOffersQuery = "CALL cancel_offers('$driverEmail');";
        $cancelOffersts = mysqli_query($conn, $cancelOffersQuery);

        if($cancelOffersts) {
            redirect("../../../../../account/" . $returnToPage);
        }
    }

    $returnLink = $_GET["previous_url"];
    $driverEmailGet = $_GET["driver_email"];

    cancelOffers($conn, $driverEmailGet, $returnLink);
?>