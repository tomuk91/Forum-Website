<?php include_once('../private/init.php'); ?>

<?php 

if(!isset($_SESSION['user_id'])) {
    header('Location: index.php');
}

$id = $_SESSION['username'];
$profile = find_user_by_username($id); 

if($_SERVER['REQUEST_METHOD'] == "POST") {

    $users['first_name'] = $_POST['first_name'] ?? "";
    $users['last_name'] = $_POST['last_name'] ?? "";
    $users['username'] = $_POST['username'] ?? "";
    $users['email'] = $_POST['email'] ?? "";
    $users['password'] = $_POST['password'] ?? "";
    $users['confirm_password'] = $_POST['confirm_password'] ?? "";

    $result = update_profile($users);

    if($result === true) {
        echo "Profile updated";
        header('Location: profile.php'); 
    } else {
        $errors = $result;
    }
}




?>


<?php include(SHARED_PATH . '/header.php'); ?>

<?php echo display_errors($errors); ?>


<div class="form"> 
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="post">
    <p style="text-align: left;"><a href="<?php echo url_to('/profile.php');?>">Back to profile</a></p><br><br>
    <p>Edit your desired options below to update your profile</p><br>
    <dl>
        <dt>First Name<dt>
        <dd><input type ="text" name="first_name" value="<?php echo htmlspecialchars($profile['first_name']); ?>" /></dd>   

        <dt>Last Name</dt>
        <dd><input type="text" name="last_name" value="<?php echo htmlspecialchars($profile['last_name']); ?>" /></dd>

        <dt>Username</dt>
        <dd><input type="text" name="username" value="<?php echo htmlspecialchars($profile['username']); ?>" readonly/></dd>
        <p style="color:red;">Username cannot be changed</p>

        <dt>Email</dt>
        <dd><input type="text" name="email" value="<?php echo htmlspecialchars($profile['email']); ?>" /> </dd>

        <dt>Password</dt>
        <dd><input type="password" name="password" value="" /></dd>

        <dt>Confirm Password</dt>
        <dd><input type="password" name="confirm_password" value="" /></dd><br>

        <dd><input type="submit" value="Update Profile" /></dd>
    </dl>    
</form>
</div>





<?php include(SHARED_PATH . '/footer.php'); ?>