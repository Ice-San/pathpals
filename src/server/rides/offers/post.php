<?php
include_once "../../auth/index.php";
include_once "../../utils.php";

$offerFrom = $_POST['offerFrom'];
$offerTo = $_POST['offerTo'];
$offerAt = $_POST['offerAt'];
$offerToTime = $_POST['offerToTime'];

session_start();

$createOffersQuery = "CALL add_offer('". $_SESSION['email'] . "', '$offerFrom', '$offerTo', '$offerAt', '$offerToTime')";
$createOffers = mysqli_query($conn, $createOffersQuery);

if($createOffers) {
    redirect("../../../../../account/offers");
}
?>