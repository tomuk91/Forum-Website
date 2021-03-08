<?php include('../private/init.php'); ?>

<?php 
needs_login_to_access();
?>

<?php 

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $categories['name'] = $_POST['category_name'] ?? "";
    $categories['cat_descriptions'] = $_POST['category_desc'] ?? "";

    $result = insert_into_categories($categories);

    if($result === true) {
        header('location: forum.php');
    }
    
    } else {
        $categories['name'] = "";
        $categories['cat_descriptions'] = "";
    }

?>


<?php include(SHARED_PATH . '/header.php'); ?>




<div class="form">
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="post">
    <dl>
        <dt>Category Name</dt>
        <dd><input type="text" name="category_name" /></dd><br>

        <dt>Category Description</dt>
        <dd><input style="height:100px; width:70%;"  type="text" name="category_desc" /></dd><br>

        <input type="submit" value="Create Category" />
    </dl>
    </form>
<div>



<?php include(SHARED_PATH . '/footer.php'); ?> 