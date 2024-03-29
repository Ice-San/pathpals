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

    <title>PathPals - Solicitadas</title>

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
                <a href="./">Solicitadas</a>
                <a href="../offers">Ofertas</a>
                <a href="../orders">Pedidos</a>
            </div>
        </div>

        <div class="content">
            <div class="list">
                <div class="list-titles">
                    <div class="list-icon">
                        <div class="list-icon-my"></div>
                    </div>

                    <h1>Minhas Solicitações</h1>
                </div>

                <?php

                    $displayMyRequests = "CALL get_user_requests('". $_SESSION['email'] . "');";
                    $requestsMyQuery = mysqli_query($conn , $displayMyRequests);

                    if (mysqli_num_rows($requestsMyQuery) > 0) {
                        while($row = mysqli_fetch_assoc($requestsMyQuery)) {
                            echo "<div class=\"request-container\">
                            <div class=\"request-position-left\">
                                <div class=\"requests-user-info\">
                                    <div class=\"requests-icon\">
                                        <div class=\"requests-icon-container\"></div>
                                    </div>
        
                                    <div class=\"requests-user-text\">
                                        <h1>". $row["username"] ."</h1>
                                        <p>". $row["career"] . " - ". $row["class"] ."</p>
                                    </div>
                                </div>
        
                                <div class=\"requests-division\">
                                    <div class=\"requests-division-container\"></div>
                                </div>
        
                                <div class=\"requests-destinations\">
                                    <p><span>De: </span>" . $row["ride_from"] ."</p>
                                    <p><span>Para: </span>" . $row["ride_to"] ."</p>
                                </div>
                            </div>
        
                            <div class=\"request-position-right\">
                                <div class=\"requests-division\"></div>
        
                                <div class=\"requests-btn\">
                                    <div class=\"requests-btn-container\">
                                        <div class=\"requests-delete\"></div>
                                    </div>
                                </div>
                            </div>
                        </div>";
                        }
                    } else {
                        echo "<p class=\"error-message\">Ohh... parece que você não pediu nenhuma solicitação. :(</p>";
                    }

                    mysqli_free_result($requestsMyQuery);
                    mysqli_next_result($conn);
                ?>

                <div class="list-division"></div>

                <div class="list-titles">
                    <div class="list-icon">
                        <div class="list-icon-global"></div>
                    </div>

                    <h1>Solicitações Globais</h1>
                </div>

                <?php

                    $displayAllRequests = "SELECT * FROM all_requested_view;";
                    $requestsAllQuery = mysqli_query($conn , $displayAllRequests);

                    if (mysqli_num_rows($requestsAllQuery) > 0) {
                        while($row = mysqli_fetch_assoc($requestsAllQuery)) {
                            echo "<div class=\"request-container\">
                            <div class=\"request-position-left\">
                                <div class=\"requests-user-info\">
                                    <div class=\"requests-icon\">
                                        <div class=\"requests-icon-container\"></div>
                                    </div>
        
                                    <div class=\"requests-user-text\">
                                        <h1>". $row["username"] ."</h1>
                                        <p>". $row["career"] . " - ". $row["class"] ."</p>
                                    </div>
                                </div>
        
                                <div class=\"requests-division\">
                                    <div class=\"requests-division-container\"></div>
                                </div>
        
                                <div class=\"requests-destinations\">
                                    <p><span>De: </span>" . $row["ride_from"] ."</p>
                                    <p><span>Para: </span>" . $row["ride_to"] ."</p>
                                </div>
                            </div>
        
                            <div class=\"request-position-right\">
                                <div class=\"requests-division\"></div>
        
                                <div class=\"requests-btn\">
                                    <div class=\"requests-btn-container\">
                                        <div class=\"requests-check\"></div>
                                    </div>
                                </div>
                            </div>
                        </div>";
                        }
                    } else {
                        echo "<p class=\"error-message\">Parece que hoje ninguém precisa de transporte! :D</p>";
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

    <script src="../src/scripts/close-btn.js"></script>
    <script src="../src/scripts/add-request.js"></script>
    <script src="../src/scripts/add-request-container.js"></script>
</body>
</html>