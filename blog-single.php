<?php
include "includes/header.php";
$pageTitle = "blog";

?>


<div class="intro intro-single route bg-image" style="background-image: url(assets/img/spaceoverlay.png)">
  <div class="overlay-mf"></div>
  <div class="intro-content display-table">
    <div class="table-cell">
      <div class="container">
        <h2 class="intro-title mb-4">Blog Details</h2>
        <ol class="breadcrumb d-flex justify-content-center">
          <li class="breadcrumb-item">
            <a href="allPosts.php">Blogs</a>
          </li>
          <li class="breadcrumb-item active">Blog Details</li>
        </ol>
      </div>
    </div>
  </div>
</div>



<main id="main">

  <?php

  //session_start();
  $blogId = isset($_GET['id']) ? intval($_GET['id']) : 1;

  $sql = "SELECT blog_article.id, title, body, date_created, category_name, CONCAT(fname, ' ', lname) AS fullName, file_path 
          FROM blog_article 
          INNER JOIN users ON blog_article.user_id = users.id
          INNER JOIN blog_category ON blog_article.blog_cat_id = blog_category.id
          INNER JOIN images ON blog_article.id = images.blog_id
          WHERE  blog_article.id = $blogId";
  $dbLink = connect('susannie_tiempo_portfolio');
  $result = $dbLink->query($sql);

  function nl2br2($string)
  {
    $string = str_replace(array("\\r\\n", "\\r", "\\n"), "<br />", $string);
    return $string;
  }

  while ($row = $result->fetch_assoc()) {
  ?>

    <section class="blog-wrapper sect-pt4" id="blog">
      <div class="container">
        <div class="row">

          <div class="widget-sidebar sidebar-search">
            <h5 class="sidebar-title">Search</h5>
            <div class="justify-content-center ">
              <form action="allPosts.php" method="POST" class="form-inline">
                <div class="input-group">
                  <label for="" class="mr-3 ml-5 title-s"> Find by Blog Title or Category </label>
                  <input type="text" class="form-control col-lg-12 " name="searchstring" placeholder="Search for..." aria-label="Search for...">
                  <div class="ml-5"></div>
                  <a href="allPosts.php"><button class="btn btn-secondary btn-search" type="submit"> Search
                      <div class="ml-5"></div>
                </div>
              </form>
            </div>
          </div>

          <div class="col-md-8">
            <div class="post-box">
              <div class="post-thumb">
                <img src="<?php echo $row['file_path'] ?>" class="img-fluid" alt="">
              </div>
              <div class="mt-3"></div>
              <div class="post-meta">
                <h1 class="article-title"><?php echo $row['title'] ?></h1>
                <ul>
                  <li>
                    <span class="ion-ios-person"></span>
                    <a href="#"><?php echo $row['fullName'] ?></a>
                  </li>
                  <li>
                    <span class="ion-pricetag"></span>
                    <a href="#"><?php echo $row['category_name'] ?></a>
                  </li>
                  <li>
                    <span class="ion-chatbox"></span>
                    <a href="#"> <?php $date = strtotime($row['date_created']);
                                  echo date('F d, Y', $date); ?></a>
                  </li>
                </ul>
              </div>
              <div class="mt-5"></div>
              <div class="article-content">
                <p>
                  <?php echo nl2br2($row['body']); ?>
                </p>
              </div>
            </div>


          <?php
        }

        $result->close();
        $dbLink->close();

          ?>
          </div>
          <div class="col-md-4">
        
            <div class="widget-sidebar">
              <h5 class="sidebar-title">View Other Posts</h5>

              <div class="sidebar-content">
                <ul class="list-sidebar">

                  <?php

                  $sql = 'SELECT id, title, date_created  
                  FROM blog_article 
                  ORDER BY  date_created DESC
                  LIMIT 5';

                  $dbLink = connect('susannie_tiempo_portfolio');
                  $result = $dbLink->query($sql);

                  while ($row = $result->fetch_assoc()) {
                  ?>

                    <li>
                      <a href="blog-single.php?id=<?php echo $row["id"] ?>"><?php echo $row['title']; ?></a>
                    </li>


                  <?php
                  }

                  $result->close();
                  $dbLink->close();

                  ?>

                </ul>
              </div>

              </div>
          <div class="widget-sidebar widget-tags">
              <h5 class="sidebar-title">Tags</h5>
              <div class="sidebar-content">
                <ul>
                  <?php

                  $sql = "SELECT  skills.id, skill_name FROM blog_skill_joint 
                          INNER JOIN skills  ON skills.id = blog_skill_joint.skill_id 
                          WHERE blog_skill_joint.blog_id  = $blogId";

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

      </div>
            </div>

            
          

          </div>
    
    </section><!-- End Blog Single Section -->

</main><!-- End #main -->

<?php
include "includes/footer.php";
?>