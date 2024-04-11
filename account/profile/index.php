<?php
include "../../src/server/auth.php";
include "../../src/server/utils.php";

session_start();

if(!isset($_SESSION['email'])) {
    redirect("../../../signin/");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">

    <title>PathPals - Profile</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Mallanna&family=Manrope:wght@200..800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../../src/styles/index.css">
    <link rel="stylesheet" href="./styles/index.css">
    <link rel="stylesheet" href="./styles/media-querys.css">
    <link rel="stylesheet" href="../../src/styles/bottom-menu.css">
</head>

<body>
    
    <div class="background">
        <div class="banner"></div>

        <div class="edit-background">
            <div class="edit">
                <div class="edit-container"></div>
            </div>
        </div>

        <div class="all-content">
            <div class="icon-background">
                <div class="icon">
                    <div class="icon-container"></div>
                </div>
            </div>

            <div class="content">
                <?php
                    include "../../src/server/user/user-info/get.php";
                ?>
            </div>

            <div class="bottom-menu">
                <div class="bottom-menu-container">
                    <div class="bottom-menu-position">
                        <a href="./">
                            <div class="bottom-options">
                                <div class="profile-container"></div>
                            </div>
                        </a>

                        <a href="../requests">
                            <div class="bottom-options">
                                <div class="lists-container"></div>
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
    </div>
</body>
</html>