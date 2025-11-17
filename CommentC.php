<?php
include "./config.php";
include "./Comment.php";

class CommentC {

    public function addComment($comment){
        $sql = "INSERT INTO comment (idUser, idPost, content)
                VALUES (:idUser, :idPost, :content)";
        $db = config::getConnexion();

        try{
            $req = $db->prepare($sql);
            $req->bindValue(':idUser', $comment->getIdUser());
            $req->bindValue(':idPost', $comment->getIdPost());
            $req->bindValue(':content', $comment->getContent());
            $req->execute();
        }
        catch(Exception $e){
            echo "Erreur: ".$e->getMessage();
        }
    }

    public function afficherComments($idPost){
        $sql = "SELECT * FROM comment WHERE idPost = $idPost";
        $db = config::getConnexion();

        try{
            return $db->query($sql);
        }
        catch(Exception $e){
            die("Erreur: ".$e->getMessage());
        }
    }
}
?>
