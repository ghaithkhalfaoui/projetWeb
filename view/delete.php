<?php
include '../model/updatemoduleModule.php';
include '../controller/updatemoduleController.php';

$mc = new modelc();
$m = new model($_POST['path'],0,0);
$mc->deletemodel($m->getpath());
$newURL = "./updateModule.php"; 
header("Location: " . $newURL);
?>