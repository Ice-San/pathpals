<?php
include "../../../utils.php";
include "../../../auth.php";

$requestFrom = $_POST['requestFrom'];
$requestTo = $_POST['requestTo'];
$requestAt = $_POST['requestAt'];

session_start();

$createrequestsQuery = "CALL add_request('". $_SESSION['email'] . "', '$requestFrom', '$requestTo', '$requestAt')";
$createrequests = mysqli_query($conn, $createrequestsQuery);

if($createrequests) {
    redirect("../../../../../account/requests");
}
?>