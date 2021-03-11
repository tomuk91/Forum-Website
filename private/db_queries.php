<?php

function validate_registration($users) {
    
    global $errors;

    // First Name Check
    if(empty($users['first_name'])) {
        $errors[] = "First name cannot be blank";
    } elseif (strlen($users['first_name']) < 2) {
        $errors[] = "First name must be between 2 and 50 characters";
    } elseif (!preg_match("/^[a-zA-z]*$/", $users['first_name'])) {  
        $errors[] = "Only alphabets and whitespace are allowed.";  
    }
    // Last Name Check 
    if(empty($users['last_name'])) {
        $errors[] = "Last name cannot be blank";
    } elseif (strlen($users['last_name']) < 2) {
        $errors[] = "Last name must be between 2 and 50 characters";
    } elseif (!preg_match("/^[a-zA-z]*$/", $users['last_name'])) {  
        $errors[] = "Only alphabets and whitespace are allowed.";  
    }
    // Email Check
    $pattern =  "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
    if(!preg_match($pattern, $users['email'])) {
        $errors[] = "Email is not a valid format";
    } elseif (empty($users['email'])) {
        $errors[] = "A vailid email must be supplied";
    }
    // Username check
    if(has_unique_username($users['username'], $_POST['username']) ?? NULL) {
        $errors[] = "Username is already taken";
    } elseif (strlen($users['username']) < 2) {
        $errors[] = "Username must be between 2 and 50 characters";
    }
    // Password Check
    $pass_regex = "/^(?=.*\d)(?=.*[A-Za-z])(?=.*[A-Z])(?=.*[a-z])(?=.*[ !#$%&'\(\) * +,-.\/[\\] ^ _`{|}~\"])[0-9A-Za-z !#$%&'\(\) * +,-.\/[\\] ^ _`{|}~\"]{8,50}$/";
    if($users['password'] !== $users['confirm_password']) {
        $errors[] = "Please check your passwords match";
    } elseif (!preg_match($pass_regex, $users['password'])) {
        $errors[] = "Password must have atleast: <li>1 digit</li><li>1 capital letter</li><li>1 lowercase</li><li>1 special character";
    } elseif (empty($users['password'])) {
        $errors[] = "Password cannot be blank";
    } elseif (strlen($users['password']) < 6) {
        $errors[] = "Password must be between 6 and 50 characters";
    }
    return $errors;
}

function validate_profile_update($users) {
    
    global $errors;

    // First Name Check
    if(empty($users['first_name'])) {
        $errors[] = "First name cannot be blank";
    } elseif (strlen($users['first_name']) < 2) {
        $errors[] = "First name must be between 2 and 50 characters";
    } elseif (!preg_match("/^[a-zA-z]*$/", $users['first_name'])) {  
        $errors[] = "Only alphabets and whitespace are allowed.";  
    }
    // Last Name Check 
    if(empty($users['last_name'])) {
        $errors[] = "Last name cannot be blank";
    } elseif (strlen($users['last_name']) < 2) {
        $errors[] = "Last name must be between 2 and 50 characters";
    } elseif (!preg_match("/^[a-zA-z]*$/", $users['last_name'])) {  
        $errors[] = "Only alphabets and whitespace are allowed.";  
    }
    // Email Check
    $pattern =  "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
    if(!preg_match($pattern, $users['email'])) {
        $errors[] = "Email is not a valid format";
    } elseif (empty($users['email'])) {
        $errors[] = "A vailid email must be supplied";
    }
    // Password Check
    $pass_regex = "/^(?=.*\d)(?=.*[A-Za-z])(?=.*[A-Z])(?=.*[a-z])(?=.*[ !#$%&'\(\) * +,-.\/[\\] ^ _`{|}~\"])[0-9A-Za-z !#$%&'\(\) * +,-.\/[\\] ^ _`{|}~\"]{8,50}$/";
    if($users['password'] !== $users['confirm_password']) {
        $errors[] = "Please check your passwords match";
    } elseif (!preg_match($pass_regex, $users['password'])) {
        $errors[] = "Please enter your current password or enter a new one to update it";
    } elseif (empty($users['password'])) {
        $errors[] = "Password cannot be blank";
    } elseif (strlen($users['password']) < 6) {
        $errors[] = "Password must be between 6 and 50 characters";
    }
    return $errors;
}


function insert_into_users($users) {
    global $db;

    $errors = validate_registration($users);
    if(!empty($errors)) {
        return $errors;
    }
    
    $password = password_hash($users['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users ";
    $sql .= "(first_name, last_name, username, email, password) ";
    $sql .= "VALUES (";
    $sql .= "'" . mysqli_real_escape_string($db, $users['first_name']) . "', ";
    $sql .= "'" . mysqli_real_escape_string($db, $users['last_name']) . "', ";
    $sql .= "'" . mysqli_real_escape_string($db, $users['username']) . "', ";
    $sql .= "'" . mysqli_real_escape_string($db, $users['email']) . "', ";
    $sql .= "'" . mysqli_real_escape_string($db, $password) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    if($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function find_user_by_username($username) {
    global $db; 

    $sql = "SELECT * FROM users ";
    $sql .= "WHERE username='" . mysqli_real_escape_string($db, $username) . "'";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    if($result) {
        $user = mysqli_fetch_assoc($result);
    } else {
        // no results
        echo "No results found";
    }
    mysqli_free_result($result);
    return $user;
}

function has_unique_username($username, $submitted) {
    global $db;

    $sql = "SELECT * FROM users ";
    $sql .= "WHERE username='" . mysqli_real_escape_string($db, $username) . "'";
    $result = mysqli_query($db, $sql);
    $user_unique = mysqli_num_rows($result);
    mysqli_free_result($result);
    return $user_unique;
}

function profile_by_sessionid() {
    global $db;

    $sql = "SELECT * FROM users ";
    $sql .= "WHERE id='" . mysqli_real_escape_string($db, $_SESSION['user_id']) . "'";
    $sql .= "LIMIT 1"; 
    $result = mysqli_query($db, $sql);
    return $result;
}

function update_profile($users) {
    global $db;

    $errors = validate_profile_update($users);
    if(!empty($errors)) {
        return $errors;
    }

    $password = password_hash($users['password'], PASSWORD_BCRYPT);

    $sql = "UPDATE users SET ";
    $sql .= "first_name='" . mysqli_real_escape_string($db, $users['first_name']) . "', ";
    $sql .= "last_name='" . mysqli_real_escape_string($db, $users['last_name']) . "', ";
    $sql .= "username='" . mysqli_real_escape_string($db, $users['username']) . "', ";
    $sql .= "email='" . mysqli_real_escape_string($db, $users['email']) . "', ";
    $sql .= "password='" . mysqli_real_escape_string($db, $password) . "' ";
    $sql .= "WHERE id='" . mysqli_real_escape_string($db, $_SESSION['user_id']) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    if($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_user($id) {
    global $db;

    $sql = "DELETE FROM users ";
    $sql .= "WHERE id='" . mysqli_real_escape_string($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    if($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function insert_into_categories($categories) {
    global $db;

    $sql = "INSERT INTO categories ";
    $sql .= "(cat_name, cat_descriptions) ";
    $sql .= "VALUES (";
    $sql .= "'" . mysqli_real_escape_string($db, $categories['name']) . "', ";
    $sql .= "'" . mysqli_real_escape_string($db, $categories['cat_descriptions']) . "' ";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    if($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function select_all_categories() {
    global $db;

    $sql = "SELECT * FROM categories ";
    $result = mysqli_query($db, $sql);
    return $result;
}

function find_cat_by_id($id) {
    global $db;

    $sql = "SELECT * FROM categories ";
    $sql .= "WHERE id='" . mysqli_real_escape_string($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    if($result){
        $cat = mysqli_fetch_assoc($result);
    } else {
        echo mysqli_error($db);
    }
    mysqli_free_result($result);
    return $cat;
}

function find_topic_by_id($id) {
    global $db;

    $sql = "SELECT * FROM topics ";
    $sql .= "WHERE id='" . mysqli_real_escape_string($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    if($result){
        $cat = mysqli_fetch_assoc($result);
    } else {
        echo mysqli_error($db);
    }
    mysqli_free_result($result);
    return $cat;
}

/*TO BE WORKED ON
function count_topics() {

    global $db;

    $sql = "SELECT categories.id, topics.topic_cat ";
    $sql .= "FROM topics ";
    $sql .= "JOIN categories ON ";
    $sql .= "topics.topic_cat=categories.id" 
    $sql .= "WHERE topic_cat='" . categories.id . "'";
    $result = mysqli_query($db, $sql);
    return $result;
    // count topics to display on front forum
}
*/


function create_topic($topics) {
    global $db;

    $sql = "INSERT INTO topics ";
    $sql .= "(topic_subject, topic_date, topic_cat, topic_by) ";
    $sql .= "VALUES (";
    $sql .= "'" . mysqli_real_escape_string($db, $topics['topic_subject']) . "', ";
    $sql .= "'" . mysqli_real_escape_string($db, $topics['topic_date']) . "', ";
    $sql .= "'" . mysqli_real_escape_string($db, $topics['topic_cat']) . "', ";
    $sql .= "'" . mysqli_real_escape_string($db, $topics['topic_by']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    if($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function create_post($posts) {
    global $db;
    
    $sql = "INSERT INTO posts ";
    $sql .= "(post_content, post_date, post_topic, post_by) ";
    $sql .= "VALUES ( ";
    $sql .= "'" . mysqli_real_escape_string($db, $posts['post_content']) . "', ";
    $sql .= "'" . mysqli_real_escape_string($db, $posts['post_date']) . "', ";
    $sql .= "'" . mysqli_real_escape_string($db, $posts['post_topic']) . "', ";
    $sql .= "'" . mysqli_real_escape_string($db, $posts['post_by']) . "' ";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    //var_dump($sql);
    if($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function find_topic_by_cat_id($cat_id) {
    global $db;

    $sql = "SELECT * FROM topics ";
    $sql .= "JOIN users ON ";
    $sql .= "topics.topic_by=users.id ";
    $sql .= "WHERE topic_cat='" . mysqli_real_escape_string($db, $cat_id) . "' ";
    $sql .= "ORDER BY topic_date DESC";
    $result = mysqli_query($db, $sql);
    return $result;
}

   

function show_posts_information($topic_id) {
    global $db;

    $sql = "SELECT posts.id, users.username, users.reg_date, posts.post_content, posts.post_date, posts.post_topic, posts.post_by "; 
    $sql .= "FROM posts ";
    $sql .= "INNER JOIN users ON ";
    $sql .= "posts.post_by=users.id ";
    $sql .= "INNER JOIN topics ON ";
    $sql .= "posts.post_topic=topics.id ";
    $sql .= "WHERE post_topic='" . mysqli_real_escape_string($db, $topic_id) . "' ";
    $sql .= "ORDER BY post_date ASC";
    $result = mysqli_query($db, $sql);
    return $result;
}        

function find_all_posts() {
    global $db;

    $sql = "SELECT * FROM posts ";
    $result = mysqli_query($db, $sql);
    return $result;
}

function find_post_by_id($id) {
    global $db;

    $sql = "SELECT * FROM posts ";
    $sql .= "WHERE id='" . mysqli_real_escape_string($db, $id) . "'";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    if($result) {
        $post = mysqli_fetch_assoc($result);
    } else {
        echo mysqli_error($db);
        exit;
    }
    return $post;
}

function delete_post($id) {
    global $db;

    $sql = "DELETE FROM posts ";
    $sql .= "WHERE id='" . mysqli_real_escape_string($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    if($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}


?>