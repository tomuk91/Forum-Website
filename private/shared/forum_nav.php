

<div class="forum_nav">
    <ul>
        <?php if(stripos($_SERVER['REQUEST_URI'], 'id=')) { ?>
            <!--Do not show the link to create category if current page on topic-->
        <?php } else { ?>
            <li><a href="<?php echo url_to('/create_cat.php');?>">Create Category</a></li>
            <?php } ?>
            
            <!--If current URL has show topics, display the create topic link-->
        <?php if(stripos($_SERVER['REQUEST_URI'], 'show_topics.php')) { ?>
           <li><a href="<?php echo url_to('/create_topic.php?id=' . htmlspecialchars($_GET['id'])); ?>">Create Topic</a></li>
        <?php } ?>

        <!--If current URL has show posts, display the reply button-->
        <?php if(stripos($_SERVER['REQUEST_URI'], 'show_posts.php')) { ?>
            <li><a href="<?php echo url_to('/reply_to.php?id=' . htmlspecialchars($_GET['id'])); ?>">Reply</a></li>
            <?php } ?>
    </ul>
</div>