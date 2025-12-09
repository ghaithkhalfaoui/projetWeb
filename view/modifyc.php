<?php
include '../model/updateCountryModule.php';
include '../controller/updateCountryControler.php';

$cond = ($_POST['cond']);
$mc = new countryc();
$m = new country($_POST['country'],$_POST['locationX'],$_POST['loactionY'],$_POST['locationZ'],$_POST['idpost']);
$mc->updatecountry($m,$cond);
$newURL = "./dashboard.php"; 
header("Location: " . $newURL);
?>