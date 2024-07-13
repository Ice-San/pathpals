<?php
include_once "../src/server/auth/index.php";
include_once "../src/server/utils.php";

session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">

    <title>PathPals - SignIn</title>
    <link rel="icon" type="image/png" href="../src/assets/images/pathpals-logo-blue.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mallanna&family=Manrope:wght@200..800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../../src/styles/index.css">
    <link rel="stylesheet" href="./styles/index.css">
    <link rel="stylesheet" href="./styles/animations.css">
    <link rel="stylesheet" href="./styles/media-querys.css">
</head>

<body>
    
    <div class="background">
        <div class="top-circle-position">
            <div class="top-circle"></div>
        </div>
        
        <div class="bottom-circle-position">
            <div class="bottom-circle"></div>
        </div>
        
        <div class="mouse-circle">
            <div class="circle"></div>
        </div>

        <div class="background-container">
            <div class="back-btn">
                <div class="back-btn-container"></div>
            </div>

            <div class="center-signup">
                <div class="center-signup-content">
                    <div class="header">
                        <h1>Bem-vindo de volta!</h1>
                        <p>Estamos felizes por vos ver de novo!</p>
                    </div>

                    <div class="cars">
                        <div class="cars-container"></div>
                    </div>

                    <form action="../src/server/auth/signin.php" method="POST" enctype="application/x-www-form-urlencoded">
                        <div class="form-content form-content-effect">
                            <input id="email-input" type="email" name="email" placeholder="Email" maxlength="100" required>
                        </div>
                        <div class="form-error error-email unvisibility"></div>
                        <?php if(isset($_SESSION['error_email_matches'])) { echo "<div class='form-error error-email'>* ".$_SESSION['error_email_matches']."</div>"; } ?>

                        <div class="form-content form-content-effect password">
                            <input id="password-input" type="password" name="password" placeholder="Password" maxlength="255" required>

                            <div class="view-pass">
                                <div class="view-pass-container" id="password-view"></div>
                            </div>
                        </div>
                        <div class="form-error error-password unvisibility"></div>
                        <?php if(isset($_SESSION['error_password_matches'])) { echo "<div class='form-error error-email'>* ".$_SESSION['error_password_matches']."</div>"; } ?>

                        <div class="submit">
                            <p>Já tem uma conta? <a href="../signup/">Sign Up!</a></p>

                            <input type="submit" value="Sign In">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="./scripts/index.js"></script>
    <script src="./scripts/form-validation.js"></script>
</body>
</html>

<?php

session_unset();

?>