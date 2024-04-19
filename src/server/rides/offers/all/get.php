<?php
include "../../src/server/auth.php";

$displayAllOffers = "SELECT * FROM all_offers_view;";
$offersAllQuery = mysqli_query($conn , $displayAllOffers);

if (mysqli_num_rows($offersAllQuery) > 0) {
    while($row = mysqli_fetch_assoc($offersAllQuery)) {
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
                    <div class=\"requests-check\"></div>
                </div>
            </div>
        </div>
    </div>";
    }
} else {
    echo "<p class=\"error-message\">Parece que hoje ninguém consegue oferecer transporte... :(</p>";
}
?>