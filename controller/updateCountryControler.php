<?php

include '../config.php' ;

class countryc{

public function addcountry($p) {

$db = config::getConnexion();  
try {
    $req = $db->prepare('INSERT INTO country VALUES (:n,:lx,:ly,:p)');
    $req->execute([
        'n'=> $p->getname(),
        'lx'=> $p->getlocX(),
        'ly'=> $p->getlocY(),
        'p'=> $p->getpost()
    ]);
   
} 
 catch (Exeption $e){
        die('error:' .$e->getMessage());
    }
}

public function updatecountry($p,$cond) {

$db = config::getConnexion();  
try {
    $req = $db->prepare('UPDATE country set countryName = :n,locationX = :lx, locationY = :ly, idPost = :p WHERE countryName = :c');
    $req->execute([
        'n'=> $p->getname(),
        'lx'=> $p->getlocX(),
        'ly'=> $p->getlocY(),
        'p'=> $p->getpost(),
        'c'=> $cond
    ]);
  
} 
 catch (Exeption $e){
        die('error:' .$e->getMessage());
    }
  }


public function deletecountry($p){
try {
    $db = config::getConnexion();  
    $req = $db->prepare("DELETE FROM country WHERE  countryName = :n;");
    $req->execute([
        'n'=> $p,
    ]);
} 
 catch (Exeption $e){
        die('error:' .$e->getMessage());
    }
}
}

