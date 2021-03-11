<?php include_once('../private/init.php'); ?>

<?php

$category = select_all_categories();

?>


<?php include(SHARED_PATH . '/header.php'); ?> 
<?php include(SHARED_PATH . '/forum_nav.php'); ?>

<div class="forum">
    <table>
        <th>Subject</th>
        <th>Category Description</th>
        <th>Number of topics</th>
    
        <?php while($cat = mysqli_fetch_assoc($category)) { ?>
            <tr>
                <td width="30%"><a href="<?php echo url_to('/show_topics.php?id=' . htmlspecialchars(urlencode($cat['id']))); ?>"><?php echo $cat['cat_name']; ?></a></td>
                <td><?php echo $cat['cat_descriptions']?></td>
                <td width="10%;"></td>
            </tr>
        <?php } ?>
    </table>
    <?php mysqli_free_result($category); ?>
</div>


<?php include(SHARED_PATH . '/footer.php'); ?>