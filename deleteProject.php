<?php
include "includes/header.php";

$pageTitle = "Delete Project";


 
//getting id of the data from url
$id = $_GET['id'];
 
$dbLink = connect('susannie_tiempo_portfolio');
//deleting the row from table
$result = mysqli_query($dbLink, "DELETE FROM project WHERE id=$id");
 
//redirecting to the display page (index.php in our case)
header("Location:allProjects.php");

?>