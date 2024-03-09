<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">

    <title>PathPals - SignUp</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mallanna&family=Manrope:wght@200..800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../../styles/index.css">
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
                        <h1>Let's Sign You Up!</h1>
                        <p>Come and join our family!</p>
                    </div>

                    <div class="car">
                        <div class="car-container"></div>
                    </div>

                    <form action="">
                        <div class="form-content form-content-effect form-content-txt-inputs">
                            <input type="text" placeholder="Username">
                        </div>

                        <div class="form-content form-content-effect form-content-txt-inputs">
                            <input type="email" placeholder="Email">
                        </div>

                        <div class="form-content form-content-effect form-content-txt-inputs">
                            <input type="text" placeholder="Institution Code">
                        </div>

                        <div class="form-content form-content-effect password">
                            <input id="password-input" type="password" placeholder="Password">

                            <div class="view-pass">
                                <div class="view-pass-container" id="password-view"></div>
                            </div>
                        </div>

                        <div class="submit">
                            <p>Do you have an account? <a href="../signin/">Sign In!</a></p>

                            <input type="button" value="Sign Up">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../signin/scripts/index.js"></script>
</body>
</html>