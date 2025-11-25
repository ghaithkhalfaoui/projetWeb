<?php
include '../model/updatemoduleModule.php';
include '../controller/updatemoduleController.php';

$mc = new modelc();
$cond = ($_POST['cond']);
$m = new model($_POST['path'],$_POST['locationX'],$_POST['loactionY']);
$mc->updatemodel($m,$cond);
$newURL = "./updateModule.php"; 
header("Location: " . $newURL);
?>