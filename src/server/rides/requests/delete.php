<?php
    include "../../utils.php";
    include "../../auth.php";

    session_start();

    function deleteRequests($conn, $request_id, $returnToPage) {
        $deleteRequestsQuery = "CALL delete_request('". $_SESSION['email'] . "', $request_id)";
        $deleteRequests = mysqli_query($conn, $deleteRequestsQuery);

        if($deleteRequests) {
            redirect("../../../../../account/" . $returnToPage);
        }
    }

    $requestId = $_GET["ride_id"];
    $returnLink = $_GET["previous_url"];

    deleteRequests($conn, $requestId, $returnLink);
?>