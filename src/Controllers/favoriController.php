<?php

class FavoriController {

    static function is_in_favoris($pdo, $id_user, $id_recette) {
        $requete = $pdo->prepare("SELECT * FROM favoris WHERE user_id = :user_id AND recette_id = :recette_id");
        $requete->bindParam(':user_id', $id_user);
        $requete->bindParam(':recette_id', $id_recette);
        $requete->execute();
        return $requete->fetch();
    }

    function ajouter($pdo, $id_user, $id_recette, $global) {

        $requete = $pdo->prepare("INSERT INTO favoris (user_id, recette_id, create_time) VALUES (:user_id, :recette_id, NOW())");
        $requete->bindParam(':user_id', $id_user);
        $requete->bindParam(':recette_id', $id_recette);

        $ok = $requete->execute();
        if ($ok) {
            $_SESSION['message'] = ['succes' => 'Recette ajoutée aux favoris'];
        } else {
            $_SESSION['message'] = ['fail' => "Problème lors de l'ajout aux favoris"];
        }
        $global->change_view($global->current_view);
    }

    function retirer($pdo, $id_user, $id_recette, $global) {
        $requete = $pdo->prepare('DELETE FROM favoris WHERE recette_id = :id_recette AND user_id = :id_user');
        $requete->bindParam(':id_user', $id_user);
        $requete->bindParam(':id_recette', $id_recette);

        $ok = $requete->execute();
        if ($ok) {
            $_SESSION['message'] = ['succes' => 'Recette retiré des favoris'];
        } else {
            $_SESSION['message'] = ['fail' => "Problème lors du retrait aux favoris"];
        }
        $global->change_view($global->current_view);
    }

    function get_favoris($pdo, $id_user, $global) {
        $requete = $pdo->prepare("SELECT r.* FROM favoris f JOIN recettes r ON f.recette_id = r.id WHERE f.user_id = :user_id");
        $requete->bindParam(":user_id", $id_user);
        $requete->execute();
        $recipes = $requete->fetchAll(PDO::FETCH_ASSOC);
        $global->change_view(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'Favoris'.DIRECTORY_SEPARATOR.'favoris.php');
        // header('Content-Type: application/json');
        // echo json_encode($requete->fetchAll(PDO::FETCH_ASSOC));
    }

    function detail($pdo, $id, $global) {
        // préparation de la requete d'insertion dans la base de donnée
        
        /**@var PDO $pdo**/
        $requete = $pdo->prepare("SELECT * FROM recettes WHERE id = :id");
        $requete->bindParam(':id', $id);

        //execution de la requete, recup des données
        $requete->execute();
        $recipe = $requete->fetch(PDO::FETCH_ASSOC);
        if (isset($_SESSION['id'])) {
            $is_in_favoris = $this->is_in_favoris($pdo, $_SESSION['id'], $id); 
        } else {
            $is_in_favoris = false;
        }

        $global->change_view(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'Favoris'.DIRECTORY_SEPARATOR.'detail.php');
    }
}