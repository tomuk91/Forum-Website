<?php include('../private/init.php'); ?>

<?php 

if($_SERVER['REQUEST_METHOD'] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    //validations to check if fields have been filled out.
    if(empty($username)) {
        $errors[] = "Username cannot be blank";
    } elseif (empty($password)) {
        $errors[] = "Password cannot be blank";
    }
    // if no errors are found, try to login
    if(empty($errors)) {
        // see if the user exists
        $users = find_user_by_username($username);
            if(!$users) {
                $errors[] = "Username could not be found";
            }
        // if match, check password
        if($users) {
           if(password_verify($password, $users['password'])) {

                session_regenerate_id();
               $_SESSION['username'] = $username;
               $_SESSION['user_id'] = $users['id'];
               $_SESSION['login_time'] = time();
               header('Location: index.php');
           } else {
               $errors[] = "There was a problem trying to log you in, check your credentials";
           }
        }
    } else {
        $errors[] = "There was a problem trying to log you in, check your credentials";
    }
}

?> 


<?php include_once(SHARED_PATH . '/header.php'); ?>

<?php echo display_errors($errors); ?>

<div class="content_login">

    <div class="form">
        <form action="login.php" method ="post">
        <dl>
            <dt>Username</dt>
            <dd><input type="text" name="username" value="" /></dd>
    
            <dt>Password</dt>
            <dd><input type="password" name="password" value="" /></dd></br>
    
            <dd><input type="submit" name="submit" value="Login" /></dd><br>

            <p>Not Registered? Sign up here: <a href="<?php echo url_to('/register.php'); ?>">Register</a></p>
        </dl>
    </div>
    </div>
</div>



<?php include_once(SHARED_PATH . '/footer.php'); ?>