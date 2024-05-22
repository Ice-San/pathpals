<?php
    include_once "../../src/server/auth/index.php";

    function getUserInfo($conn) {
        $userInfo = "CALL get_user_info('". $_SESSION['email'] . "');";
        $userInfoQuery = mysqli_query($conn, $userInfo);

        $final_data = array();
        if (mysqli_num_rows($userInfoQuery) > 0) {
            while($row = mysqli_fetch_assoc($userInfoQuery)){
                $final_data[] = $row;
            }
        }
        return $final_data[0];
    }
?>