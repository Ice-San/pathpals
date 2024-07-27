<?php
    include "../../src/server/auth.php";

    function getUserOffers($conn) {
        $userOffers = "CALL get_user_offers('". $_SESSION['email'] . "');";
        $userOffersQuery = mysqli_query($conn , $userOffers);

        $final_data = array();
        if (mysqli_num_rows($userOffersQuery) > 0) {
            while($row = mysqli_fetch_assoc($userOffersQuery)){
                $final_data[] = $row;
            }
        }
        return $final_data;
    }
?>