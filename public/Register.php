<?php include('../private/init.php'); ?>

<?php

if_post_request() {

    $name = $_POST['first_name'] ?? "";
    $last_name = $_POST['last_name'] ?? "";
    $username = $_POST['username'] ?? "";
    $email = $_POST['email'] ?? "";
    $password = $_POST['password'] ?? "";
    $confirm_password = $_POST['confirm_password'] ?? "";
} 

?> 











<?php include_once(SHARED_PATH . '/header.php'); ?>


<form action ="<?php echo hchar($_SERVER['PHP_SELF']; ?>" method="post">
    <dl>
        <dt>First Name:</dt>
        <dd><input type="text" name="first_name" value="" /></dd>
    </dl>
    <dl>
        <dt>Last Name:</dt>
        <dd><input type="text" name="last_name" value="" /></dd>
    </dl>
    <dl>
        <dt>Username:</dt>
        <dd><input type="text" name="username" value="" /></dd>
    </dl>
    <dl>
        <dt>Email:</dt>
        <dd><input type="text" name="email" value="" /></dd>
    </dl>
    <dl>
        <dt>Password</dt>
        <dd><input type="password" name="password" value="" /></dd>
    </dl>
    <dl>
        <dt>Confirm Password</dt>
        <dd><input type="password" name="confirm_password" value="" /></dd>
    </dl>
</form>




<?php include_once(SHARED_PATH . '/footer.php'); ?>