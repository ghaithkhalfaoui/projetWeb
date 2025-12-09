<?php

include '../config.php' ;

class modelc{

public function addmodel($p) {

$db = config::getConnexion();  
try {
    $req = $db->prepare('INSERT INTO module VALUES (:m,:lx,:ly,:lz)');
    $req->execute([
        'm'=> $p->getpath(),
        'lx'=> $p->getlocX(),
        'ly'=> $p->getlocY(),
        'lz'=> $p->getlocZ()
    ]);
   
} 
 catch (Exeption $e){
        die('error:' .$e->getMessage());
    }
}

public function updatemodel($p,$cond) {

$db = config::getConnexion();  
try {
    $req = $db->prepare('UPDATE module set ModleDesign = :m,locationX = :lx, locationY = :ly, locationZ = :lz WHERE ModleDesign = :p');
    $req->execute([
        'm'=> $p->getpath(),
        'lx'=> $p->getlocX(),
        'ly'=> $p->getlocY(),
        'lz'=> $p->getlocZ(),
        'p'=> $cond
    ]);
  
} 
 catch (Exeption $e){
        die('error:' .$e->getMessage());
    }
  }


public function deletemodel($p){
try {
    $db = config::getConnexion();  
    $req = $db->prepare("DELETE FROM module WHERE  ModleDesign = :m;");
    $req->execute([
        'm'=> $p,
    ]);
} 
 catch (Exeption $e){
        die('error:' .$e->getMessage());
    }
}
}

