<?php

function url_to($path) {
    if($path[0] != '/') {
        $path = "/" . $path;
    }
    return WWW_ROOT . $path;
}

function display_errors($errors) {

    $output = '';
    if(!empty($errors)) {

    $output .= "<div class=\"errors\">";
    $output .= "<h4>Please fix the following errors:</h4>";
    $output .= "<ul>";
    foreach ( $errors as $error) {
        $output .= "<li>" . $error . "</li>" . "</br>";
    }   
        $output .= "</ul>";
        $output .= "</div>";
    
}
    return $output;
}

function needs_login_to_access() {
    if(!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    } else {
        //do nothing
    }
}

function check_for_session_msg() {

    if(isset($_SESSION['msg']) && $_SESSION['msg'] != '') {
    
    echo "<h3>" . $_SESSION['msg'] .  "</h3>";
    unset($_SESSION['msg']);
    }
}   



?>