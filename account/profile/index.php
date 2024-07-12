<?php
include_once "../../src/server/auth/index.php";
include_once "../../src/server/utils.php";
include_once "../../src/server/user/get.php";

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
            <div class="edit-mode edit-opacity">
                <h1>Modo de Edição Ativo!</h1>
                <p>Clique nas informações do seu perfil e escreva nelas para edita-las!</p>
            </div>

            <div class="edit">
                <div class="edit-container edit-image"></div>
            </div>
        </div>

        <form action="../../src/server/user/update.php" method="POST" enctype="application/x-www-form-urlencoded">
            <div class="all-content">
                <div class="unsee-banner">
                    <div class="icon">
                        <div class="icon-container"></div>
                    </div>
                </div>

                <div class="content">
                    <div class="username-background">
                        <div class="username-position">
                            <div class="username">
                                <div class="username-container"></div>
                            </div>
                            <p><?php echo $userInfo['user_username']; ?></p>
                            <?php echo '<input id="edit-username" type="text" name="new_username" class="unvisibility" minlenght="1" maxlength="23" placeholder="Escreva um novo Username..." value="'. $userInfo['user_username'] .'">'; ?>
                        </div>

                        <div class="error unvisibility" id="edit-username-error">
                            <p class="error-message"></p>
                        </div>
                    
                        <div class="name-background">
                            <p><?php echo $userInfo['first_name'] . ' ' . $userInfo['last_name']; ?></p>
                            <?php echo '<input type="text" name="new_name" class="unvisibility" minlenght="1" maxlength="23" placeholder="Como te chamas? Ex: Manuel Ribeiro">'; ?>
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
                                    <?php echo isset($userInfo['user_career']) ? '<p>'. $userInfo['user_career'] . '</p>' : '<p></p>'; ?>
                                    <?php echo '<input type="text" name="new_career" class="unvisibility" maxlength="30" placeholder="Você é o que? Ex: Aluno, Professor, Funcionário, etc..." value="'. $userInfo['user_career'] .'">'; ?>
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
                                    <?php echo isset($userInfo['user_birthday']) ? '<p>'. $userInfo['user_birthday'] . '</p>' : '<p></p>'; ?>
                                    <?php echo '<input type="text" name="new_age" class="unvisibility" maxlength="2" placeholder="Quantos anos tens?" value="'. $userInfo['user_birthday'] .'">'; ?>
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
                                    <?php echo isset($userInfo['user_class']) ? '<p>'. $userInfo['user_class'] . '</p>' : '<p></p>'; ?>
                                    <?php echo '<input type="text" name="new_class" class="unvisibility" maxlength="30" placeholder="Qual é a sua turma? Ex: 12ºA" value="'. $userInfo['user_class'] .'">'; ?>
                                </div>
                            </div>
                        </div>
                    
                        <div class="info-background-bottom">
                            <div class="info-content">
                                <div class="info-title">
                                    <div class="info-icon">
                                        <div class="email-container"></div>
                                    </div>
                    
                                    <h1>Email</h1>
                                </div>
                    
                                <div class="info-description-exception">
                                    <?php echo isset($userInfo['user_email']) ? '<p>'. $userInfo['user_email'] . '</p>' : '<p></p>'; ?>
                                </div>
                            </div>

                            <div class="info-content">
                                <div class="info-title">
                                    <div class="info-icon">
                                        <div class="password-container"></div>
                                    </div>
                    
                                    <h1>Password</h1>
                                </div>
                    
                                <div class="info-description">
                                    <p>******</p>
                                    <?php echo '<input id="edit-password" type="password" name="new_password" minlenght="1" maxlength="255" class="unvisibility" placeholder="Escreva uma nova Password para a sua conta" value="'. $userInfo['user_password'] .'">'; ?>
                                </div>

                                <div class="error unvisibility" id="edit-password-error">
                                    <p class="error-message"></p>
                                </div>
                            </div>

                            <div class="info-content">
                                <div class="info-title">
                                    <div class="info-icon">
                                        <div class="password-container"></div>
                                    </div>
                    
                                    <h1>Confirm Password</h1>
                                </div>
                    
                                <div class="info-description">
                                    <p>******</p>
                                    <?php echo '<input id="edit-confirm-password" type="password" name="new_confirm_password" minlenght="1" maxlength="255" class="unvisibility" placeholder="Escreva uma nova Password para a sua conta" value="'. $userInfo['user_password'] .'">'; ?>
                                </div>

                                <div class="error unvisibility" id="edit-confirm-password-error">
                                    <p class="error-message"></p>
                                </div>
                            </div>

                            <div class="info-content">
                                <div class="info-title">
                                    <div class="info-icon">
                                        <div class="school-container"></div>
                                    </div>
                    
                                    <h1>Escola</h1>
                                </div>
                    
                                <div class="info-description-exception">
                                    <?php echo isset($userInfo['institution_name']) ? '<p>'. $userInfo['institution_name'] . '</p>' : '<p></p>'; ?>
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
                                    <?php echo isset($userInfo['user_location']) ? '<p>'. $userInfo['user_location'] . '</p>' : '<p></p>'; ?>
                                    <?php echo '<input type="text" name="new_location" maxlength="255" class="unvisibility" placeholder="Vives aonde?" value="'. $userInfo['user_location'] .'">'; ?>
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
                                    <?php echo isset($userInfo['user_about']) ? '<p>'. $userInfo['user_about'] . '</p>' : '<p></p>'; ?>
                                    <?php echo '<input type="text" name="new_aboutme" maxlength="30" class="unvisibility" placeholder="Fale um pouco sobre si!" value="'. $userInfo['user_about'] .'">'; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="unvisibility" id="save-btn">
                    <div class="save-btn">
                        <div class="save-container"></div>
                    </div>
                </button>
        </form>

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

    <script src="./scripts/edit-mode.js"></script>
    <script src="./scripts/form-validation.js"></script>
</body>
</html>