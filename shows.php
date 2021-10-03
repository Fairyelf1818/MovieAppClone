<?php  // THIS DISPLAYS THE TV SHOW PAGE
require_once("includes/header.php");
$preview = new PreviewProvider($con, $userLoggedIn);  // Instance of the class
echo $preview->createTVShowPreviewVideo();

$containers = new CategoryContainers($con, $userLoggedIn);
echo $containers->showTVShowCategories();
?>