<?php
    function getAllOffers($conn) {
        $displayAllOffers = 'CALL get_offers_from_institution("'. $_SESSION['email'] .'");';
        $offersAllQuery = mysqli_query($conn , $displayAllOffers);

        $final_data = array();
        if (mysqli_num_rows($offersAllQuery) > 0) {
            while($row = mysqli_fetch_assoc($offersAllQuery)){
                $final_data[] = $row;
            }
        }
        return $final_data;
    }
?>