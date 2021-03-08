<?php

require_once('database_creds.php'); 

function db_connect() {
    $connection = mysqli_connect(DB_SERVER, USER, DB_PASS, DB_NAME);
    if(isset($connection)) {
        return $connection;
    } else {
        mysqli_connect_errno($connection);
        exit; 
    }
}


function db_disconnect($connection) {
    if(isset($connection)) {
      mysqli_close($connection);
    }
  }



?>