<?php

class FavoriController {

    static function is_in_favoris($pdo, $id_user, $id_recette) {
        $requete = $pdo->prepare("SELECT * FROM favoris WHERE user_id = :user_id AND recette_id = :recette_id");
        $requete->bindParam(':user_id', $id_user);
        $requete->bindParam(':recette_id', $id_recette);
        $requete->execute();
        return $requete->fetch();
    }

    function ajouter($pdo, $id_user, $id_recette) {
    
        if (!self::is_in_favoris($pdo, $id_user, $id_recette)) {
            //l'utilisateur n'a pas déjà ajouté cette recette
            $requete = $pdo->prepare("INSERT INTO favoris (user_id, recette_id, create_time) VALUES (:user_id, :recette_id, NOW())");
            $requete->bindParam(':user_id', $id_user);
            $requete->bindParam(':recette_id', $id_recette);

            $ok = $requete->execute();

            if($ok){
                require_once(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'Favoris'.DIRECTORY_SEPARATOR.'ajoutSucces.php');
            }else{
                echo "Erreur lors de l'enregistrement du favori.";
            }
        } else {
            require_once(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'Favoris'.DIRECTORY_SEPARATOR.'ajoutEchec.php');
        }
    }

    function get_favoris($pdo, $id_user) {
        $requete = $pdo->prepare("SELECT r.* FROM favoris f JOIN recettes r ON f.recette_id = r.id WHERE f.user_id = :user_id");
        $requete->bindParam(":user_id", $id_user);
        $requete->execute();
        header('Content-Type: application/json');
        echo json_encode($requete->fetchAll(PDO::FETCH_ASSOC));
    }
}