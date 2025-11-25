<?php
include '../model/updateCountryModule.php';
include '../controller/updateCountryControler.php';

$mc = new countryc();
$m = new country($_POST['country'],0,0,0);
$mc->deletecountry($m->getname());
$newURL = "./updateCountry.php"; 
header("Location: " . $newURL);
?>