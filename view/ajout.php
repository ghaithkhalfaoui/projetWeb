<?php
include '../model/updatemoduleModule.php';
include '../controller/updatemoduleController.php';

$mc = new modelc();
$m = new model($_POST['path'],$_POST['locationX'],$_POST['loactionY'],$_POST['locationZ']);
$mc->addmodel($m);


$newURL = "./dashboard.php"; 
header("Location: " . $newURL);
?>