<?php 
include('protected/config/bootstrap.php');

$frontController=_AutoLoad::getFrontController();
$frontController->listering();
$frontController->run();

?>
