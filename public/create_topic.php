<?php include_once('../private/init.php'); ?>

<?php

needs_login_to_access();

$id = $_GET['id'];
$cat = find_cat_by_id($id);

?>

<?php


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $topics['topic_subject'] = $_POST['topic'] ?? "";
    $topics['topic_date'] = date('Y-m-d H:i:s');
    $topics['topic_cat'] = $cat['id'] ?? ""; 
    $topics['topic_by'] = $_SESSION['user_id'] ?? "";

    
    $result = create_topic($topics);

    if($result == true) {

    $topic_id = mysqli_insert_id($db);
    
    $posts['post_content'] = $_POST['content'] ?? "";
    $posts['post_date'] = date('Y-m-d H:i:s');
    $posts['post_topic'] = $topic_id;
    $posts['post_by'] = $_SESSION['user_id'] ?? "";
    
    $result1 = create_post($posts);
    
    if($result1) {
        header('Location: forum.php');
    }
    }
}

    


?>

<?php include(SHARED_PATH . '/header.php'); ?>





<div class="form">
    <form action="<?php echo url_to('/create_topic.php?id=' . $id); ?>" method="post">
    <dl>
        <dt>Topic</dt>
        <dd><input type="text" name="topic" /></dd>

        <dt>Topic Category</dt>
        <dd><input type="text" name="cat_name" value="<?php echo htmlspecialchars($cat['cat_name']) ?>" readonly /></dd><br>

        <p> Create the first post for this topic</p><br>

        <dt>Your message</dt>
        <dd><input style="height:100px; width:50%;" type="text" name="content" /></dd><br>

        <dt>Assigned to:</dt>
        <dd><input type="text" value="<?php echo htmlspecialchars($_SESSION['username']) ?>" readonly /></dd><br>

        <dd><input type="hidden" name="post_topic" value="<?php echo htmlspecialchars($cat['id']) ?>" /></dd>

        <dd><input type="submit" value="Create topic" /></dd>

    </dl>
</div>


<?php include(SHARED_PATH . '/footer.php'); ?>


