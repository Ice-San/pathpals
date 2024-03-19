<?php
include "../src/server/auth.php";

session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">

    <title>PathPals - SignUp</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mallanna&family=Manrope:wght@200..800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../../src/styles/index.css">
    <link rel="stylesheet" href="./styles/index.css">
    <link rel="stylesheet" href="../signin/styles/animations.css">
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
                        <h1>Vamos Inscrever-te!</h1>
                        <p>Venha juntar-se à nossa família!</p>
                    </div>

                    <div class="cars">
                        <div class="cars-container"></div>
                    </div>

                    <form action="../src/server/user/post.php" method="POST" enctype="application/x-www-form-urlencoded">
                        <div class="form-content form-content-effect form-content-txt-inputs">
                            <input id="username-input" type="text" name="username" placeholder="Username" maxlength="50" required> 
                        </div>
                        <div class="form-error error-username unvisibility"></div>

                        <div class="form-content form-content-effect form-content-txt-inputs">
                            <input id="email-input" type="email" name="email" placeholder="Email" maxlength="100" required>
                        </div>
                        <div class="form-error error-email unvisibility"></div>
                        <?php if(isset($_SESSION['error_email'])) { echo "<div class='form-error error-email'>* ".$_SESSION['error_email']."</div>"; } ?>

                        <div class="form-content form-content-effect form-content-txt-inputs">
                            <input id="institution-input" type="text" name="institution-code" placeholder="Código da Instituição" required>
                        </div>
                        <div class="form-error error-institution unvisibility"></div>

                        <div class="form-content form-content-effect password">
                            <input id="password-input" type="password" name="password" placeholder="Password" maxlength="255" required>

                            <div class="view-pass">
                                <div class="view-pass-container" id="password-view"></div>
                            </div>
                        </div>
                        <div class="form-error error-password unvisibility"></div>

                        <div class="submit">
                            <p>Tem uma conta? <a href="../signin/">Sign In!</a></p>
                            
                            <input type="submit" value="Sign Up">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../signin/scripts/index.js"></script>
    <script src="./scripts/form-validation.js"></script>
</body>
</html>

<?php

session_unset();

?>