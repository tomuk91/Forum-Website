<?php include_once('../private/init.php'); ?>

<?php include(SHARED_PATH . '/header.php'); ?>

<?php 
needs_login_to_access();

$post_id = $_GET['post_id'];

$post = find_post_by_id($post_id);

?>

<?php 

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $result = delete_post($post_id);
    $_SESSION['msg'] = "Post Successfully deleted";
    header('Location: show_posts.php?id=' . $post['post_topic']);
} else {
    // do nothing
}

?>


<div class= "delete post">
    <div class="items">
        <h3>Are you sure you want to delete this post?</h3>
    </div>

    <form action="<?php echo url_to('/delete_post.php?post_id=' . htmlspecialchars(urlencode($post_id))); ?>" method="post">

        <p style="text-align: left;"><a href="<?php echo url_to('/forum.php');?>">Back to forum</a></p></br>

        <h3>Post to be deleted:</h3></br>
        <p style="background-color:white;"><?php echo htmlspecialchars($post['post_content']); ?></p></br>

        <input type="submit" name="commit" value="Delete post" />

    </form>
</div>





<?php include(SHARED_PATH . '/footer.php'); ?>