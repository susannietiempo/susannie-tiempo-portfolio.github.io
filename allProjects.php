<?php
$pageTitle = 'All Blogs';
include 'includes/header.php';
?>

<div class="intro intro-single route bg-image" style="background-image: url(assets/img/spaceoverlay.PNG)">
    <div class="overlay-mf"></div>
    <div class="intro-content display-table">
        <div class="table-cell">
            <div class="container">
                <h2 class="intro-title mb-4">Project List</h2>
                <ol class="breadcrumb d-flex justify-content-center">
                    <li class="breadcrumb-item">
                        <a href="index.php">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="allProjects.php">Projects</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<main id="main">
    <div class="intro-content display-table " style="background-color: white;">
        <div class="table-cell">
            <div class="container p-5" style="background-color: white;">

                <div class="form-wrapper">
                    <div class="heading text-center">
                        <h2> All Projects</h2>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="widget-sidebar sidebar-search">
                                    <h5 class="sidebar-title">Search</h5>
                                    <div class="sidebar-content">
                                        <form class="form-inline" action="allProjects.php" method="POST">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="searchstring" placeholder="Search by project title, category or skill" aria-label="Search for...">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-secondary btn-search" type="submit">
                                                        <span class="ion-android-search"></span>
                                                    </button>

                                                </span>


                                            </div>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <?php
                                if (isset($_SESSION['username'])) {
                                ?>
                                    <div style="margin-top: 20%;"></div>

                                    <a href="insertProject.php">
                                        <button class="btn btn-warning">Create New Project</button>
                                    </a>
                            </div>
                        <?php
                                }
                        ?>
                        </div>
                    </div>

                    <?php
                    $conn = connect('susannie_tiempo_portfolio');
                    if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['searchstring'])) {
                        $searchString = $_POST['searchstring'];
                        $results = getAllProjectsBySearch($conn, $searchString);
                    } else {
                        $results = getAllProjects($conn);
                    }

                    if (!isset($results) || empty($results)) {
                        echo '<h2 class="text-warning">' . 'There is no projects to show.' . '<h2>';
                    } else {
                    ?>
                        <div class="table-responsive-lg">
                            <table class="table table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th>
                                            Post Id
                                        </th>
                                        <th>
                                            Title
                                        </th>
                                        <th> Github Link</th>
                                        <th> Featured?</th>
                                        <th> Actions</th>
                                    </tr>
                                </thead>
                                <tr>

                                    <?php
                                    foreach ($results as $row) {
                                        echo "
                                        <tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['title'] . "</td>";
                                        echo "<td>" . '<a href=' . $row['github_url'] . '>' . "LINK" . '</a>' . "</td>";
                                        if ($row['isFeatured'] == 0) {
                                            echo "<td>" . 'False' . "</td>";
                                        } else {
                                            echo "<td>" . 'True' . "</td>";
                                        }
                                        echo "<td><a href=\" portfolio-details.php?id=$row[id]\">View</a>";
                                        if (isset($_SESSION['username'])) {
                                            echo "| <a href=\"editProject.php?id=$row[id]\">Edit</a> | <a href=\"deleteProject.php?id=$row[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
                                        }

                                        echo "</tr>";

                                        $_SESSION['project_id_edit'] = $row['id'];
                                    }
                                    $conn->close();
                                    ?>
                                </tr>

                            </table>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>
    </div>



</main>

<?php

include 'includes/footer.php';
?>