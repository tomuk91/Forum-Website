<?php

session_start();
session_unset();
session_destroy();
session_write_close();
setcookie(session_name(),'',0,'/');
session_regenerate_id(true);

unset($_SESSION['username']);
unset($_SESSION['user_id']);
unset($_SESSION['login_time']);
header('Location: index.php');


?> 