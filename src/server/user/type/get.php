<?php
    include "../../src/server/auth.php";

    function getUserPermission($conn) {
        $userType = 'CALL get_user_permissions_level("'. $_SESSION['email'] . '")';
        $userTypeQuery = mysqli_query($conn, $userType);

        $final_data = array();
        if (mysqli_num_rows($userTypeQuery) > 0) {
            while($row = mysqli_fetch_assoc($userTypeQuery)){
                $final_data[] = $row;
            }
        }
        return $final_data;
    }
?>