<?php
$pageTitle = 'Insert Project';
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
                    <h2 class="intro-title mb-4">Create New Project</h2>
                    <ol class="breadcrumb d-flex justify-content-center">
                        <li class="breadcrumb-item">
                            <a href="allPosts.php">Portfolio</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Create</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <main id="main" style="background-color: white;">

        <div class="col-md- col-lg-8 col-xl-8 offset-lg-2">

            <?php

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $title = $_POST['title'];
                $blurb = $_POST['blurb'];
                $body = $_POST['body'];
                $github_url = $_POST['github_url'];
                $project_date =  $_POST['project_date'];
                $project_category =  $_POST['project_category'];
                $video_demo =  $_POST['video_demo'];

                if (isset($_POST['isFeatured'])) {
                    $isFeatured = $_POST['isFeatured'];
                } else {
                    //$stok is nog checked and value=0
                    $isFeatured = 0;
                }



                if (!empty($video_demo)  && !empty($title) && !empty($blurb) && !empty($body) && !empty($github_url) && !empty($project_date) && !empty($project_category)) {
                    $dbLink = connect('susannie_tiempo_portfolio');
                    $msg = insertProject($dbLink, $title, $blurb, $body, $github_url, $project_date, $project_category, $isFeatured, $video_demo );
                    echo '<div class="mt-5"></div>';
                    echo '<div class="text-center mt-5">';
                    echo '<p class="text-center" style="color:black; font-size:150%; font-weight:bold">' . "Blog is successfully created" . '</p>';
                    echo '<p class="text-success lead text-center">' . $msg . '</p>' . "<br><br>";
                    echo '</div>';
                    echo '<div class="col-md-12 text-center mt-5">';
                    echo '<a class="btn btn-warning" href="allProjects.php" role="button">' . 'Go Back to All Projects' . '</a>';
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
                    echo '<a class="btn btn-warning" href="insertProject.php" role="button">' . 'Go Back' . '</a>';
                    echo '</div>';
                    echo '<div class="mb-5"></div>';
                }
            } else {


            ?>

                <form action="insertProject.php" method="POST">
                    <div class="form-horizontal " style="padding: 5%;">
                        <h3 class="headline text-center">Project Details</h3>

                        <div class="mt-5"></div>
                        <div class="form-group">
                            <label for="title" class="control-label col-sm-10">Title</label>

                            <div class="col-md-11">
                                <input class="form-control" type="text" id="title" name="title">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-10">Blurb</label>

                            <div class="col-md-11">
                                <input class="form-control" type="text" id="blurb" name="blurb">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-10">Main Description</label>

                            <div class="col-md-11">
                                <textarea class="form-control" id="body" name="body" rows="12"></textarea>
                            </div>
                        </div>

                        <div class="mt-5"></div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-sm-10">Project Category</label>
                                    <div class="col-md-10">
                                        <?php
                                        $dbLink = connect('susannie_tiempo_portfolio');
                                        $sql = "SELECT * FROM project_category WHERE id > 0";
                                        $results = $dbLink->query($sql);


                                        ?>
                                        <select class="form-control" id="project_category" name="project_category">
                                            <option value="0">Select a Category</option>

                                            <?php
                                            $id = 0;

                                            if (!empty($_POST['project_category'])) {
                                                $id = $_POST['project_category'];
                                            }
                                            while ($row = $results->fetch_assoc()) {
                                                if ($row['id'] == $id) {
                                                    $selected = "selected='selected'";
                                                } else {
                                                    $selected = "";
                                                }
                                            ?>
                                                <option value="<?php echo $row['id'] ?>" <?php echo $selected; ?>>
                                                    <?php echo $row['name'] ?>

                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-sm-10">Github URL</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" id="github_url" name="github_url">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-sm-10">Video Demonstration</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" id="video_demo" name="video_demo">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="mt-3"></div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-sm-10">Project Date</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="date" id="project_date" name="project_date">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-sm-10">Is Featured?</label>
                                    <div class="col-md-10">
                                        <input type="checkbox" id="isFeatured" name="isFeatured" value="1">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="mt-5"></div>
                        <div class="form-group text-center">
                            <button type="submit" class="button button-a button-big button-rouded">Create Project</button>
                            <a href="allPosts.php">
                                <button type="reset" class="btn btn-link ">Cancel</button>
                            </a>

                        </div>

                </form>
            <?php } ?>
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