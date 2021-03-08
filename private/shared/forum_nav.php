

<div class="forum_nav">
    <ul>
        <?php if(stripos($_SERVER['REQUEST_URI'], 'id=')) { ?>
            <?php // Do not show the link to create cat if page is on topic ?>
        <?php } else { ?>
            <li><a href="<?php echo url_to('/create_cat.php');?>">Create Category</a></li>
            <?php } ?>
        <?php if(stripos($_SERVER['REQUEST_URI'], 'show_topics.php')) { ?>
           <li><a href="<?php echo url_to('/create_topic.php?id=' . htmlspecialchars($_GET['id'])); ?>">Create Topic</a></li>
        <?php } ?>
        <?php if(stripos($_SERVER['REQUEST_URI'], 'show_posts.php')) { ?>
            <li><a href="<?php echo url_to('/create_reply.php?id=' . htmlspecialchars($_GET['id'])); ?>">Reply</a></li>
            <?php } ?>
    </ul>
</div>