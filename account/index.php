<?php
include "../src/server/auth.php";
include "../src/server/utils.php";

session_start();

if(!isset($_SESSION['signin'])) {
    redirect("../../signin/");
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

    <link rel="stylesheet" href="../../src/styles/index.css">
    <link rel="stylesheet" href="./styles/index.css">
    <link rel="stylesheet" href="../../src/styles/bottom-menu.css">
    <link rel="stylesheet" href="./styles/form-list.css">
    <link rel="stylesheet" href="./styles/animations.css">
    <link rel="stylesheet" href="./styles/media-querys.css">
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
                <a href="">Ofertas</a>
                <a href="">Meus Pedidos</a>
            </div>
        </div>

        <div class="content">
            <div class="list"></div>

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

                        <a href="../signin/">
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

    <script src="./scripts/close-btn.js"></script>
    <script src="./scripts/add-request.js"></script>
    <script src="./scripts/add-request-container.js"></script>
</body>
</html>