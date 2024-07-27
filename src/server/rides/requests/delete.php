<?php
    include_once "../../auth/index.php";
    include_once "../../utils.php";

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