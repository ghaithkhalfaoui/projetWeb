<?php
include '../model/updateCountryModule.php';
include '../controller/updateCountryControler.php';

$mc = new countryc();
$m = new country($_POST['country'],0,0,0,0);
$mc->deletecountry($m->getname());
$newURL = "./dashboard.php"; 
header("Location: " . $newURL);
?>