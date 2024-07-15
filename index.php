<?php
    include_once "./src/server/auth/index.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">

    <title>PathPals - Home</title>
    <link rel="icon" type="image/png" href="./src/assets/images/pathpals-logo-blue.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Mallanna&family=Manrope:wght@200..800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./src/styles/index.css">
    <link rel="stylesheet" href="./src/styles/hero.css">
    <link rel="stylesheet" href="./src/styles/introduction.css">
    <link rel="stylesheet" href="./src/styles/profile.css">
    <link rel="stylesheet" href="./src/styles/info.css">
    <link rel="stylesheet" href="./src/styles/call-to-action.css">
    <link rel="stylesheet" href="./src/styles/footer.css">
    <link rel="stylesheet" href="./src/styles/media-querys.css">
</head>

<body>
    
    <div class="background">
        <div class="background-container">
            <div class="background-overlay">
                <div class="signup-btn-position">
                    <a href="./">
                        <div class="pp-logo">
                            <div class="pp-logo-container"></div>
                        </div>
                    </a>

                    <a href="./signup">
                        <div class="signup-btn">
                            <p>Sign Up</p>
                        </div>
                    </a>
                </div>

                <div class="text-image">
                    <div class="title">
                        <h1>PathPals</h1>
                    </div>

                    <div class="persons-position">
                        <div class="persons">
                            <div class="persons-container"></div>
                        </div>
                    </div>

                    <div class="arrow-down-background">
                        <h1>Desça para baixo!</h1>

                        <div class="arrow">
                            <div class="arrow-container"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="info" id="about">
        <div class="info-items">
            <div class="info-img info-first-item-before" id="firstImg">
                <div class="info-container info1"></div>
            </div>

            <h1 id="firstText">SOLICITE TRANSPORTE PARA A ESCOLA!</h1>
        </div>

        <div class="info-items info-reverse">
            <div class="info-img info-second-item-before" id="secondImg">
                <div class="info-container info2"></div>
            </div>

            <h1 id="secondText">AGUARDE A CONFIRMAÇÃO DA ESCOLA...</h1>
        </div>

        <div class="info-items info-column">
            <div class="info-img info-three-item-before" id="thirdImg" >
                <div class="info-container info3"></div>
            </div>

            <div class="info-final">
                <div class="info-wow">
                    <div class="wow wow-left info-wow-item-before">
                        <div class="wow-container"></div>
                    </div>

                    <div class="wow wow-right info-wow-item-before">
                        <div class="wow-container"></div>
                    </div>
                </div>
                
                <h1 id="thirdText" class="third-text-desappears">VIAGEM FEITA!</h1>
            </div>
        </div>
    </div>

    <div class="profile-backgroud" id="profile">
        <div class="profile-container">
            <div class="profile-overlay">
                <div class="perfil-config-top-title">
                    <h1>CONFIGURE O SEU PERFIL!!</h1>
                </div>

                <div class="profile-flex">
                    <div class="perfil-info">
                        <div class="perfil-banner">
                            <div class="perfil-round">
                                <div class="perfil-round-container"></div>
                            </div>

                            <div class="perfil-icon-position">
                                <div class="perfil-icon">
                                    <div class="icon-container"></div>
                                </div>
                            </div>
                        </div>

                        <div class="perfil-content">
                            <div class="perfil-text">
                                <div class="perfil-title">
                                    <div class="perfil-title-icon">
                                        <div class="perfil-title-icon-container perfil-username"></div>
                                    </div>

                                    <div class="perfil-title-text">
                                        <h1>Username</h1>
                                    </div>
                                </div>

                                <p id="perfil-username-text">Roxas340</p>
                            </div>

                            <div class="perfil-text-flex">
                                <div class="perfil-text">
                                    <div class="perfil-title">
                                        <div class="perfil-title-icon">
                                            <div class="perfil-title-icon-container perfil-name"></div>
                                        </div>

                                        <div class="perfil-title-text">
                                            <h1>Nome</h1>
                                        </div>
                                    </div>

                                    <p id="perfil-name-text">Alberto</p>
                                </div>

                                <div class="perfil-text">
                                    <div class="perfil-title">
                                        <div class="perfil-title-icon">
                                            <div class="perfil-title-icon-container perfil-name"></div>
                                        </div>

                                        <div class="perfil-title-text">
                                            <h1>Apelido</h1>
                                        </div>
                                    </div>

                                    <p id="perfil-apelido-text">Dias</p>
                                </div>
                            </div>

                            <div class="perfil-text-flex">
                                <div class="perfil-text">
                                    <div class="perfil-title">
                                        <div class="perfil-title-icon">
                                            <div class="perfil-title-icon-container perfil-career"></div>
                                        </div>

                                        <div class="perfil-title-text">
                                            <h1>Carreira</h1>
                                        </div>
                                    </div>

                                    <p id="perfil-career-text">Aluno</p>
                                </div>

                                <div class="perfil-text">
                                    <div class="perfil-title">
                                        <div class="perfil-title-icon">
                                            <div class="perfil-title-icon-container perfil-class"></div>
                                        </div>

                                        <div class="perfil-title-text">
                                            <h1>Turma</h1>
                                        </div>
                                    </div>

                                    <p id="perfil-class-text">12ºA</p>
                                </div>
                            </div>

                            <div class="perfil-text-last">
                                <div class="perfil-title">
                                    <div class="perfil-title-icon">
                                        <div class="perfil-title-icon-container perfil-sobremim"></div>
                                    </div>

                                    <div class="perfil-title-text">
                                        <h1>Sobre Mim</h1>
                                    </div>
                                </div>

                                <p id="perfil-sobremim-text">Eu amo olhar para as estrelas! E tu? O que achas das estrelas? :0</p>
                            </div>
                        </div>
                    </div>

                    <div class="perfil-info">
                        <div class="perfil-config-title">
                            <p>Config Perfil</p>
                        </div>

                        <div class="perfil-text-config">
                            <div class="perfil-title-config">
                                <div class="perfil-title-icon-config perfil-config-username">
                                    <div class="perfil-title-icon-container perfil-username"></div>
                                </div>

                                <div class="perfil-title-text-config perfil-config-username">
                                    <h1>Username</h1>
                                </div>
                            </div>

                            <input type="text" maxlength="21" placeholder="Escreva o seu username..." id="input-username">
                        </div>

                        <div class="perfil-text-config">
                            <div class="perfil-title-config">
                                <div class="perfil-title-icon-config">
                                    <div class="perfil-title-icon-container perfil-name"></div>
                                </div>

                                <div class="perfil-title-text-config">
                                    <h1>Nome</h1>
                                </div>
                            </div>

                            <input type="text" maxlength="11" placeholder="Escreva o seu nome..." id="input-name">
                        </div>

                        <div class="perfil-text-config">
                            <div class="perfil-title-config">
                                <div class="perfil-title-icon-config">
                                    <div class="perfil-title-icon-container perfil-name"></div>
                                </div>

                                <div class="perfil-title-text-config">
                                    <h1>Apelido</h1>
                                </div>
                            </div>

                            <input type="text" maxlength="11" placeholder="Escreva o seu apelido..." id="input-apelido">
                        </div>

                        <div class="perfil-text-config">
                            <div class="perfil-title-config">
                                <div class="perfil-title-icon-config">
                                    <div class="perfil-title-icon-container perfil-career"></div>
                                </div>

                                <div class="perfil-title-text-config">
                                    <h1>Carreira</h1>
                                </div>
                            </div>

                            <input type="text" maxlength="11" placeholder="Ex: Aluno, Professor, etc..." id="input-career">
                        </div>

                        <div class="perfil-text-config">
                            <div class="perfil-title-config">
                                <div class="perfil-title-icon-config">
                                    <div class="perfil-title-icon-container perfil-class"></div>
                                </div>

                                <div class="perfil-title-text-config">
                                    <h1>Turma</h1>
                                </div>
                            </div>

                            <input type="text" maxlength="11" placeholder="Ex: 12ºA, 9ºBE, etc..." id="input-class">
                        </div>

                        <div class="perfil-text-config perfil-text-config-last">
                            <div class="perfil-title-config">
                                <div class="perfil-title-icon-config">
                                    <div class="perfil-title-icon-container perfil-sobremim"></div>
                                </div>

                                <div class="perfil-title-text-config">
                                    <h1>Sobre Mim</h1>
                                </div>
                            </div>

                            <input type="text" maxlength="21" placeholder="Ex: Eu amo flores..." id="input-sobremim">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="introduction" id="extras">
        <div class="ping">
            <div class="ping-text">
                <h1>Seja Notificado,</h1>
                <p>Quando ofertas ou solicitações forem criadas!</p>
            </div>

            <div class="ping-img">
                <div class="ping-img-container ping-icon"></div>
            </div>
        </div>

        <div class="ping ping-2">
            <div class="ping-img-2">
                <div class="ping-img-container route"></div>
            </div>

            <div class="ping-text ping-text-2">
                <h1>Peça por Ajuda!</h1>
                <p>Se algo aparentemente perigoso acontecer durante a viagem, alerte a sua instituição de ensino com apenas um botão!</p>
            </div>
        </div>

        <div class="ping">
            <div class="ping-text ping-text-3">
                <h1>Vincule a sua conta,</h1>
                <p>A um estabelecimento de ensino, para que possa beneficiar do PathPals!</p>
            </div>

            <div class="ping-img-3">
                <div class="ping-img-container signin"></div>
            </div>
        </div>
    </div>

    <div class="calltoaction">
        <div class="calltoaction-gif">
            <div class="calltoaction-container"></div>
        </div>

        <div class="calltoaction-content">
            <h1>Nunca mais chegue atrasado!</h1>

            <a href="./signup">
                <div class="signup-btn2">
                    <p>Sign Up</p>

                    <div class="arrow-right">
                        <div class="arrow-right-container"></div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="footer">
        <div class="footer-texts">
            <h1>PathPals</h1>

            <div class="footer-links">
                <div class="footer-links-contents footer-links-hover">
                    <h1>Politicas</h1>

                    <p><a href="./privacy-policy">Politica de Privacidade</a></p>
                    <p><a href="./terms">Termos de Serviço</a></p>
                    <p><a href="./cookies">Cookies</a></p>
                </div>

                <div class="footer-links-contents footer-links-hover">
                    <h1>DESCOBRA</h1>

                    <p><a href="#about">About</a></p>
                    <p><a href="#profile">Perfil</a></p>
                    <p><a href="#extras">Extras</a></p>
                </div>

                <div class="footer-links-contents">
                    <h1>CONTACTO</h1>

                    <p>+351 932 099 733</p>
                    <p>rubenoliveiracosta162004@gmail.com</p>
                </div>
            </div>
        </div>

        <div class="footer-car">
            <div class="footer-car-gif">
                <div class="footer-car-container"></div>
            </div>
        </div>
    </div>

    <div class="credits">
        <p>Desenvolvido por: Rúben Costa</p>
        <p>© PathPals 2024</p>
        
        <div class="credits-sm">
            <a href="https://www.instagram.com/rubencosta_2004/">
                <div class="sm-box">
                    <div class="sm-container instagram"></div>
                </div>
            </a>

            <a href="https://github.com/Ice-San">
                <div class="sm-box">
                    <div class="sm-container github"></div>
                </div>
            </a>

            <a href="www.linkedin.com/in/devrubencosta/">
                <div class="sm-box">
                    <div class="sm-container linkdin"></div>
                </div>
            </a>
        </div>
    </div>

    <script src="./src/scripts/hero-scroll.js"></script>
    <script src="./src/scripts/introduction-scroll.js"></script>
    <script src="./src/scripts/perfil.js"></script>
</body>
</html>