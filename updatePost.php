<?php
    $pageTitle = 'Update Post';
    include 'includes/header.php';
    include 'includes/db/dbConnection.php';
    
    if($_SERVER['REQUEST_METHOD'] == "GET"){
        $id = $_GET["id"];
    }
?>

<?php
confirm_logged_in();
?> 


<main class="mt-4 mr-4 ml-4">

<?php

if (isset($_GET["id"])) {
      
    $sql = "SELECT * FROM blog WHERE id = $id";
    $result = $dbLink->query($sql);

    function n12br2($string) {
        $string = str_replace(array("\\r\\n", "\\r", "\\n"), "<br />", $string);
        return $string;
    }

    while ($row = $result->fetch_assoc()) {
    
        $id = $row['id'];
        $image_path = $row['image_path'];
        $title = $row['title'];
        $content = n12br2($row['content']);
        $date = strtotime($row['posted_at']);
    ?>


        <h2>Update Post</h2>

        <form action="updatePost.php" method="POST">
        <div class="form-group">
            <label for="image_path">Image Path</label>
            <input type="text" class="form-control" id="image_path" name="image_path" value="<?php echo $image_path ?>">
        </div>

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $title ?>">
        </div>
        
        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" id="content" name="content" rows="20" value=""><?php echo $content ?></textarea>
        </div>

        <input type="hidden" name="id" value=<?php echo $id;?>>

        <div>

        <?php }?>

  </div>
  <div class="mt-4">

  <a class="btn btn-dark" href="allPosts.php" role="button" >Back To All Posts</a>

  </div>  


  <button type="submit" class="btn btn-dark" name="btnUpdate" value="update">Update</button>

</form>

<?php } ?>

<?php
        //check if form was posted
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            if ($_POST["btnUpdate"] == 'update') {
            $image_path = $_POST['image_path'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            $id = $_POST['id'];

            if(!empty($image_path) && !empty($title) && !empty($content)){
                $dbLink = connect('portfolio_gui');
                $sql = "UPDATE blog SET image_path = ?, title = ?, content = ? WHERE id = $id";

                $result = $dbLink->query($sql);

                if ($stmt = $dbLink->prepare($sql)) {
                    $stmt->execute();

                    echo '<p class="text-danger font-weight-bold mt-5">Blog post was updated successfully.</p>';

                }else{
                    echo '<p class="text-danger font-weight-bold mt-5">Unsuccessfull blog post update.</p>';

                }
            }else{
                echo '<p class="text-danger font-weight-bold mt-5">Please don`t leave any blank fields.</p>';
            }
            $stmt->close();
            $result->close();
        }
    
?>