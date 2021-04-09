<?php
include "includes/header.php";
$pageTitle = "Portfolio Details";

?>



<div class="intro intro-single route bg-image" style="background-image: url(assets/img/spaceoverlay.png)">
  <div class="overlay-mf"></div>
  <div class="intro-content display-table">
    <div class="table-cell">
      <div class="container">
        <h2 class="intro-title mb-4">Portfolio Details</h2>
        <ol class="breadcrumb d-flex justify-content-center">
          <li class="breadcrumb-item">
            <a href="allProjects.php">Portfolio</a>
          </li>
          <li class="breadcrumb-item active">Portfolio Details</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- =======Start of images PHP======= -->
<?php

$id = isset($_GET['id']) ? intval($_GET['id']) : 1;


$images = array();
$sql = "SELECT id, file_path, project_id FROM images
          WHERE  project_id = $id";
$dbLink = connect('susannie_tiempo_portfolio');

//Images Query
$resultImages = $dbLink->query($sql);
while ($row = $resultImages->fetch_assoc()) {
  array_push($images, $row['file_path']);
}
$resultImages->close();

$dbLink->close();

?>


<main id="main">

  <section class="portfolio-details">
    <div class="container">

      <div class="portfolio-details-container">

        <div class="owl-carousel portfolio-details-carousel">

          <?php foreach ($images as &$img) {
          ?>
            <img src="<?php echo $img ?>" class="img-fluid" alt="">
          <?php } ?>
        </div>

        <?php
        $sql = "SELECT project.id, title, blurb, main_description, github_url, video_demo, project_date, project_category.name
          FROM project 
          INNER JOIN project_category ON project.cat_id  = project_category.id  
          WHERE project.id = $id";
        $dbLink = connect('susannie_tiempo_portfolio');
        $result = $dbLink->query($sql);

        while ($row = $result->fetch_assoc()) {
        ?>
          <!-- =======end of images PHP======= -->
          <div class="portfolio-info">
            <h3>Project information</h3>
            <ul>
              <li><strong>Category</strong>: <?php echo $row['name'] ?></li>
              <li><strong>Project date</strong>: <?php $date = strtotime($row['project_date']);
                                                  echo date('F d, Y', $date);; ?></li>
              <li><strong>GitHUb URL</strong>: <a href="<?php echo $row['github_url'] ?>">Project Link</a></li>
            </ul>
          </div>

      </div>

      <div class="portfolio-description">
        <h2><?php echo $row['title'] ?></h2>
        <p>
          <?php echo $row['main_description'] ?>
        </p>
        <div class="mt-3"></div>
        <h2>Project Demonstration</h2>
        <div class="d-flex justify-content-center">
        <iframe width="560" height="315" src="<?php echo $row['video_demo'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>

      </div>

    </div>
  </section>
  <div class="mt-5"></div>

<?php } ?>

<div class="widget-sidebar widget-tags">
  <h5 class="sidebar-title">Tags</h5>
  <div class="sidebar-content">
    <ul>
      <?php

      $sql = "SELECT  skills.id, skill_name FROM project_skill_joint 
                      INNER JOIN skills  ON skills.id = project_skill_joint.skill_id 
                      WHERE project_skill_joint.project_id  = $id";

      $dbLink = connect('susannie_tiempo_portfolio');
      $result = $dbLink->query($sql);

      while ($row = $result->fetch_assoc()) {
      ?>

        <li>
          <a href="#"><?php echo $row['skill_name']; ?></a>
        </li>
      <?php
      }
      $result->close();
      $dbLink->close();

      ?>
    </ul>
  </div>
</div>
<div class="mt-5"></div>
</main>


<?php

include 'includes/footer.php';
?>