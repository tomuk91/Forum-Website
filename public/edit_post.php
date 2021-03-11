<?php include_once('../private/init.php'); ?>

<?php 
needs_login_to_access();

$post_id = $_GET['post_id'];

$selected_post = find_post_by_id($post_id);
?>


<?php
// Start of the post request form processing // 
if($_SERVER['REQUEST_METHOD'] == "POST") {

    if(empty($_POST['content'])) {
        $errors[] = "Content can not be empty";
    } else {

    $posts['content'] = $_POST['content'];
        
    $sql = "UPDATE posts SET "; 
    $sql .= "post_content='" . mysqli_real_escape_string($db, $posts['content']) . "' ";
    $sql .= "WHERE id='" . $post_id . "'";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    if($result) {
    $_SESSION['msg'] = "Post Successfully updated";
    header('Location: show_posts.php?id=' . $selected_post['post_topic']);
    } else {
    // do nothing
        }
    }
}

?>

<?php include(SHARED_PATH . '/header.php'); ?>

<?php echo display_errors($errors); ?>

<div class= "edit post">

    <form action="<?php echo url_to('/edit_post.php?post_id=' . htmlspecialchars(urlencode($post_id))); ?>" method="post">

        <p style="text-align: left;"><a href="<?php echo url_to('/forum.php');?>">Back to forum</a></p></br>

        <h3>Edit your post below:</h3></br>

        <input style="height:100px; width:50%;" type="text" name="content" value="<?php echo htmlspecialchars($selected_post['post_content']); ?>" />
        <br><br>

        <input type="submit" name="commit" value="Update post" />

    </form>
</div>





<?php include(SHARED_PATH . '/footer.php'); ?>