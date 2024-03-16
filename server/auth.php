<?php

$servername = "localhost:3306";
$username = "root";
$password = "root";
$database = "path_pals_db";

$conn = mysqli_connect($servername, $username, $password, $database);

# echo "Pre Connection";

if(!$conn) {
    die("Connect Failed" . mysqli_connect_error());
}

# echo "Pós Connection";

?>