<?php
    function getAllRequests($conn) {
        $displayAllRequests = "SELECT * FROM all_requested_view;";
        $requestsAllQuery = mysqli_query($conn , $displayAllRequests);

        $final_data = array();
        if (mysqli_num_rows($requestsAllQuery) > 0) {
            while($row = mysqli_fetch_assoc($requestsAllQuery)){
                $final_data[] = $row;
            }
        }
        return $final_data;
    }
?>