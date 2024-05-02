<?php
include "../../src/server/auth.php";
include "../../src/server/utils.php";
include "../../src/server/rides/offers/user/get.php";
include "../../src/server/rides/offers/get.php";

session_start();

if(!isset($_SESSION["email"])) {
    redirect("../../../signin/");
}

$userOffers = getUserOffers($conn);

mysqli_next_result($conn);

$allOffers = getAllOffers($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">

    <title>PathPals - Ofertas</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Mallanna&family=Manrope:wght@200..800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../src/styles/index.css">
    <link rel="stylesheet" href="../src/styles/form-list.css">
    <link rel="stylesheet" href="../src/styles/animations.css">
    <link rel="stylesheet" href="../src/styles/requests-cards.css">
    <link rel="stylesheet" href="../src/styles/media-querys.css">
    <link rel="stylesheet" href="../../../src/styles/index.css">
    <link rel="stylesheet" href="../../../src/styles/bottom-menu.css">
    <link rel="stylesheet" href="./styles/highlight-text.css">
</head>

<body>

    <div class="background">
        <div class="banner">
            <div class="banner-container">
                <div class="banner-overlay">
                    <h1>PathPals</h1>
                </div>
            </div>
        </div>

        <div class="menu">
            <div class="menu-container">
                <a href="../requests">Solicitadas</a>
                <a href="./">Ofertas</a>
                <a href="../orders">Pedidos</a>
            </div>
        </div>

        <div class="content">
            <div class="list">
                <div class="list-titles">
                    <div class="list-icon">
                        <div class="list-icon-my"></div>
                    </div>

                    <h1>Minhas Ofertas</h1>
                </div>

                <?php
                    if (isset($userOffers) && count($userOffers) > 0) {
                        foreach ($userOffers as $userOffer) {
                            echo '<div class="request-container">
                                    <div class="request-position-left">
                                        <div class="requests-user-info">
                                            <div class="requests-icon">
                                                <div class="requests-icon-container"></div>
                                            </div>

                                            <div class="requests-user-text">
                                                <h1>'. $userOffer["username"] .'</h1>
                                                <p>'. $userOffer["career"] .' - '. $userOffer["class"] .'</p>
                                            </div>
                                        </div>

                                        <div class="requests-division">
                                            <div class="requests-division-container"></div>
                                        </div>

                                        <div class="requests-destinations">
                                            <p><span>De: </span>'. $userOffer["ride_from"] .'</p>
                                            <p><span>Para: </span>'. $userOffer["ride_to"] .'</p>
                                        </div>
                                    </div>

                                    <div class="request-position-right">
                                        <div class="requests-division"></div>

                                        <div class="requests-btn">
                                            <a href="./">
                                                <div class="requests-btn-container">
                                                    <div class="requests-delete"></div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>';
                        }
                    } else {
                        echo "<p class=\"error-message\">Parece que hoje ninguém consegue oferecer transporte... :(</p>";
                    }
                ?>

                <div class="list-division"></div>

                <div class="list-titles">
                    <div class="list-icon">
                        <div class="list-icon-global"></div>
                    </div>

                    <h1>Ofertas Globais</h1>
                </div>

                <?php
                    if (isset($allOffers) && count($allOffers) > 0) {
                        foreach ($allOffers as $allOffer) {
                            echo '<div class="request-container">
                                    <div class="request-position-left">
                                        <div class="requests-user-info">
                                            <div class="requests-icon">
                                                <div class="requests-icon-container"></div>
                                            </div>

                                            <div class="requests-user-text">
                                                <h1>'. $allOffer["username"] .'</h1>
                                                <p>'. $allOffer["career"] .' - '. $allOffer["class"] .'</p>
                                            </div>
                                        </div>

                                        <div class="requests-division">
                                            <div class="requests-division-container"></div>
                                        </div>

                                        <div class="requests-destinations">
                                            <p><span>De: </span>'. $allOffer["ride_from"] .'</p>
                                            <p><span>Para: </span>'. $allOffer["ride_to"] .'</p>
                                        </div>
                                    </div>

                                    <div class="request-position-right">
                                        <div class="requests-division"></div>

                                        <div class="requests-btn">
                                            <div class="requests-btn-container">
                                                <div class="requests-delete"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                        }
                    } else {
                        echo "<p class=\"error-message\">Parece que hoje ninguém consegue oferecer transporte... :(</p>";
                    }
                ?>
            </div>

            <div class="add-request">
                <div class="add-request-container"></div>
            </div>

            <div class="bottom-menu">
                <div class="bottom-menu-container">
                    <div class="bottom-menu-position">
                        <a href="../profile/">
                            <div class="bottom-options">
                                <div class="profile-container"></div>
                            </div>
                        </a>

                        <a href="./">
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

    <div class="form-list unvisibility">
        <div class="form-list-position">
            <div class="form-list-container unvisibility">
                <div class="close-btn">
                    <div class="close-btn-position">
                        <div class="close-btn-container"></div>
                    </div>
                </div>

                <div class="form-list-title">
                    <h1>Criar uma Oferta</h1>
                </div>

                <form action="../../src/server/rides/offers/post.php" method="POST" enctype="application/x-www-form-urlencoded">
                    <div class="form-list-inputs">
                        <div class="form-list-input-title">
                            <div class="form-list-icon">
                                <div class="form-list-icon-container form-list-from"></div>
                            </div>

                            <h1>De:</h1>
                        </div>
                        <input id="tripFrom" type="text" name="offerFrom" maxlength="100" required>
                        <div class="error-input">
                            <div class="error-input-message tripFrom unvisibility"></div>
                        </div>

                        <div class="form-list-input-title">
                            <div class="form-list-icon">
                                <div class="form-list-icon-container form-list-to"></div>
                            </div>
                            
                            <h1>Para:</h1>
                        </div>
                        <input id="tripTo" type="text" name="offerTo" maxlength="100" required>
                        <div class="error-input">
                            <div class="error-input-message tripTo unvisibility"></div>
                        </div>

                        <div class="form-list-dates">
                            <div class="form-list-date">
                                <div class="form-list-input-title">
                                    <div class="form-list-icon">
                                        <div class="form-list-icon-container form-list-start"></div>
                                    </div>
                                    
                                    <h1>Começa:</h1>
                                </div>
                                <?php 
                                    $minTimeDate = date("Y-m-d");
                                    $minTimeHour = date("H:i");
                                    echo '<input id="tripAt" type="datetime-local" name="offerAt" maxlength="100" required value="'. $minTimeDate .'T'. $minTimeHour .'" min="'. $minTimeDate .'T'. $minTimeHour .'" max="'. $minTimeDate .'"T23:59" />';
                                ?>
                            </div>

                            <div class="form-list-date">
                                <div class="form-list-input-title">
                                    <div class="form-list-icon">
                                        <div class="form-list-icon-container form-list-end"></div>
                                    </div>
                                    
                                    <h1>Termina:</h1>
                                </div>
                                <?php 
                                    $timestamp = time();
                                    $timestampNextWeek = $timestamp + (7 * 24 * 60 * 60);
                                    $dateNextWeek = date("Y-m-d", $timestampNextWeek);
                                    echo '<input id="timeToBtn" type="datetime-local" name="offerToTime" maxlength="100" required value="'. $minTimeDate .'T'. $minTimeHour .'" min="'. $minTimeDate .'T'. $minTimeHour .'" max="'. $dateNextWeek .'T23:59" />';
                                ?>
                            </div>

                            <div class="submit-btn">
                                <input type="submit" value="Criar Oferta">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../src/scripts/close-btn.js"></script>
    <script src="../src/scripts/add-request.js"></script>
    <script src="../src/scripts/add-request-container.js"></script>
    <script src="../src/scripts/form-validation.js"></script>
</body>
</html>