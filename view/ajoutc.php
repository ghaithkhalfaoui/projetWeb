<?php
include '../model/updateCountryModule.php';
include '../controller/updateCountryControler.php';

$mc = new countryc();
$m = new country($_POST['country'],$_POST['locationX'],$_POST['loactionY'],$_POST['locationZ'],$_POST['idpost']);
$mc->addcountry($m);


$newURL = "./dashboard.php"; 
header("Location: " . $newURL);
?>