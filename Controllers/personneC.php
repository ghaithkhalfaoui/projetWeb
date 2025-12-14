<?php
include '../config.php';

class personneC {
    

    // Ajouter une personne
    public function addPerson($person) {
        $db = config::getConnexion();
        try {
            $req = $db->prepare('
                INSERT INTO userr VALUES(NULL, :n, :m)
            ');
            $req->execute([
                'n' => $person->getname(),
                'm' => $person->getemail(),
            ]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }  
    }

    // Lister toutes les personnes
    public function listePersonne() {
        $db = config::getConnexion();
        try {
            $liste = $db->query('SELECT * FROM userr'); 
            return $liste;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    

    // Supprimer une personne par ID
    public function deletePerson($id) {
        $db = config::getConnexion();
        try {
            $req = $db->prepare("DELETE FROM userr WHERE id=:id");
            $req->execute(['id' => $id]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Modifier une personne
    public function updatePerson($id, $name, $email) {
        $db = config::getConnexion();
        try {
            $req = $db->prepare('
                UPDATE userr 
                SET name=:n, email=:m
                WHERE id=:id
            ');
            $req->execute([
                'id' => $id,
                'n'  => $name,
                'm'  => $email,
            ]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
  public function saveOTP($id, $code, $expire) {
    $sql = "UPDATE userr SET otp_code = :code, otp_expire = :expire WHERE id = :id";
    $db = config::getConnexion();
    $req = $db->prepare($sql);
    $req->bindValue(':code', $code);
    $req->bindValue(':expire', $expire);
    $req->bindValue(':id', $id);
    $req->execute();
}

public function clearOTP($id) {
    $sql = "UPDATE userr SET otp_code = NULL, otp_expire = NULL WHERE id = :id";
    $db = config::getConnexion();
    $req = $db->prepare($sql);
    $req->bindValue(':id', $id);
    $req->execute();

}
}
?>
