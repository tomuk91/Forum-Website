<?php include_once('../private/init.php'); ?>

<?php 

$id = $_GET['id'];
$topics_set = find_post_by_topic_id($id);

?>


<?php include(SHARED_PATH . '/header.php'); ?>
<?php include(SHARED_PATH . '/forum_nav.php'); ?>


<div style="text-align:center;" class="forum">
    <table>
        <th>Author</th>
        <th>Message</th>

        <?php while($post = mysqli_fetch_assoc($topics_set)) { ?>
        <tr>
            <h1>Topic: <?php echo htmlspecialchars($post['topic_subject']); ?></h1>
        </tr>
        <tr>
            <td width="40rem"><?php echo htmlspecialchars($post['username']);?><br><p>Member Since:<?php echo $post['reg_date'];?></p></td>
            <td><?php echo htmlspecialchars($post['post_content']);?><br><p>Submitted:<?php echo $post['post_date'];?></p></td>
        </tr>
        <?php } ?>
    <?php mysqli_free_result($topics_set);?>
    </table>

</div>





<?php include(SHARED_PATH . '/footer.php'); ?>