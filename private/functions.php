<?php

function url_to($path) {
    if($path[0] != '/') {
        $path = "/" . $path;
    }
    return WWW_ROOT . $path;
}

function hchar($string) {
    return htmlspecialchars . $string;
}

function if_post_request() {
    $_SERVER['REQUEST_METHOD'] == 'POST';
}


?>