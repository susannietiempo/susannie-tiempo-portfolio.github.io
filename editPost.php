<?php
$pageTitle = 'Edit Post';
include 'includes/header.php';
?>

<?php
if (!isset($_SESSION['username'])) {
    redirect_to('login.php');
} else {
?>


    <?php
    //getting id from url
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
    } else {
        $id = $_GET['id'];
    }

    $dbLink = connect('susannie_tiempo_portfolio');
    //selecting data associated with this particular id
    $result = mysqli_query($dbLink, "SELECT id, title, teaser, body, blog_cat_id, read_time, isFeatured FROM blog_article  WHERE id = $id");

    while ($res = mysqli_fetch_array($result)) {
        $title = $res['title'];
        $teaser = $res['teaser'];
        $body = $res['body'];
        $blog_cat_id = $res['blog_cat_id'];
        $read_time = $res['read_time'];
        $isFeatured = $res['isFeatured'];
    }
    ?>

    <div class="intro intro-single route bg-image" style="background-image: url(assets/img/spaceoverlay.png)">
        <div class="overlay-mf"></div>
        <div class="intro-content display-table">
            <div class="table-cell">
                <div class="container">
                    <h2 class="intro-title mb-4">Update a Post</h2>
                    <ol class="breadcrumb d-flex justify-content-center">
                        <li class="breadcrumb-item">
                            <a href="allPosts.php">Blogs</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Update</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>



    <main id="main" style="background-color: white;">


        <div class="col-md- col-lg-8 col-xl-8 offset-lg-2">
            <form name="form1" method="post" action="editPost.php">
                <div class="form-horizontal " style="padding: 5%;">
                    <h3 class="headline text-center">Blog Details</h3>
                 
             
                    <?php

                    if ($_SERVER['REQUEST_METHOD'] == "POST") {
                        $title = $_POST['title'];
                        $teaser = $_POST['teaser'];
                        $body = $_POST['editor'];
                        $author_id = $_SESSION['authId'];
                        $blog_cat = $_POST['blog_cat_id'];
                        $read_time =  $_POST['read_time'];

                        if (isset($_POST['isFeatured'])) {
                            $isFeatured = $_POST['isFeatured'];
                        } else {
                            //$stok is nog checked and value=0
                            $isFeatured = 0;
                        }


                        if (!empty($title) && !empty($teaser) && !empty($body) && !empty($author_id)) {
                            $dbLink = connect('susannie_tiempo_portfolio');
                            $sql = "UPDATE blog_article SET title = '$title', teaser = '$teaser', body = '$body', blog_cat_id = $blog_cat, read_time = $read_time, isFeatured=$isFeatured WHERE id = $id";

                            $result = mysqli_query($dbLink, $sql);

                            if (!$result) {
                                echo '<div class="mt-3"></div>';
                                echo '<h3 class="text-danger font-weight-bold mt-4 text-center">', "Update not successful! Try again!!", '</h3>';
                                echo '<div class="mb-5"></div>';
                            } else {
                                echo '<div class="mt-3"></div>';
                                echo '<h3 class="text-success font-weight-bold mt-4 text-center">', "Update  successful!", '</h3>';
                                echo '<div class="mb-5"></div>';
                            }
                            $dbLink->close();
                        } else {
                            echo '<div class="mt-3"></div>';
                            echo '<h3 class="text-danger font-weight-bold mt-4 text-center">', "Fields cannot be empty",'</h3>';
                            echo '<div class="mb-3"></div>';
                        }
                    }

                    ?>

                    <div class="mt-5"></div>
                    <div class="form-group">
                        <label for="title" class="control-label col-sm-10">Title</label>

                        <div class="col-md-11">
                            <input class="form-control" type="text" id="title" name="title" value="<?php echo $title; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-10">Teaser</label>

                        <div class="col-md-11">
                            <input class="form-control" type="text" id="teaser" name="teaser" value="<?php echo $teaser; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-10">Body</label>

                        <div class="col-md-11">
                            <textarea class="form-control" id="editor" name="editor" rows="12" > <?php echo $body; ?> </textarea>
                        </div>
                    </div>

                    <div class="mt-5"></div>

                    <div class="row">


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-sm-10">Blog Category</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="blog_cat_id" name="blog_cat_id" value="<?php echo $blog_cat_id; ?>">
                                </div>
                            </div>
                        </div>
                   
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-sm-10">Read Time</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="read_time" name="read_time" value="<?php echo $read_time; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-sm-10">Is Featured?</label>
                                <div class="col-md-10">
                                    <input type="checkbox" id="isFeatured" name="isFeatured"  value="<?php echo $isFeatured; ?>">
                                </div>
                            </div>
                        </div>

                    </div>



                    <td><input type="hidden" name="id" value=<?php echo $id; ?>></td>

                    <div class="mt-5"></div>
                    <div class="form-group text-center">
                        <button type="submit" class="button button-a button-big button-rouded" name="update" value="Update">Edit Post</button>
                        <a href="allPosts.php" class="text-info pl-2">
                            Go Back To All Posts
                        </a>

                    </div>

            </form>

        </div>


    <?php
}
    ?>
    <script src="ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace("editor")
    </script>
    </main>

    <?php
    include 'includes/footer.php';
    ?>