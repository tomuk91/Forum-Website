<?php include_once('../private/init.php'); ?>

<?php 

needs_login_to_access();

$id = $_GET['id'];
$topic = find_topic_by_id($id);

?>

<?php 

if($_SERVER['REQUEST_METHOD'] == "POST") {

    $posts['post_content'] = $_POST['content'];
    $posts['post_date'] = date('Y-m-d H:i:s');
    $posts['post_topic'] = $id;
    $posts['post_by'] = $_SESSION['user_id'];

    $result = create_post($posts);

    // if the result is true, grab the newly created ID to re-direct to new post. 
    $new_id = mysqli_insert_id($db);
    if($result) {
        header('Location: show_posts.php?id=' . $id);
    }
}
?>


<?php include(SHARED_PATH . '/header.php'); ?>



<div class="form">
    <form action="<?php echo url_to('/reply_to.php?id=' . $id); ?>" method="post">
    <dl>
    <p style="text-align: left;"><a href="<?php echo url_to('/forum.php');?>">Back to forum</a></p><br><br>
        <dt>Reply</dt>
        <dd><input style="height:100px; width:50%;" type="text" name="content" /></dd><br>

        <dt>Replying to topic</dt>
        <dd><input type="text" value="<?php echo htmlspecialchars($topic['topic_subject']); ?>" readonly/></dd><br>

        <dt>Assign to:</dt>
        <dd><input type="text" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" readonly /></dd><br>

        <dd><input type="submit" name="submit" value="Create Reply" /> </dd>
    </dl>
    </form>
</div>


<?php include(SHARED_PATH . '/footer.php'); ?>