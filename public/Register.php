<?php include('../private/init.php'); ?>

<?php
if(isset($_SESSION['username'])) {
    header('location: profile.php');
}


if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['reg_token'] == $_SESSION['reg_token']) {

    $users['first_name'] = $_POST['first_name'] ?? "";
    $users['last_name'] = $_POST['last_name'] ?? "";
    $users['username'] = $_POST['username'] ?? "";
    $users['email'] = $_POST['email'] ?? "";
    $users['password'] = $_POST['password'] ?? "";
    $users['confirm_password'] = $_POST['confirm_password'] ?? "";

    $result = insert_into_users($users);

    if($result === true) {
        header('Location: signup_confirmation.php');
    }

    } else {
    // display the blank form 
    $users['first_name'] = "";
    $users['last_name'] = "";
    $users['username'] = "";
    $users['email'] = "";
    $users['password'] = "";
    $users['confirm_password'] = "";
}

?> 


<?php include_once(SHARED_PATH . '/header.php'); ?>

<!-- Displays list of errors from form validation found in the errors array !-->
<?php echo display_errors($errors); ?>

<img class="register" src="<?php echo url_to('/images/register.jpg')?>" alt="register">


<?php 
/* Generates random token for registration & assigns
 to session for access to confirmation page once successful registration */ 
$reg_token = bin2hex(random_bytes(32));
$_SESSION['reg_token'] = $reg_token;
?>

<div class="form">
<p>Register to participate in our discussion boards and become a new valuable member of the community!</p></br>
    <form action ="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="post">
    <dl>
        <dt>First Name:</dt>
        <dd><input type="text" name="first_name" value="<?php echo htmlspecialchars($users['first_name']); ?>" /></dd></br>
    
        <dt>Last Name:</dt>
        <dd><input type="text" name="last_name" value="<?php echo htmlspecialchars($users['last_name']); ?>" /></dd></br>
    
        <dt>Username:</dt>
        <dd><input type="text" name="username" value="<?php echo htmlspecialchars($users['username']); ?>" /></dd></br>
    
        <dt>Email:</dt>
        <dd><input type="text" name="email" value="<?php echo htmlspecialchars($users['email']); ?>" /></dd></br>
        
        <dt>Password:</dt>
        <dd><input type="password" name="password" value="" /></dd></br>
        
        <dt>Confirm Password:</dt>
        <dd><input type="password" name="confirm_password" value="" /></dd></br>
        <p>Password must include 1 Uppercase, 1 Special Character</p></br>
        <dd><input type="submit" value="Create User"/></dd></br>
        
        <p>Already Registered? Login Here: <a href="<?php echo url_to('/login.php'); ?>">Login</a></p>
    </dl>
        <input type="hidden" name="reg_token" value="<?php echo $reg_token; ?>" />
    </form>
</div> 




<?php include_once(SHARED_PATH . '/footer.php'); ?>