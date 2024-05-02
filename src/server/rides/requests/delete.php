<?php
    include "../../utils.php";
    include "../../auth.php";

    session_start();

    function deleteRequests($conn, $request_id) {
        $deleteRequestsQuery = "CALL delete_request('". $_SESSION['email'] . "', $request_id)";
        $deleteRequests = mysqli_query($conn, $deleteRequestsQuery);

        if($deleteRequests) {
            redirect("../../../../../account/requests");
        }
    }

    $requestId = $_GET["ride_id"];

    deleteRequests($conn, $requestId);
?>