<?php include('../private/init.php'); ?>

<?php include(SHARED_PATH . '/header.php'); ?> 

<?php 

if(!isset($_SESSION['reg_token'])) {
    header('Location: register.php');
}
?>

<div class="sign_up">
    <h3>Confirmed! You're succesfully registered.<br>You will be redirected to the login page to sign in</h3>
</div>
<?php header( "refresh:5;url=login.php" ); ?>










<?php include_once(SHARED_PATH . '/footer.php'); ?> 