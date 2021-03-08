<?php include_once('../private/init.php'); ?>

<?php

if(!isset($_SESSION['user_id'])) {
    header('Location: register.php');
}

$user = profile_by_sessionid();

?>

<?php include(SHARED_PATH . '/header.php'); ?>

<table>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Username</th>
    <th>Email</th>
    <th>Password</th>

<?php while($profile = mysqli_fetch_assoc($user)) { ?>

<tr>
    <td><?php echo htmlspecialchars($profile['first_name']); ?></td>
    <td><?php echo htmlspecialchars($profile['last_name']); ?></td>
    <td><?php echo htmlspecialchars($profile['username']); ?></td>
    <td><?php echo htmlspecialchars($profile['email']); ?></td>
    <td><?php echo "<p>******</p>"; ?></td>
</tr>
<tr>
    <td><a href="<?php echo url_to('/edit.php');?>">Edit Profile</td>
    <td><a href="<?php echo url_to('/delete.php?id=' . htmlspecialchars($_SESSION['user_id']));?>">Delete Account</td>
</tr>
<?php } ?>

<?php mysqli_free_result($user); ?>

</table>







<?php include(SHARED_PATH . '/footer.php'); ?> 

