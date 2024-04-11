<?php
    include "../../src/server/auth.php";

    $userInfo = "CALL get_user_info('". $_SESSION['email'] . "');";
    $userInfoQuery = mysqli_query($conn , $userInfo);

    if (mysqli_num_rows($userInfoQuery) > 0) {
        while($row = mysqli_fetch_assoc($userInfoQuery)) {
            echo '<div class="username-background">
            <div class="username-position">
                <div class="username">
                    <div class="username-container"></div>
                </div>
                
                <p>'. $row["user_username"] .'</p>
            </div>
        
            <div class="name-background">
                <p>'. $row["first_name"] .' '. $row["last_name"] .'</p>
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
                        <p>'. $row["user_career"] .'</p>
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
                        <p>'. $row["user_age"] .'</p>
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
                        <p>'. $row["user_class"] .'</p>
                    </div>
                </div>
            </div>
        
            <div class="info-background-bottom">
                <div class="info-content">
                    <div class="info-title">
                        <div class="info-icon">
                            <div class="school-container"></div>
                        </div>
        
                        <h1>Escola</h1>
                    </div>
        
                    <div class="info-description">
                        <p></p>
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
                        <p>'. $row["user_location"] .'</p>
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
                        <p>'. $row["user_about"] .'</p>
                    </div>
                </div>
            </div>
        </div>';
        }
    }
?>