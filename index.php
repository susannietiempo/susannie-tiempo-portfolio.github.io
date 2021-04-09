<?php
include "includes/header.php";

$pageTitle = "home";
?>

<!-- ======= Intro Section ======= -->
<div id="home" class="intro route bg-image" style="background-image: url(./assets/img/4.png)">
  <div id="particles-js" class="overlay-itro"></div>
  <div class="intro-content display-table">
    <div class="table-cell">
      <div class="container">
        <h1 class="intro-title mb-4">susannie.is()</h1>
        <p class="intro-subtitle text-warning"><span class="text-slider-items">.web_developer, .mobile.developer, .backend_developer, .fullStack_developer, .perpetual_space_explorer</span><strong class="text-slider"></strong></p>
      </div>
    </div>
  </div>
</div><!-- End Intro Section -->

<main id="main">

  <!-- ======= About  Me Section ======= -->
  <section id="about" class="about-mf sect-pt4 route">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="title-box text-center">
            <h3 class="title-a">
              Why choose me?
            </h3>
            <p class="subtitle-a">
              I am committed to delivering exceptional results and help you provide your customers the value they deserve.
            </p>
            <div class="line-mf"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="box-shadow-full">
            <div class="row">
              <div class="col-md-6">
                <div class="row">
                  <div class="col-sm-6 col-md-5">
                    <div class="about-img">
                      <img src="assets/img/susannie.png" class="img-fluid rounded b-shadow-a" alt="">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="about-me pt-4 pt-md-0">
                  <div class="title-box-2">
                    <h1>
                      <span style="font-weight:900; font-size:150%;  color:  #E0A814"> Susannie </span>
                      <span style="font-weight:900; font-size:150%; font-family:'Londrina Outline', Verdana, Geneva, Tahoma, sans-serif;">
                        Tiempo
                      </span>
                    </h1>
                    <p class="title-s">Full-Stack Developer</p>
                  </div>


                  <p style="font-weight:900; font-size:150%; font-family:'Montserrat', sans-serif; color:black">
                    <span style="font-weight:900; font-size:120%;  "> Dedicated </span> to providing value to your clients.
                  </p>

                </div>

              </div>
              <div class="col-md-6 ">
                <div class="skill-mf">
                  <p class="title-s">Skills</p>
                  <span>Deskstop Development</span> <span class="pull-right">90%</span>
                  <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 90%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <span>Web Development</span> <span class="pull-right">85%</span>
                  <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <span>Mobile Development</span> <span class="pull-right">85%</span>
                  <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <span>Project Management</span> <span class="pull-right">92%</span>
                  <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 92%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <div class="mt-5"></div>
                  <div class="col-md-12 text-center">
                    <a class="button button-a button-big button-rouded" href="assets/files/SvotResume.pdf" target='_blank'>Downdload Resume</a>
                  </div>
                </div>

              </div>

              <div class="col-md-6">
                <div class="about-me pt-4 pt-md-0">

                  <p style="font-size:250%; font-family:'Amatic SC', cursive; color:gray">
                    "If you can't do it the first time, do it again. And again until you get it right. Success is not a straight line."
                  </p>
                  <p class="mt-5">
                    Feel free to explore my work and contact me if you have any questions!
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>

  <section id="work" class="portfolio-mf sect-pt4 route">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="title-box text-center">
            <h3 class="title-a">
              Latest Projects
            </h3>
            <p class="subtitle-a">
              Check out my latest projects in web design and mobile, web, and desktop development!
            </p>
            <div class="line-mf"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <!--  Portfolio Search Section -->
        <div class="widget-sidebar sidebar-search">
          <h5 class="sidebar-title">Search</h5>
          <div class="justify-content-center ">
            <form action="allProjects.php" method="POST" class="form-inline">
              <div class="input-group">
                <label for="" class="mr-3 ml-5 title-s"> Find by Project Name / Category / Skill </label>
                <input type="text" class="form-control col-lg-12 " name="searchstring" placeholder="Search for..." aria-label="Search for...">
                <div class="ml-5"></div>
                <a href="allProjects.php"><button class="btn btn-secondary btn-search" type="submit"> Search
                    <div class="ml-5"></div>
              </div>
            </form>
          </div>
        </div>

        <!--  End Portfolio Search Section -->
        <?php

        $sql = "SELECT project.id, project.title, project_date, project_category.name, file_path
        FROM project 
        INNER JOIN images ON images.project_id = project.id
        INNER JOIN project_category ON project_category.id = project.cat_id
        WHERE isFeatured = true AND isFeaturedImage = true   
        ORDER BY project_date DESC LIMIT 4";

        $dbLink = connect('susannie_tiempo_portfolio');
        $result = $dbLink->query($sql);

        while ($row = $result->fetch_assoc()) {
        ?>
          <div class="col-md-6">
            <div class="work-box">
              <a href="<?php echo $row['file_path'] ?>" data-gall="portfolioGallery" class="venobox">
                <div class="work-img">
                  <img src="<?php echo $row['file_path'] ?>" alt="" class="img-fluid">
                </div>
              </a>
              <div class="work-content">
                <div class="row">
                  <div class="col-sm-8">
                    <h2 class="w-title"><?php echo $row['title'] ?></h2>
                    <div class="w-more">
                      <span class="w-ctegory"><?php echo $row['name'] ?></span> / <span class="w-date"><?php $date = strtotime($row['project_date']);
                                                                                                        echo date('F d, Y', $date);; ?></span>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="w-like">
                      <a href="portfolio-details.php?id=<?php echo $row['id']; ?>"> <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php
        }

        $result->close();
        $dbLink->close();

        ?>

      </div>
    </div>
  </section>
  <!-- End Portfolio Section -->


  <section id="blog" class="blog-mf sect-pt4 route">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="title-box text-center">
            <h3 class="title-a">
              Blog
            </h3>
            <p class="subtitle-a">
              Read about my thoughts on topics that I am interested in!
            </p>
            <div class="line-mf"></div>
          </div>
        </div>
      </div>


      <div class="row">
        <?php

        $sql = "SELECT blog_article.id, title, date_created, teaser, category_name, read_time, CONCAT(fname, ' ', lname) AS fullName, file_path 
          FROM blog_article 
          INNER JOIN users ON blog_article.user_id = users.id
          INNER JOIN blog_category ON blog_article.blog_cat_id = blog_category.id
          INNER JOIN images ON blog_article.id = images.blog_id
          WHERE  blog_article.isFeatured = true 
		      ORDER BY  blog_article.date_created DESC
		      LIMIT 3";
        $dbLink = connect('susannie_tiempo_portfolio');
        $result = $dbLink->query($sql);

        while ($row = $result->fetch_assoc()) {
        ?>
          <div class="col-md-4">
            <div class="card card-blog">
              <div class="card-img">
                <a href="blog-single.php?id=<?php echo $row['id']; ?>"><img src="<?php echo $row['file_path'] ?>" alt="" class="img-fluid"></a>
              </div>
              <div class="card-body">
                <div class="card-category-box">
                  <div class="card-category">
                    <h6 class="category"><?php echo $row['category_name'] ?></h6>
                  </div>
                </div>
                <h3 class="card-title"><a href="blog-single.php"><?php echo $row['title'] ?></a></h3>
                <p class="card-description">
                  <?php echo $row['teaser'] ?>
                </p>
              </div>
              <div class="card-footer">
                <div class="post-author">
                  <span class="ion-pricetag"></span> <?php $date = strtotime($row['date_created']);
                                                      echo date('F d, Y', $date); ?>
                </div>
                <div class="post-date">
                  <span class="ion-ios-clock-outline"></span> <?php echo $row['read_time'] ?> min
                </div>
              </div>
            </div>
          </div>


        <?php
        }

        $result->close();
        $dbLink->close();

        ?>

        <!-- End php -->
      </div>
    </div>
  </section><!-- End Blog Section -->

  <!-- ======= Contact Section ======= -->
  <section class="paralax-mf footer-paralax bg-image sect-mt4 route" style="background-image: url(assets/img/spaceoverlay3.png)">
    <div class="overlay-mf"></div>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="contact-mf">
            <div id="contact" class="box-shadow-full">
              <div class="row">

                <div class="col-md-12 ">
                  <div>
                    <h5 class="title-left  text-center  mb-5">
                      Knock up my Inbox
                    </h5>
                  </div>
                  <div>
                    <p class="text-center" style="color:black; font-size:150%; font-weight:bold">
                      Need help with your project?
                    </p>
                    <p class="lead text-center mb-5">
                      Feel free to drop me a message!
                    </p>
                  </div>
                </div>

                <div class="col-md-12">
                  <form action="contact.php" method="post" role="form" class=" ml-5 mr-5">
                    <div class="row">
                      <div class="col-md-12 mb-3">
                        <div class="form-group">
                          <input type="text" name="Name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                          <div class="validate"></div>
                        </div>
                      </div>
                      <div class="col-md-12 mb-3">
                        <div class="form-group">
                          <input type="email" class="form-control" name="Email" id="Email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                          <div class="validate"></div>
                        </div>
                      </div>
                      <div class="col-md-12 mb-3">
                        <div class="form-group">
                          <input type="text" class="form-control" name="Subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                          <div class="validate"></div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <textarea class="form-control" name="Message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                          <div class="validate"></div>
                        </div>
                      </div>
                      <div class="col-md-12 text-center">
                        <button type="submit" class="button button-a button-big button-rouded">Send Your Message</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- end of row-->
  </section><!-- End Contact Section -->

</main><!-- End #main -->

<?php
include "includes/footer.php";
?>