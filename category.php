<?php  // THIS DISPLAYS THE CATEGORY PAGE
require_once("includes/header.php");
    if(!isset($_GET["id"])){
        ErrorMessage::show("No ID PASSED TO PAGE");
    }
$preview = new PreviewProvider($con, $userLoggedIn);  // Instance of the class
echo $preview->createCategoryPreviewVideo($_GET["id"]);

$containers = new CategoryContainers($con, $userLoggedIn);
echo $containers->showCategory($_GET["id"]);
?>