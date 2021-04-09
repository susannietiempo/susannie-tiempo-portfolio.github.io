<?php

$pageTitle = 'Login';
include 'includes/header.php';
?>

<main  id="main" class="container">
    <div class="mt-5"></div>
    <?php
    //if the user is registered, show a message
    if (isset($_SESSION['username'])) {
        echo '<div class="mt-3"></div>';
        echo "You are logged in as ", $_SESSION['username'];
        echo '<div class="mt-2"></div>';
        echo "<br><a href='allPosts.php'> View Posts </a>";
    } else if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            // store escaped $_Post values in variables
            $username = htmlentities($_POST['username']);
            $password = htmlentities($_POST['password']);

            $dbName = connect('susannie_tiempo_portfolio');
            $authId = getLoggedInId($dbName, $username, $password);

            if ($authId > 0) {
                $_SESSION['username'] = $username;
                $_SESSION['authId'] = $authId;
                header("Location: index.php"); 
                exit();
            } else {
                echo '<p class="text-danger font-weight-bold mt-4">Incorrect username or password.</p>';
            }
        } else {
            echo '<p class="text-danger font-weight-bold mt-4">Please fill out both fields</p>';
        } 

    } else {
        if (isset($_GET['logout'])) {
            if ($_GET['logout'] == 1) {
               
            }
        }
    }

    ?>

<?php

if (!isset($_SESSION['username']))  {
    ?>

<div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 login-section-wrapper">
          <div class="brand-wrapper">
          <a class="navbar-brand js-scroll" href="index.php"> <img src="../myPortfolio/assets/img/logoblack.png" alt="logo" > </a>
          </div>
          <div class="login-wrapper my-auto">
            <h1 class="login-title">Log in</h1>
            <form action="login.php" method="post">
              <div class="form-group">
              <label for="username">Username:</label>
                <input type="text" name="username" class="form-control" placeholder="enter your username">
              </div>
              <div class="form-group mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="enter your passsword">
              </div>
              <button type="submit" class="btn btn-block login-btn" >Login</button>
            </form>
           
          </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="../myPortfolio/assets/img/space.png" alt="login image" class="login-img">
        </div>
      </div>
    </div>


<?php
}
?>
    
</main>

