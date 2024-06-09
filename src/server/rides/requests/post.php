<?php
include_once "../../auth/index.php";
include_once "../../utils.php";

$requestFrom = $_POST['requestFrom'];
$requestTo = $_POST['requestTo'];
$requestAt = $_POST['requestAt'];
$requestToTime = $_POST['requestToTime'];

session_start();

$createrequestsQuery = "CALL add_request('". $_SESSION['email'] . "', '$requestFrom', '$requestTo', '$requestAt', '$requestToTime')";
$createrequests = mysqli_query($conn, $createrequestsQuery);

if($createrequests) {
    redirect("../../../../../account/requests");
}
?>