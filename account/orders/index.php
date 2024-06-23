<?php
include_once "../../src/server/auth/index.php";
include_once "../../src/server/rides/travels/get.php";
include_once "../../src/server/rides/offers/user/get.php";
include_once "../../src/server/rides/requests/user/get.php";

session_start();

if(!isset($_SESSION['email'])) {
    redirect("../../../signin/");
}

$currentTravels = getCurrentTravel($conn);

mysqli_next_result($conn);

$userRequests = getUserRequests($conn);

mysqli_next_result($conn);

$userOffers = getUserOffers($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">

    <title>PathPals - Pedidos</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Mallanna&family=Manrope:wght@200..800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../src/styles/index.css">
    <link rel="stylesheet" href="../src/styles/banner.css">
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
                <a href="../offers">Ofertas</a>
                <a href="./">Pedidos</a>
            </div>
        </div>

        <div class="content">
            <div class="list">
                <div class="content-titles">
                    <div class="content-flex">
                        <div class="list-icon">
                            <div class="content-icon"></div>
                        </div>

                        <h1>A Decorrer</h1>
                    </div>

                    <?php
                        if (isset($currentTravels) && count($currentTravels) > 0) {
                            foreach ($currentTravels as $currentTravel) {
                                $rideId = $currentTravel["ride_id"];
                                $previousUrl = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                $returnUrl = basename(parse_url($previousUrl, PHP_URL_PATH));

                                $ride_start_datetime = $currentTravel['ride_start'];
                                $ride_start_timestamp = strtotime($ride_start_datetime);
                                $ride_end_datetime = $currentTravel['ride_end'];
                                $ride_end_timestamp = strtotime($ride_end_datetime);

                                if ($ride_start_timestamp !== false) {
                                    $ride_start_time = date('H\h:i', $ride_start_timestamp);
                                    $ride_start_date = date('d-m-Y', $ride_start_timestamp);
                                }

                                if ($ride_end_timestamp !== false) {
                                    $ride_end_time = date('H\h:i', $ride_end_timestamp);
                                }

                                echo '<div class="request-container">
                                        <div class="request-position-left">
                                            <div class="requests-user-info">
                                                <div class="requests-icon">
                                                    <div class="requests-icon-container"></div>
                                                </div>

                                                <div class="requests-user-text">
                                                    <h1>'. $currentTravel["driver_username"] .'</h1>
                                                </div>
                                            </div>

                                            <div class="requests-division">
                                                <div class="requests-division-container"></div>
                                            </div>

                                            <div class="requests-destinations">
                                                <p><span>De: </span>'. $currentTravel["ride_from"] .'</p>
                                                <p><span>Para: </span>'. $currentTravel["ride_to"] .'</p>
                                                <p><span>Data: </span>'. $ride_start_date .'</p>
                                                <p><span>Agendado: </span>'. $ride_start_time .' - '. $ride_end_time .'</p>
                                            </div>
                                        </div>

                                        <div class="request-position-right">
                                            <div class="requests-division"></div>

                                            <div class="requests-btn">
                                                <a href="../../src/server/rides/requests/delete.php?ride_id='. $rideId .'&previous_url='. $returnUrl .'">
                                                    <div class="requests-btn-container">
                                                        <div class="requests-delete"></div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>';
                            }
                        } else {
                            echo "<p class=\"error-message\">Ainda não aceitou nenhuma Solicitação ou Oferta.</p>";
                        }
                    ?>
                </div>

                <div class="content-division"></div>
            
                <div class="list-flex">
                    <div class="list-direction">
                        <div class="list-titles">
                            <div class="list-icon">
                                <div class="list-icon-my"></div>
                            </div>

                            <h1>Minhas Solicitações</h1>
                        </div>

                    <?php
                        if (isset($userRequests) && count($userRequests) > 0) {
                            foreach ($userRequests as $userRequest) {
                                $rideId = $userRequest["ride_id"];
                                $previousUrl = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                $returnUrl = basename(parse_url($previousUrl, PHP_URL_PATH));
    
                                echo '<div class="request-container">
                                        <div class="request-position-left">
                                            <div class="requests-user-info">
                                                <div class="requests-icon">
                                                    <div class="requests-icon-container"></div>
                                                </div>
    
                                                <div class="requests-user-text">
                                                    <h1>'. $userRequest["username"] .'</h1>
                                                    <p>'. $userRequest["career"] .' - '. $userRequest["class"] .'</p>
                                                </div>
                                            </div>
    
                                            <div class="requests-division">
                                                <div class="requests-division-container"></div>
                                            </div>
    
                                            <div class="requests-destinations">
                                                <p><span>De: </span>'. $userRequest["ride_from"] .'</p>
                                                <p><span>Para: </span>'. $userRequest["ride_to"] .'</p>
                                            </div>
                                        </div>
    
                                        <div class="request-position-right">
                                            <div class="requests-division"></div>
    
                                            <div class="requests-btn">
                                                <a href="../../src/server/rides/requests/delete.php?ride_id='. $rideId .'&previous_url='. $returnUrl .'">
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
                </div>

                    <div class="list-division"></div>

                    <div class="list-direction">
                        <div class="list-titles">
                            <div class="list-icon">
                                <div class="list-icon-global"></div>
                            </div>

                            <h1>Minhas Ofertas</h1>
                        </div>

                        <?php
                            if (isset($userOffers) && count($userOffers) > 0) {
                                foreach ($userOffers as $userOffer) {
                                    $rideId = $userOffer["ride_id"];
                                    $previousUrl = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                    $returnUrl = basename(parse_url($previousUrl, PHP_URL_PATH));

                                    $ride_start_datetime = $userOffer['ride_start'];
                                    $ride_start_timestamp = strtotime($ride_start_datetime);
                                    $ride_end_datetime = $userOffer['ride_end'];
                                    $ride_end_timestamp = strtotime($ride_end_datetime);

                                    if ($ride_start_timestamp !== false) {
                                        $ride_start_time = date('H\h:i', $ride_start_timestamp);
                                        $ride_start_date = date('d-m-Y', $ride_start_timestamp);
                                    }

                                    if ($ride_end_timestamp !== false) {
                                        $ride_end_time = date('H\h:i', $ride_end_timestamp);
                                    }

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
                                                    <p><span>Data: </span>'. $ride_start_date .'</p>
                                                    <p><span>Agendado: </span>'. $ride_start_time .' - '. $ride_end_time .'</p>
                                                </div>
                                            </div>

                                            <div class="request-position-right">
                                                <div class="requests-division"></div>

                                                <div class="requests-btn">
                                                    <a href="../../src/server/rides/offers/delete.php?ride_id='. $rideId .'&previous_url='. $returnUrl .'">
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
                    </div>
                </div>
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
                    <h1>Criar uma Solicitação</h1>
                </div>

                <form action="">
                    <div class="form-list-inputs">
                        <div class="form-list-input-title">
                            <div class="form-list-icon">
                                <div class="form-list-icon-container form-list-from"></div>
                            </div>

                            <h1>From:</h1>
                        </div>
                        <input type="text">

                        <div class="form-list-input-title">
                            <div class="form-list-icon">
                                <div class="form-list-icon-container form-list-to"></div>
                            </div>
                            
                            <h1>To:</h1>
                        </div>
                        <input type="text">
                    </div>
                </form>

                <div class="submit-btn">
                    <div class="submit-btn-container">
                        <p>Criar Solicitação</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>