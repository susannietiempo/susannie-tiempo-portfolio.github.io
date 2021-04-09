<?php
$pageTitle = 'Edit Project';
include 'includes/header.php';
?>

<?php
if (!isset($_SESSION['username'])) {
    redirect_to('login.php');
} else {
?>
    <?php
    if (isset($_POST['updateProject'])) {
        $id = $_POST['id'];
    } else {
        $id = $_GET['id'];
    }

    $dbLink = connect('susannie_tiempo_portfolio');

    $result = mysqli_query($dbLink, "SELECT id, title, blurb, main_description, github_url, project_date, cat_id, isFeatured FROM project WHERE id = $id");

    while ($res = mysqli_fetch_array($result)) {
        $title = $res['title'];
        $blurb = $res['blurb'];
        $body = $res['main_description'];
        $github_url = $res['github_url'];
        $project_date = $res['project_date'];
        $cat_id = $res['cat_id'];
        $isFeatured = $res['isFeatured'];
    }
    ?>

    <div class="intro intro-single route bg-image" style="background-image: url(assets/img/spaceoverlay.png)">
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
                            <a href="#">Library</a>
                        </li>
                        <li class="breadcrumb-item active">Data</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <main id="main" style="background-color: white;">

        <div class="col-md- col-lg-8 col-xl-8 offset-lg-2">
            <form name="form1" method="post" action="editProject.php">
                <div class="form-horizontal " style="padding: 5%;">
                    <h3 class="headline text-center">Blog Details</h3>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == "POST") {
                        $title = $_POST['title'];
                        $blurb = $_POST['blurb'];
                        $body = $_POST['editor'];
                        $project_date = $_POST['project_date'];
                        $cat_id = $_POST['cat_id'];
                        $github_url = $_POST['github_url'];
                        $video_demo = $_POST['video_demo'];

                        if (isset($_POST['isFeatured'])) {
                            $isFeatured = $_POST['isFeatured'];
                        } else {
                            //$stok is nog checked and value=0
                            $isFeatured = 0;
                        }
                        if (!empty($title) && !empty($blurb) && !empty($body) && !empty($github_url) && !empty($project_date) && !empty($cat_id)) {
                            $sql = "UPDATE project SET title = '$title', blurb = '$blurb', main_description = '$body', github_url = '$github_url', project_date = '$project_date', cat_id = $cat_id, isFeatured=$isFeatured WHERE id = $id";

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
                            echo '<h3 class="text-danger font-weight-bold mt-4 text-center">', "Fields cannot be empty", '</h3>';
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
                        <label class="control-label col-sm-10">Blurb</label>

                        <div class="col-md-11">
                            <textarea class="form-control" id="blurb" name="blurb" rows="5"> <?php echo $blurb; ?> </textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-10">Main Description</label>

                        <div class="col-md-11">
                            <textarea class="form-control" id="editor" name="editor" rows="12"> <?php echo $body; ?> </textarea>
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
                                    <select class="form-control" id="project_category" name="project_category" >
                                       

                                        <?php
                                        $id = 0;

                                        echo  '<option value="0">Select a Category</option>';
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
                                    <input class="form-control" type="text" id="github_url" name="github_url" value="<?php echo $github_url; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-sm-10">Video Demonstration</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="video_demo" name="video_demo" value="<?php echo $video_demo; ?>">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="mt-5"></div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-sm-10">Project Date</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="date" id="project_date" name="project_date" value="<?php echo $project_date; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-sm-10">Is Featured?</label>
                                <div class="col-md-10">
                                    <input type="checkbox" id="isFeatured" name="isFeatured" value="<?php echo $isFeatured; ?>">
                                </div>
                            </div>
                        </div>

                    </div>

                    <td><input type="hidden" name="id" value=<?php echo $id; ?>></td>

                    <div class="mt-5"></div>
                    <div class="form-group text-center">
                        <button type="submit" class="button button-a button-big button-rouded" name="updateProject" value="UpdateProject">Edit Project</button>
                        <a href="allProjects.php" class="text-info pl-2">
                            Go Back To All Projects
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
        CKEDITOR.replace("blurb")
    </script>
    </main>

    <?php
    include 'includes/footer.php';
    ?>