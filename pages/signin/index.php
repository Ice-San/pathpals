<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">

    <title>PathPals - SignIn</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mallanna&family=Manrope:wght@200..800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../../styles/index.css">
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

                    <div class="car">
                        <div class="car-container"></div>
                    </div>

                    <form action="">
                        <div class="form-content form-content-effect">
                            <input type="email" placeholder="Email" maxlength="100" required>
                        </div>

                        <div class="form-content form-content-effect password">
                            <input id="password-input" type="password" placeholder="Password" maxlength="255" required>

                            <div class="view-pass">
                                <div class="view-pass-container" id="password-view"></div>
                            </div>
                        </div>

                        <div class="submit">
                            <p>Já tem uma conta? <a href="../signup/">Sign Up!</a></p>

                            <input type="button" value="Sign In">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="./scripts/index.js"></script>
</body>
</html>