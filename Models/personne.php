<?php
class personne {
    private int $id;
    private string $nom;
    private string $email;
    private string $motdepasse;

    // Constructeur (on ajoute $mdp)
    public function __construct(string $n, string $m, string $mdp) {
        $this->nom = $n;
        $this->email = $m;
        $this->motdepasse = $mdp;
    }

    // Getters
    public function getname(): string {
        return $this->nom;
    }

    public function getemail(): string {
        return $this->email;
    }

    public function getid(): int {
        return $this->id;
    }

    public function getmotdepasse(): string {
        return $this->motdepasse;
    }

    // Setters
    public function setname(string $nom): void {
        $this->nom = $nom;
    }

    public function setemail(string $email): void {
        $this->email = $email;
    }

    public function setid(int $id): void {
        $this->id = $id;
    }

    public function setmotdepasse(string $mdp): void {
        $this->motdepasse = $mdp;
    }
}
?>
