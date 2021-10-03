<?php  // THIS DISPLAYS THE MOVIE PAGE
require_once("includes/header.php");
$preview = new PreviewProvider($con, $userLoggedIn);  // Instance of the class
echo $preview->createMoviesPreviewVideo();

$containers = new CategoryContainers($con, $userLoggedIn);
echo $containers->showMovieCategories();
?>