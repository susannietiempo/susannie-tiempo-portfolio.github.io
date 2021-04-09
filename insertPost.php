<?php
$pageTitle = 'Insert Post';
include 'includes/header.php';
?>

<?php
if (!isset($_SESSION['username'])) {
    redirect_to('login.php');
} else {
?>

    <div class="intro intro-single route bg-image" style="background-image: url(assets/img/overlay-bg.jpg)">
        <div class="overlay-mf"></div>
        <div class="intro-content display-table">
            <div class="table-cell">
                <div class="container">
                    <h2 class="intro-title mb-4">Create New Post</h2>
                    <ol class="breadcrumb d-flex justify-content-center">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="allPosts.php">Blogs</a>
                        </li>
                        <li class="breadcrumb-item active">Create Blog</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <main id="main" style="background-color: white;">
        <div class="container">

            <div class="col-md- col-lg-8 col-xl-8 offset-lg-2">

                <?php

                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    $title = $_POST['title'];
                    $teaser = $_POST['teaser'];
                    $body = $_POST['body'];
                    $author_id = $_SESSION['authId'];
                    $blog_cat = $_POST['category'];
                    $read_time =  $_POST['read_time'];

                    if (isset($_POST['isFeatured'])) {
                        $isFeatured = $_POST['isFeatured'];
                    } else {
                        //$stok is nog checked and value=0
                        $isFeatured = 0;
                    }

                    if (!empty($title) && !empty($teaser) && !empty($body) && !empty($author_id) && $blog_cat != 0) {
                        $dbLink = connect('susannie_tiempo_portfolio');
                        $msg = insertPost($dbLink, $title, $teaser, $body, $author_id, $blog_cat, $read_time, $isFeatured);
                        echo '<div class="mt-5"></div>';
                        echo '<div class="text-center mt-5">';
                        echo '<p class="text-center" style="color:black; font-size:150%; font-weight:bold">' . "Blog is successfully created" . '</p>';
                        echo '<p class="text-success lead text-center">' . $msg . '</p>' . "<br><br>";
                        echo '</div>';
                        echo '<div class="col-md-12 text-center mt-5">';
                        echo '<a class="btn btn-warning" href="allPosts.php" role="button">'.'Go Back to All Blogs'.'</a>';
                        echo '</div>';
                        echo '<div class="mb-5"></div>';
                        $dbLink->close();
                    } else {
                        echo '<div class="mt-5"></div>';
                        echo '<div class="text-center mt-5">';
                        echo '<p class="text-center" style="color:black; font-size:150%; font-weight:bold">' . "Opps we hit a snag here. " . '</p>';
                        echo '<p class="text-danger">' . 'Fields cannot be empty.' . '</p>' . "<br><br>";
                        echo '</div>';
                        echo '<div class="col-md-12 text-center mt-5">';
                        echo '<a class="btn btn-warning" href="insertPost.php" role="button">'.'Go Back'.'</a>';
                        echo '</div>';
                        echo '<div class="mb-5"></div>';
                    }
                } else {

                ?>

                    <form action="insertPost.php" method="POST">
                        <div class="form-horizontal " style="padding: 5%;">
                            <h3 class="headline text-center">Blog Details</h3>

                            <div class="mt-5"></div>
                            <div class="form-group">
                                <label for="title" class="control-label col-sm-10 font-weight-bold">Title</label>

                                <div class="col-md-11">
                                    <input class="form-control" type="text" id="title" name="title">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-10 font-weight-bold">Teaser</label>

                                <div class="col-md-11">
                                    <input class="form-control" type="text" id="teaser" name="teaser">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-10 font-weight-bold">Body</label>

                                <div class="col-md-11">
                                    <textarea class="form-control" id="body" name="body" rows="12"></textarea>
                                </div>
                            </div>

                            <div class="mt-5"></div>
                            <div class="row">

                                <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-sm-10">Skill Category</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="skill_cat_id" name="skill_cat_id">
                                </div>
                            </div>
                        </div> -->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-10 font-weight-bold">Blog Category</label>
                                        <div class="col-md-10">

                                            <?php
                                            $dbLink = connect('susannie_tiempo_portfolio');
                                            $sql = "SELECT * FROM blog_category WHERE id > 0";
                                            $results = $dbLink->query($sql);


                                            ?>
                                            <select class="form-control" id="category" name="category">
                                                <option value="0">Select a Category</option>

                                                <?php
                                                $id = 0;

                                                if (!empty($_POST['category'])) {
                                                    $id = $_POST['category'];
                                                }
                                                while ($row = $results->fetch_assoc()) {
                                                    if ($row['id'] == $id) {
                                                        $selected = "selected='selected'";
                                                    } else {
                                                        $selected = "";
                                                    }
                                                ?>
                                                    <option value="<?php echo $row['id'] ?>" <?php echo $selected; ?>>
                                                        <?php echo $row['category_name'] ?>

                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>


                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="mt-5"></div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-10 font-weight-bold">Read Time</label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text" id="read_time" name="read_time">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-10 font-weight-bold">Is Featured?</label>
                                        <div class="col-md-10">
                                            <input type="checkbox" id="isFeatured" name="isFeatured" value="1">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="mt-5"></div>
                            <div class="form-group text-center">
                                <button type="submit" class="button button-a button-big button-rouded">Create Post</button>
                                <a href="allPosts.php">
                                    <button type="reset" class="btn btn-link ">Cancel</button>
                                </a>
                            </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    <?php
}
    ?>

    </main>
    <script src="ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace("body")
    </script>
    </main>

    <?php
    include 'includes/footer.php';
    ?>