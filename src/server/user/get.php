<?php
    function getUserInfo($conn) {
        $user_email = isset($_GET['user_email']) && !empty($_GET['user_email']) ? $_GET['user_email'] : $_SESSION['email'];

        $userInfo = "CALL get_user_info('". mysqli_real_escape_string($conn, $user_email) . "');";
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