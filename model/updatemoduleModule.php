<?php
class model{

private string $path;
private int $locationX;
private int $locationY;


public function __construct(string $p, int $lx, int $ly){
    $this->path =$p;
    $this->locationX =$lx;
    $this->locationY =$ly;

}
 public function getpath(): string {
        return $this->path;
    }

    public function setpath(string $path): void {
        $this->path = $path;
    }

    public function getlocX(): int {
        return $this->locationX;
    }

    public function setlocX(string $locationX): void {
        $this->locationX = $locationX;
    }

    public function getlocY(): int {
        return $this->locationY;
    }

    public function setlocY(int $locationX): void {
        $this->locationY= $locationY;
    }
    
    
    
    public function listmodel(){
    $db = config::getConnexion();
    try{
        $liste=$db->query('SELECT* FROM module');
        return $liste;
        
    }catch (Exeption $e){
            die('erure:'.$e->getmessage());
        }
   }
}