<?php
    function getAllUserInfoBySearch($conn) {

        if (isset($_POST['adminSearch'])) { $userSearch = "CALL get_all_users_info('". $_SESSION['email'] ."', '".  $_POST['adminSearch'] ."');"; }
        if (!isset($_POST['adminSearch'])) { $userSearch = "CALL get_all_users_info('". $_SESSION['email'] ."', '');"; }
        $userSearchQuery = mysqli_query($conn, $userSearch);

        $final_data = array();

        $num_rows = mysqli_num_rows($userSearchQuery);
        if ($num_rows > 0) {
            while($row = mysqli_fetch_assoc($userSearchQuery)){
                $final_data[] = $row;
            }
        }
        return array('count_users' => $num_rows, 'data' => $final_data);
    }
?>