<?php

require_once('database_creds.php'); 

function db_connect() {
    $connection = mysqli_connect(DB_SERVER, USER, DB_PASS, DB_NAME);
    if(mysqli_connect_errno()) {
        echo "Failed to connect to MYSQL: " . mysqli_connect_error();
        exit;
    }
}



?>