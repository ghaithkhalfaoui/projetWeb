<?php
include '../model/updateCountryModule.php';
include '../controller/updateCountryControler.php';

$mc = new countryc();
$m = new country($_POST['country'],$_POST['locationX'],$_POST['loactionY'],$_POST['idpost']);
$mc->addcountry($m);


$newURL = "./updateCountry.php"; 
header("Location: " . $newURL);
?>