<?php
    function getCurrentTravel($conn) {
        $currentTravelProcedure = "CALL get_connections('". $_SESSION['email'] . "')";
        $currentTravelQuery = mysqli_query($conn , $currentTravelProcedure);

        $final_data = array();
        if (mysqli_num_rows($currentTravelQuery) > 0) {
            while($row = mysqli_fetch_assoc($currentTravelQuery)){
                $final_data[] = $row;
            }
        }
        return $final_data;
    }
?>