<?php
    include_once "../../src/server/auth/index.php";
    include_once "../../src/server/utils.php";
    include_once "../../src/server/user/permission/get.php";
    include_once "../../src/server/user/type/get.php";

    session_start();

    if(!isset($_SESSION['email'])) {
        redirect("../../../signin/");
    }

    $userPermission = getUserPermission($conn);

    mysqli_next_result($conn);

    $userType = getUserType($conn);

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
                <h1>87</h1>
                <p>Users</p>
            </div>

            <input type="text" id="search-bar" placeholder="Search">

            <div class="table">
                <div class="check-user">
                    <input type="checkbox">

                    <p>User</p>
                </div>

                <div class="forgot-pass">
                    <p>Recuperar</p>
                </div>

                <div class="delete-account">
                    <p>Apagar</p>
                </div>
            </div>

            <div class="table-extra">
                <div class="table-content-left-extra">
                    <input type="checkbox">

                    <div class="user-icon">
                        <div class="user-icon-container"></div>
                    </div>

                    <h1>IceSann_</h1>
                </div>

                <div class="table-content-middle-extra">
                    <a href="./">Recuperar Password</a>
                </div>

                <div class="table-content-right-extra">
                    <a href="./">Apagar Conta</a>
                </div>
            </div>
        </div>

        <div class="bottom-menu">
            <div class="bottom-menu-container">
                <div class="bottom-menu-position">
                    <a href="../profile/">
                        <div class="bottom-options">
                            <div class="manage-container"></div>
                        </div>
                    </a>

                    <a href="./">
                        <div class="bottom-options">
                            <div class="requests-container"></div>
                        </div>
                    </a>

                    <a href="./">
                        <div class="bottom-options">
                            <div class="offers-container"></div>
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