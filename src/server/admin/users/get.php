<?php
    function getAllUserInfo($conn) {

        $allUserInfo = "CALL get_all_users_info('". $_SESSION['email'] ."', '');";
        $allUserInfoQuery = mysqli_query($conn, $allUserInfo);

        $final_data = array();

        $num_rows = mysqli_num_rows($allUserInfoQuery);
        if ($num_rows > 0) {
            while($row = mysqli_fetch_assoc($allUserInfoQuery)){
                $final_data[] = $row;
            }
        }
        return array('count_users' => $num_rows, 'data' => $final_data);
    }
?>