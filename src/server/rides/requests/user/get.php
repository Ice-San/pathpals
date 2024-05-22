<?php   
    function getUserRequests($conn) {
        $displayMyRequests = "CALL get_user_requests('". $_SESSION['email'] . "');";
        $requestsMyQuery = mysqli_query($conn , $displayMyRequests);

        $final_data = array();
        if (mysqli_num_rows($requestsMyQuery) > 0) {
            while($row = mysqli_fetch_assoc($requestsMyQuery)){
                $final_data[] = $row;
            }
        }
        return $final_data;
    }
?>