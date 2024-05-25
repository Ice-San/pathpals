<?php
    include_once "../../auth/index.php";
    include_once "../../utils.php";

    function getCurrentTravel($conn) {
        $currentTravel = 'get_connections("'. $_SESSION['email'] . '")';
        $currentTravelQuery = mysqli_query($conn , $currentTravel);

        $final_data = array();
        if (mysqli_num_rows($currentTravelQuery) > 0) {
            while($row = mysqli_fetch_assoc($currentTravelQuery)){
                $final_data[] = $row;
            }
        }
        return $final_data;
    }
?>