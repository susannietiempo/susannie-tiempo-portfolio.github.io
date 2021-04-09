<?php
include "includes/header.php";

$pageTitle = "delete";


 
//getting id of the data from url
$id = $_GET['id'];
 
$dbLink = connect('susannie_tiempo_portfolio');
//deleting the row from table
$result = mysqli_query($dbLink, "DELETE FROM blog_article WHERE id=$id");
 
//redirecting to the display page (index.php in our case)
header("Location:allPosts.php");

?>