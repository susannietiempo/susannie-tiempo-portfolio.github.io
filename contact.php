<?php
include "includes/header.php";
$pageTitle = "Contact page processing";

?>

<main id="main">


    <div class="intro intro-single route bg-image" style="background-image: url(assets/img/spaceoverlay.png)">
        <div class="overlay-mf"></div>
        <div class="intro-content display-table">
            <div class="table-cell">
                <div class="container">
                    <h2 class="intro-title mb-4">Contact</h2>
                    <ol class="breadcrumb d-flex justify-content-center">
                        <li class="breadcrumb-item">
                            <a href="allPosts.php">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Contact Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>



    <main id="main">

        <section class="blog-wrapper sect-pt4">
            <div class="container">
                <div class="row">
                    <div class="title-box text-center">
                        <h3 class="title-a">
                            Awesome! You dropped by!
                        </h3>
                        <div class="line-mf"></div>

                        <?php
                        if (isset($_POST['Email'])) {

                            // contact info
                            $email_to = "susannie.tiempo@gmail.com";
                            $email_subject = "New message - Portfolio Contact Page";

                            function problem($error)
                            {
                                echo '<div class="text-center mt-5">';
                                echo '<p class="text-center" style="color:black; font-size:150%; font-weight:bold">' . "Opps we hit a snag here. " . '</p>';
                                echo '<p class="lead text-center mb-5">' . "Just fix the errors showing below and we should be good to go!<br><br>" . '</p>';
                                echo '<p class="text-danger">' . $error . '</p>' . "<br><br>";
                                echo '</div>';
                                echo '<div class="col-md-12 text-center mt-5">';
                                echo '<a class="btn btn-warning" href="index.php#contact" role="button">'.'Go Back to Home Page'.'</a>';
                                echo '</div>';
                                die();
                            }

                            // validation expected data exists
                            if (
                                !isset($_POST['Subject']) ||
                                !isset($_POST['Name']) ||
                                !isset($_POST['Email']) ||
                                !isset($_POST['Message'])
                            ) {
                                problem('We are sorry, but there appears to be a problem with the form you submitted.');
                            }

                            $name = $_POST['Name']; // required
                            $email = $_POST['Email']; // required
                            $message = $_POST['Message']; // required
                            $subject = $_POST['Subject']; // required

                            $error_message = "";

                            $string_exp = "/^[A-Za-z .'-]+$/";

                            if (!preg_match($string_exp, $name)) {
                                $error_message .= 'Please enter a valid name.<br>';
                            }

                            if (strlen($message) < 2) {
                                $error_message .= 'A message is required.<br>';
                            }

                            if (strlen($subject) < 2) {
                                $error_message .= 'Please enter an email subject.<br>';
                            }

                            if (strlen($error_message) > 0) {
                                problem($error_message);
                            }

                            $email_message = "Form details below.\n\n";

                            function clean_string($string)
                            {
                                $bad = array("content-type", "bcc:", "to:", "cc:", "href");
                                return str_replace($bad, "", $string);
                            }

                            $email_message .= "Name: " . clean_string($name) . "\n";
                            $email_message .= "Email: " . clean_string($email) . "\n";
                            $email_message .= "Subject: " . clean_string($subject) . "\n";
                            $email_message .= "Message: " . clean_string($message) . "\n";


                            // create email headers
                            $headers = 'From: ' . $email . "\r\n" .
                                'Reply-To: ' . $email . "\r\n" .
                                'X-Mailer: PHP/' . phpversion();

                            @mail($email_to, $email_subject, $email_message, $headers) or die("Error!");
                        ?>


                            <div class="text-center mt-5">
                                <p class="text-center" style="color:black; font-size:150%; font-weight:bold">
                                    Thank you for sending me message!
                                </p>
                                <p class="lead text-center mb-5">
                                    I will connect with you soon!
                                </p>
                            </div>

                            <div class="col-md-12 text-center mt-5">
                            <a class="btn btn-warning" href="index.php" role="button">Go Back to Home Page</a>
                            </div>

                        <?php
                        }
                        ?>

                    </div>
                </div>



            </div>
        </section>

    </main>

    <?php
    include "includes/footer.php";
    ?>























    <?php
    if (isset($_POST['Email'])) {

        // contact info
        $email_to = "susannie.tiempo@gmail.com";
        $email_subject = "New message - Portfolio Contact Page";

        function problem($error)
        {
            echo "Opps we hit a snag here. ";
            echo "Just fix the errors showing below and we should be good to go!<br><br>";
            echo $error . "<br><br>";
            die();
        }

        // validation expected data exists
        if (
            !isset($_POST['Subject']) ||
            !isset($_POST['Name']) ||
            !isset($_POST['Email']) ||
            !isset($_POST['Message'])
        ) {
            problem('We are sorry, but there appears to be a problem with the form you submitted.');
        }

        $name = $_POST['Name']; // required
        $email = $_POST['Email']; // required
        $message = $_POST['Message']; // required
        $subject = $_POST['Subject']; // required

        $error_message = "";

        $string_exp = "/^[A-Za-z .'-]+$/";

        if (!preg_match($string_exp, $name)) {
            $error_message .= 'Please enter a valid name.<br>';
        }

        if (strlen($message) < 2) {
            $error_message .= 'A message is required.<br>';
        }

        if (strlen($subject) < 2) {
            $error_message .= 'Please enter an email subject.<br>';
        }

        if (strlen($error_message) > 0) {
            problem($error_message);
        }

        $email_message = "Form details below.\n\n";

        function clean_string($string)
        {
            $bad = array("content-type", "bcc:", "to:", "cc:", "href");
            return str_replace($bad, "", $string);
        }

        $email_message .= "Name: " . clean_string($name) . "\n";
        $email_message .= "Email: " . clean_string($email) . "\n";
        $email_message .= "Subject: " . clean_string($subject) . "\n";
        $email_message .= "Message: " . clean_string($message) . "\n";


        // create email headers
        $headers = 'From: ' . $email . "\r\n" .
            'Reply-To: ' . $email . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        @mail($email_to, $email_subject, $email_message, $headers) or die("Error!");
    ?>

        <!-- include your success message below -->

        <div>
            <p> Thank you for contacting me! I will reply to you soon!</p>
        </div>

    <?php
    }
    ?>
    </div>