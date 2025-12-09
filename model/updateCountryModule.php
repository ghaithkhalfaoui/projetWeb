<?php
class country{

private string $name;
private int $locationX;
private int $locationY;
private int $locationZ;
private int $idPost;


public function __construct(string $n, int $lx, int $ly, int $lz, int $p){
    $this->name =$n;
    $this->locationX =$lx;
    $this->locationY =$ly;
    $this->locationZ =$lz;
    $this->idPost =$p;

}
 public function getname(): string {
        return $this->name;
    }

    public function setname(string $name): void {
        $this->name = $name;
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

    public function setlocY(int $locationY): void {
        $this->locationY= $locationY;
    }

    public function getlocZ(): int {
        return $this->locationZ;
    }

    public function setlocZ(int $locationZ): void {
        $this->locationZ= $locationZ;
    }

    public function getpost(): int {
        return $this->idPost;
    }

    public function setpost(int $idPost): void {
        $this->idPost = $idPost;
    }
}