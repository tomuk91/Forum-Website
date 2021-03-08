<?php include('../private/init.php'); ?> 

<?php 

$id = $_GET['id'];

if($_SERVER['REQUEST_METHOD'] == "POST") {
   $result = delete_user($id);
    header('Location: logout.php');
} else {
    $users = profile_by_sessionid();
}

?>

<?php include(SHARED_PATH . '/header.php'); ?>


<div class="delete user">
    <div class="items">
        <h3>Are you sure you want to delete your user account?</h3>
    </div>

    <form action="<?php echo url_to('/delete.php?id=' . htmlspecialchars(urlencode(($_SESSION['user_id'])))); ?>" method="post">
        <p style="text-align: left;"><a href="<?php echo url_to('/profile.php');?>">Back to profile</a></p>
        <p>User to be deleted: <?php echo htmlspecialchars($_SESSION['username']); ?> </p><br>
        <input type="submit" name="commit" value="Delete user" />
    </form>
</div>


<?php include(SHARED_PATH . '/footer.php'); ?>

