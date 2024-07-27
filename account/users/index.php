<?php
    include_once "../../src/server/auth/index.php";
    include_once "../../src/server/utils.php";
    include_once "../../src/server/user/permission/get.php";
    include_once "../../src/server/user/type/get.php";
    include_once "../../src/server/user/get.php";
    include_once "../../src/server/admin/users/get.php";
    include_once "../../src/server/admin/users/post.php";

    session_start();

    if(!isset($_SESSION['email'])) {
        redirect("../../../signin/");
    }

    $userPermission = getUserPermission($conn);

    mysqli_next_result($conn);

    $userType = getUserType($conn);

    mysqli_next_result($conn);

    $allUsersInformations = getAllUserInfo($conn);

    $allUsersInfoCount = $allUsersInformations['count_users'];
    $allUsersInfoDatas = $allUsersInformations['data'];

    mysqli_next_result($conn);

    $allUsersInfoBySearch = getAllUserInfoBySearch($conn);

    $allUsersInfoBySearchDatas = $allUsersInfoBySearch['data'];

    if (isset($userPermission) && count($userPermission) > 0) {
        foreach ($userPermission as $userPermissionCheck) {
            if($userPermissionCheck["permission_level"] > 0) {
                redirect("../../../signin/");
            }
        }
    }
    
    if (isset($userType) && count($userType) > 0) {
        foreach ($userType as $userTypeCheck) {
            if($userTypeCheck["user_type"] != "admin") {
                redirect("../../../signin/");
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">

    <title>PathPals - Manage Users</title>
    <link rel="icon" type="image/png" href="../../src/assets/images/pathpals-logo-blue.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Mallanna&family=Manrope:wght@200..800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./styles/index.css">
    <link rel="stylesheet" href="./styles/media-querys.css">
    <link rel="stylesheet" href="../src/styles/banner.css">
    <link rel="stylesheet" href="../../src/styles/index.css">
    <link rel="stylesheet" href="../../src/styles/bottom-menu.css">
</head>

<body>
    
    <div class="background">
        <div class="banner">
            <div class="banner-container">
                <div class="banner-overlay">
                    <h1>PathPals</h1>
                    <p>Admin Panel</p>
                </div>
            </div>
        </div>

        <div class="manage-background">
            <div class="data-count">
                <?php 
                    echo "<h1>". $allUsersInfoCount ."</h1>";
                ?>
                <p>Users</p>
            </div>

            <form action="./" method="POST" enctype="application/x-www-form-urlencoded">
                <div class="search-bar">
                    <button type="submit">
                        <div class="search-icon">
                            <div class="search-icon-container"></div>
                        </div>
                    </button>

                    <input type="text" id="search-bar" name="adminSearch" placeholder="Procure pelo username ou email...">
                </div>
            </form>

            <ul>
                <li class="header-list">
                    <span>User</span>
                    <span>Perfil</span>
                    <span>Conta</span>
                </li>

                <?php
                    if (!isset($allUsersInfoBySearch)) {
                        if (isset($allUsersInfoDatas) && count($allUsersInfoDatas) > 0) {
                            foreach ($allUsersInfoDatas as $allUsersInfoData) {
                                $userEmail = $allUsersInfoData["email"];
                                $previousUrl = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                $returnUrl = basename(parse_url($previousUrl, PHP_URL_PATH));

                                echo '<li class="result-list">
                                        <span>
                                            <div class="user-icon">
                                                    <div class="user-icon-container"></div>
                                            </div>
                                            <p>'. $allUsersInfoData["username"] .'</p>
                                        </span>
                                        <span><a href="./edit/?user_email='. $userEmail .'">Editar</a></span>
                                        <span class="delete-option"><a href="../../src/server/user/delete.php?user_email='. $userEmail .'&previous_url='. $returnUrl .'">Apagar</a></span>
                                    </li>';
                            }
                        } else {
                            echo "<p class=\"error-message\">Parece que a instituição ainda não têm utilizadores... :(</p>";
                        }
                    } else {
                        if (isset($allUsersInfoBySearchDatas) && count($allUsersInfoBySearchDatas) > 0) {
                            foreach ($allUsersInfoBySearchDatas as $allUsersInfoBySearchData) {
                                $userEmail = $allUsersInfoBySearchData["email"];
                                $previousUrl = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                $returnUrl = basename(parse_url($previousUrl, PHP_URL_PATH));

                                echo '<li class="result-list">
                                        <span>
                                            <div class="user-icon">
                                                    <div class="user-icon-container"></div>
                                            </div>
                                            <p>'. $allUsersInfoBySearchData["username"] .'</p>
                                        </span>
                                        <span><a href="./edit/?user_email='. $userEmail .'">Editar</a></span>
                                        <span class="delete-option"><a href="../../src/server/user/delete.php?user_email='. $userEmail .'&previous_url='. $returnUrl .'">Apagar</a></span>
                                    </li>';
                            }
                        } else {
                            echo "<p class=\"error-message\">Parece que a instituição ainda não têm utilizadores... :(</p>";
                        }
                    }
                ?>

            </ul>
        </div>

        <div class="bottom-menu-admin">
            <div class="bottom-menu-container">
                <div class="bottom-menu-position-admin">
                    <a href="./">
                        <div class="bottom-options">
                            <div class="manage-container"></div>
                        </div>
                    </a>

                    <a href="../../signin/">
                        <div class="bottom-options">
                            <div class="exit-container"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="./scripts/check.js"></script>
    <script src="./scripts/search.js"></script>
</body>
</html>