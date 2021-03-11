<?php include_once('../private/init.php'); ?>

<?php 


$id = $_GET['id'];
$topics_set = show_posts_information($id);


?>


<?php include(SHARED_PATH . '/header.php'); ?>
<?php include(SHARED_PATH . '/forum_nav.php'); ?>


<?php check_for_session_msg(); ?> 



<div style="text-align:center;" class="forum">
    <table>
        <th>Author</th>
        <th>Message</th>
        <th></th>

        <?php while($post = mysqli_fetch_assoc($topics_set)) { ?>

        <tr>
            <td width=20%;><?php echo htmlspecialchars($post['username']);?><br><p>Member Since:<?php echo $post['reg_date'];?></p></td>

            <td><?php echo htmlspecialchars($post['post_content']);?><br><p>Submitted:<?php echo $post['post_date'];?></p></td>

                <!--Check to see if the session user_id is set & it matches author before displaying delete button-->
                <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['post_by']) { ?>

            <td width=10%;>
            <a href="<?php echo url_to('/delete_post.php?post_id=' . htmlspecialchars(urlencode($post['id']))); ?>">Delete Post</a>
            <br><hr>
            <a href="<?php echo url_to('/edit_post.php?post_id=' . htmlspecialchars(urlencode($post['id']))); ?>">Edit Post</a>
            </td>

            <?php } else { ?>
                <td></td> <?php } ?> <!--end of user checking for delete button-->
        </tr>

        <?php } ?> <!--End of while loop-->

    <?php mysqli_free_result($topics_set);?>
    </table>
</div>





<?php include(SHARED_PATH . '/footer.php'); ?>