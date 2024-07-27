<?php
include_once "../../../src/server/auth/index.php";
include_once "../../../src/server/utils.php";
include_once "../../../src/server/user/get.php";
include_once "../../../src/server/user/permission/get.php";
include_once "../../../src/server/user/type/get.php";

session_start();

if(!isset($_SESSION['email'])) {
    redirect("../../../../signin/");
}

$userPermission = getUserPermission($conn);

mysqli_next_result($conn);

$userType = getUserType($conn);

mysqli_next_result($conn);

$userInfo = getUserInfo($conn);

if (isset($userPermission) && count($userPermission) > 0) {
    foreach ($userPermission as $userPermissionCheck) {
        if($userPermissionCheck["permission_level"] > 0) {
            redirect("../../../../signin/");
        }
    }
}

if (isset($userType) && count($userType) > 0) {
    foreach ($userType as $userTypeCheck) {
        if($userTypeCheck["user_type"] != "admin") {
            redirect("../../../../signin/");
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">

    <title>PathPals - Admin Edit User</title>
    <link rel="icon" type="image/png" href="../../../src/assets/images/pathpals-logo-blue.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Mallanna&family=Manrope:wght@200..800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../../../src/styles/index.css">
    <link rel="stylesheet" href="../../profile/styles/index.css">
    <link rel="stylesheet" href="../../profile/styles/media-querys.css">
    <link rel="stylesheet" href="../../../src/styles/bottom-menu.css">
</head>

<body>
    
    <div class="background">
        <div class="banner"></div>

        <div class="edit-background">
            <div class="edit-mode">
                <h1>Modo de Edição Ativo!</h1>
                <p>Clique nas informações do seu perfil e escreva nelas para edita-las!</p>
            </div>
        </div>

        <?php 
            echo '<form action="../../../src/server/admin/users/update.php?user_email='. $userInfo["user_email"] .'" method="POST" enctype="application/x-www-form-urlencoded">';
        ?>
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

                            <?php echo '<input id="edit-username" type="text" name="new_username" minlenght="1" maxlength="23" placeholder="Escreva um novo Username..." value="'. $userInfo['user_username'] .'">'; ?>
                        </div>

                        <div class="error unvisibility" id="edit-username-error">
                            <p class="error-message"></p>
                        </div>
                    
                        <div class="name-background">
                            <?php echo '<input type="text" name="new_name" minlenght="1" maxlength="23" placeholder="Como te chamas? Ex: Manuel Ribeiro">'; ?>
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
                                    <?php echo '<input type="text" name="new_career" maxlength="30" placeholder="Você é o que? Ex: Aluno, Professor, Funcionário, etc..." value="'. $userInfo['user_career'] .'">'; ?>
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
                                    <?php echo '<input type="text" name="new_age" maxlength="2" placeholder="Quantos anos tens?" value="'. $userInfo['user_birthday'] .'">'; ?>
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
                                    <?php echo '<input type="text" name="new_class" maxlength="30" placeholder="Qual é a sua turma? Ex: 12ºA" value="'. $userInfo['user_class'] .'">'; ?>
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
                    
                                <div class="info-description-exception info-description-input-lock">
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
                                    <?php echo '<input id="edit-password" type="password" name="new_password" minlenght="1" maxlength="255" placeholder="Escreva uma nova Password para a sua conta" value="'. $userInfo['user_password'] .'">'; ?>
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
                                    <?php echo '<input id="edit-confirm-password" type="password" name="new_confirm_password" minlenght="1" maxlength="255" placeholder="Escreva uma nova Password para a sua conta" value="'. $userInfo['user_password'] .'">'; ?>
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
                    
                                <div class="info-description-exception info-description-input-lock">
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
                                    <?php echo '<input type="text" name="new_location" maxlength="255" placeholder="Vives aonde?" value="'. $userInfo['user_location'] .'">'; ?>
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
                                    <?php echo '<input type="text" name="new_aboutme" maxlength="30" placeholder="Fale um pouco sobre si!" value="'. $userInfo['user_about'] .'">'; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" id="save-btn">
                    <div class="save-btn">
                        <div class="save-container"></div>
                    </div>
                </button>
        </form>

            <div class="bottom-menu-admin">
                <div class="bottom-menu-container">
                    <div class="bottom-menu-position-admin">
                        <a href="../">
                            <div class="bottom-options">
                                <div class="manage-container"></div>
                            </div>
                        </a>

                        <a href="../../../signin/">
                            <div class="bottom-options">
                                <div class="exit-container"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../profile/scripts/form-validation.js"></script>
</body>
</html>