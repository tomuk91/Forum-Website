<?php include_once('../private/init.php'); ?>

<?php

$id = $_GET['id'];
$topics_set = find_topic_by_cat_id($id);

?>


<?php include(SHARED_PATH . '/header.php'); ?>
<?php include(SHARED_PATH . '/forum_nav.php'); ?>


<div class="forum">
    <table>
        <th>Topic</th>
        <th>Date Created</th>
        <th>Created by</th>

        <?php while($topic = mysqli_fetch_assoc($topics_set)) { ?>
        <tr>
            <td width="70%"><a href="<?php echo url_to('/show_posts.php?id=' . $id) ?>"><?php echo htmlspecialchars($topic['topic_subject']); ?></a></td>
            <td><?php echo htmlspecialchars($topic['topic_date']); ?></td>
            <td><?php echo htmlspecialchars($topic['username']); ?></td>
        </tr>
        <?php } ?>
    </table>
    <?php mysqli_free_result($topics_set); ?>
</div>




<?php include(SHARED_PATH . '/footer.php'); ?>