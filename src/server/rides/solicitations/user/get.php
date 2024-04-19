<?php
include "../../src/server/auth.php";

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