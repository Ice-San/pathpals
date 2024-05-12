<?php
    

    function getUserPermission($conn) {
        $userPermission = 'CALL get_user_permissions_level("'. $_SESSION['email'] . '")';
        $userPermissionQuery = mysqli_query($conn, $userPermission);

        $final_data = array();
        if (mysqli_num_rows($userPermissionQuery) > 0) {
            while($row = mysqli_fetch_assoc($userPermissionQuery)){
                $final_data[] = $row;
            }
        }
        return $final_data;
    }
?>