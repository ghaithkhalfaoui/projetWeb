<?php
include '../model/updatemoduleModule.php';
include '../controller/updatemoduleController.php';

$mc = new modelc();
$m = new model($_POST['path'],$_POST['locationX'],$_POST['loactionY']);
$mc->addmodel($m);


$newURL = "./updateModule.php"; 
header("Location: " . $newURL);
?>