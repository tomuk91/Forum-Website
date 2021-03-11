<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" media="all" href="<?php echo url_to('/stylesheets/stylesheet.css');?>" />
    </head>

    <body>
    <header>
        <div class="nav">
            <ul>
                <li><a href="<?php echo url_to('/index.php');?>">Home</a></li>
                <li><a href="<?php echo url_to('/forum.php');?>">Forum</a></li>
                <!--If user is logged in, display buttons for profile and logout-->
        <?php if(isset($_SESSION['user_id'])) { ?>
                <li><a href="<?php echo url_to('/profile.php'); ?>">Profile</a></li>
                <li><a href="<?php echo url_to('/logout.php'); ?>">Logout</a></li>            
        <?php } else { ?>
            <li><a href="login.php" title="">Login</a></li>
            <?php } ?>  
            </ul>
        </div>
    </header>
