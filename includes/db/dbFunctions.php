<?php

function connect($dbName) {
    $dbLink = new mysqli('localhost', 'root', 'PASSWORD', $dbName)
    or die("there is a problem connecting to the database");
    return $dbLink;
}


function getLoggedInId($conn, $uName, $pWord) {
    $sql = 'SELECT id  from users where user_name = ? and password = ?';
    if($stmt = $conn->prepare($sql)){

        $stmt->bind_param('ss', $uName, $pWord);
        $stmt->execute();
        $stmt->bind_result($id);
        $authId = 0;
        while($stmt->fetch()){
            $authId = $id;
        }
        $stmt->close();
        return $authId;

    }
}

function insertPost($conn, $title, $teaser, $body, $author_id, $blog_cat, $read_time, $is_featured){
    $sql = "INSERT INTO blog_article (title, teaser, body, user_id, blog_cat_id, read_time, isFeatured  ) VALUES (?,?,?,?,?,?,?)";
    if($stmt = $conn->prepare($sql)){

        $stmt->bind_param('sssiiii', $title, $teaser, $body, $author_id,intVal($blog_cat), intVal($read_time), intVal($is_featured));
        $stmt->execute();
        $stmt->close();
        $msg = "Successfully inserted $title! New record id is ". $conn->insert_id .".";
    }else{
        $msg = "Error inserting record";
    }
    return $msg;
}


function updatePost($conn, $title, $teaser, $body, $skill_cat, $blog_cat, $read_time, $is_featured, $id){
    $sql = "UPDATE blog_article SET title = $title, teaser = $teaser, body = $body, skill_category_id = $skill_cat, blog_cat_id = $blog_cat, read_time = $read_time, isFeatured=$is_featured  WHERE id = $id";
    if($stmt = $conn->prepare($sql)){

        //$stmt->bind_param('sssiiiii', $title, $teaser, $body, intVal($skill_cat),intVal($blog_cat), intVal($read_time), intVal($is_featured));
        $stmt->execute();
        $stmt->close();
        $msg = "Successfully inserted $title.";
        $_SESSION['editedId'] = $id;
    }else{
        $msg = "Error updating the post.";
    }
    return $msg;
}


function getAllPosts($conn){

    $stmt = $conn->prepare('select blog_article.id, title, date_created, CONCAT(fname, " ", lname) AS author_name  from blog_article INNER JOIN users ON blog_article.user_id = users.id') or die ("Problem with query");
    $stmt->execute();
    $stmt->bind_result($id, $title, $dateCreated, $author_name );

    while($row = $stmt->fetch()){
        $item = array(
            'id' => $id,
            'title' => $title,
            'author_name' => $author_name,
            'date_created' => $dateCreated);

            $rows[] = $item;
       
    }
    $stmt->close();

    if (!isset($rows) || empty($rows)) {
        $rows = [];
    }
    
    return $rows;
}

function getAllPostsByAuthorId($conn, $authorId) {
    $stmt = $conn->prepare("select id, title, teaser, body, author_id from posts where author_id = ?") or die("Problem with query");
    $stmt->bind_param('i', intVal($authorId));
    $stmt->execute();
    $stmt->bind_result($id, $title, $teaser, $body, $authorId);

    while($row = $stmt->fetch()){
        $item = array(
            'id' => $id,
            'title' => $title,
            'teaser' => $teaser,
            'body' => $body,
            'author_id' => $authorId

        );
            $rows[] = $item;
    }
    $stmt->close();

    if (!isset($rows) || empty($rows)) {
        $rows = [];
    }

    return $rows;
}

function getAllPostsBySearch($conn, $searchString) {
    $sql=  "Select blog_article.id, title, date_created, CONCAT(fname,' ', lname)
    AS author_name, category_name from blog_article 
    INNER JOIN users ON blog_article.user_id = users.id 
    INNER JOIN blog_category ON blog_article.blog_cat_id = blog_category.id 
    WHERE title LIKE concat('%','$searchString' ,'%') OR category_name LIKE concat('%','$searchString','%')";
    $stmt = $conn->prepare($sql) or die("Problem with query");
    $stmt->execute();
    $stmt->bind_result($id, $title, $dateCreated, $author_name, $category_name );

    while($row = $stmt->fetch()){
        $item = array(
            'id' => $id,
            'title' => $title,
            'author_name' => $author_name,
            'date_created' => $dateCreated,
            'category_name' => $category_name
        );

            $rows[] = $item;
       
    }
    $stmt->close();

    if (!isset($rows) || empty($rows)) {
        $rows = [];
    }

    return $rows;
}

function getAllProjects($conn){

    $stmt = $conn->prepare('SELECT id, title, blurb, main_description, github_url, isFeatured FROM project') or die ("Problem with query");
    $stmt->execute();
    $stmt->bind_result($id, $title, $blurb, $main_description, $github_url, $isFeatured );

    while($row = $stmt->fetch()){
        $item = array(
            'id' => $id,
            'title' => $title,
            'blurb' => $blurb,
            'main_description' => $main_description,
            'github_url' => $github_url,
            'isFeatured' => $isFeatured,
        );

            $rows[] = $item;
       
    }

    if (!isset($rows) || empty($rows)) {
        $rows = [];
    }
    $stmt->close();
    return $rows;
}


function getAllProjectsBySearch($conn, $searchString){

    $sql=  "SELECT project.id, title, blurb, main_description, github_url, isFeatured, project_category.name, skill_name FROM project 
                INNER JOIN project_category ON project_category.id = project.cat_id
                INNER JOIN project_skill_joint ON project_skill_joint.project_id = project.id
                INNER JOIN skills ON project_skill_joint.skill_id = skills.id
                WHERE title LIKE CONCAT( '%', '$searchString', '%') OR project_category.name LIKE CONCAT( '%', '$searchString', '%')OR skill_name LIKE CONCAT( '%', '$searchString', '%')
                GROUP BY project.id
                HAVING COUNT(DISTINCT project.id) = 1";
    $stmt = $conn->prepare($sql) or die("Problem with query");
    $stmt->execute();
    $stmt->bind_result($id, $title, $blurb, $main_description, $github_url, $isFeatured, $categoryName, $skillName );

    while($row = $stmt->fetch()){
        $item = array(
            'id' => $id,
            'title' => $title,
            'blurb' => $blurb,
            'main_description' => $main_description,
            'github_url' => $github_url,
            'isFeatured' => $isFeatured,
        );

            $rows[] = $item;
       
    }
    
    $stmt->close();

    if (!isset($rows) || empty($rows)) {
        $rows = [];
    }
 
    return $rows;
}

function insertProject($conn, $title, $blurb, $body, $github_url, $project_date, $cat_id, $is_featured, $video_demo){
    $sql = "INSERT INTO project (title, blurb, main_description, github_url,  project_date, cat_id, isFeatured, video_demo) VALUES (?,?,?,?,?,?,?,?)";
    if($stmt = $conn->prepare($sql)){

        $stmt->bind_param('sssssiis', $title, $blurb, $body, $github_url, $project_date,intVal($cat_id), intVal($is_featured), $video_demo);
        $stmt->execute();
        $stmt->close();
        $msg = "Successfully inserted $title! New record id is ". $conn->insert_id .".";
    }else{
        $msg = "Error inserting record";
    }
    return $msg;
}



?>