<?php
include "../../src/server/auth.php";
include "../../src/server/utils.php";
include "../../src/server/user/info/get.php";

session_start();

if(!isset($_SESSION['email'])) {
    redirect("../../../signin/");
}

$userInfo = getUserInfo($conn);

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
                <!-- ====== Rodrigo was here (Start) ====== -->
                <div class="username-background">
                    <div class="username-position">
                        <div class="username">
                            <div class="username-container"></div>
                        </div>
                        <!-- NEW -->
                        <p><?php echo $userInfo['user_username']; ?></p>
                    </div>
                
                    <div class="name-background">
                        <!-- NEW -->
                        <p><?php echo $userInfo['first_name'] . ' ' . $userInfo['last_name']; ?></p>
                    </div>
                </div>
                
                <div class="info-background">
                    <div class="info-background-top">
                        <div class="info-content">
                            <div class="info-title">
                                <div class="info-icon">
                                    <div class="career-container"></div>
                                </div>
                
                                <h1>Profissão</h1>
                            </div>
                
                            <div class="info-description">
                                <!-- NEW -->
                                <?php echo isset($userInfo['user_career']) ? '<p>'. $userInfo['user_career'] . '</p>' : ''; ?>
                            </div>
                        </div>
                
                        <div class="info-content">
                            <div class="info-title">
                                <div class="info-icon">
                                    <div class="age-container"></div>
                                </div>
                
                                <h1>Idade</h1>
                            </div>
                
                            <div class="info-description">
                                <!-- NEW -->
                                <?php echo isset($userInfo['user_age']) ? '<p>'. $userInfo['user_age'] . '</p>' : ''; ?>
                            </div>
                        </div>
                
                        <div class="info-content">
                            <div class="info-title">
                                <div class="info-icon">
                                    <div class="class-container"></div>
                                </div>
                
                                <h1>Turma</h1>
                            </div>
                
                            <div class="info-description">
                                <!-- NEW -->
                                <?php echo isset($userInfo['user_class']) ? '<p>'. $userInfo['user_class'] . '</p>' : ''; ?>
                            </div>
                        </div>
                    </div>
                
                    <div class="info-background-bottom">
                        <div class="info-content">
                            <div class="info-title">
                                <div class="info-icon">
                                    <div class="school-container"></div>
                                </div>
                
                                <h1>Escola</h1>
                            </div>
                
                            <div class="info-description">
                                <p></p>
                            </div>
                        </div>
                
                        <div class="info-content">
                            <div class="info-title">
                                <div class="info-icon">
                                    <div class="location-container"></div>
                                </div>
                
                                <h1>Localização</h1>
                            </div>
                
                            <div class="info-description">
                                <!-- NEW -->
                                <?php echo isset($userInfo['user_location']) ? '<p>'. $userInfo['user_location'] . '</p>' : ''; ?>
                            </div>
                        </div>
                
                        <div class="info-content">
                            <div class="info-title">
                                <div class="info-icon">
                                    <div class="aboutme-container"></div>
                                </div>
                
                                <h1>Sobre Mim</h1>
                            </div>
                
                            <div class="info-description">
                                <!-- NEW -->
                                <?php echo isset($userInfo['user_about']) ? '<p>'. $userInfo['user_about'] . '</p>' : ''; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ====== Rodrigo was here (End) ====== -->
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