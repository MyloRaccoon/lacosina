<?php

class recettesController {

    function ajouter($global) {
        $global->change_view(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'Recette'.DIRECTORY_SEPARATOR.'ajout.php');
    }
    function enregistrer($pdo, $global) {
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $auteur = $_POST['auteur'];

        $image = $_FILES['image'] ?? null;

        $requete = $pdo ->prepare('INSERT INTO recettes(titre, description, auteur, date_creation) VALUES (:titre, :description, :auteur, NOW())');
        $requete -> bindParam(':titre',$titre);
        $requete -> bindParam(':description', $description);
        $requete -> bindParam(':auteur', $auteur);

        $ajoutOk = $requete->execute();

        if($ajoutOk){
            if ($image) {
                $id = $_GET['id'] ?? $pdo->lastInsertId();
                $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
                $filename = $id . '.' . $extension;
                move_uploaded_file($image['tmp_name'], 'upload/' . $filename);
        
                $query = $pdo->prepare('UPDATE recettes SET image = :image WHERE id = :id');
                $query->bindValue(':image', $filename, PDO::PARAM_STR);
                $query->bindValue(':id', $id, PDO::PARAM_INT);
                $query->execute();
              }
              $global->change_view(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'Recette'.DIRECTORY_SEPARATOR.'enregistrer.php');
        }else{
            echo "Erreur lors de l'enregistrement de la recette";
        }
    }
    function lister($pdo, $global) {
        $requete = $pdo->prepare("SELECT * FROM recettes");
        $requete->execute();
        $recipes = $requete->fetchAll(PDO::FETCH_ASSOC);

        $global->change_view(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'Recette'.DIRECTORY_SEPARATOR.'liste.php');
    }
    function detail($pdo, $id, $global) {
        // préparation de la requete d'insertion dans la base de donnée
        
        /**@var PDO $pdo**/
        $requete = $pdo->prepare("SELECT * FROM recettes WHERE id = :id");
        $requete->bindParam(':id', $id);

        //execution de la requete, recup des données
        $requete->execute();
        $recipe = $requete->fetch(PDO::FETCH_ASSOC);
        $favoriController = new FavoriController();
        if (isset($_SESSION['id'])) {
            $is_in_favoris = $favoriController->is_in_favoris($pdo, $_SESSION['id'], $id); 
        } else {
            $is_in_favoris = false;
        }
        

        $global->change_view(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'Recette'.DIRECTORY_SEPARATOR.'detail.php');
    }
    function modif($pdo, $id, $global) {
        $requete = $pdo->prepare("SELECT * FROM recettes WHERE id = :id");
        $requete->bindParam(':id', $id);

        $requete->execute();
        $recipe = $requete->fetch(PDO::FETCH_ASSOC);
        $global->change_view(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'Recette'.DIRECTORY_SEPARATOR.'modif.php');
    }
    function modifier($pdo, $id, $global) {
        $titre = isset($_POST['titre']) ? $_POST['titre'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $auteur = isset($_POST['auteur']) ? $_POST['auteur'] : '';
        
        $image = $_FILES['image'] ?? null;

        $requete = $pdo->prepare('UPDATE recettes SET titre = :titre, description = :description, auteur = :auteur WHERE id = :id');
        $requete->bindParam(':id', $id);
        $requete->bindParam(':titre', $titre);
        $requete->bindParam(':description', $description);
        $requete->bindParam(':auteur', $auteur);
        
        $modifOk = $requete->execute();

        if($modifOk){
            if ($image) {
                $id = $_GET['id'] ?? $pdo->lastInsertId();
                $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
                $filename = $id . '.' . $extension;
                move_uploaded_file($image['tmp_name'], 'upload/' . $filename);
        
                $query = $pdo->prepare('UPDATE recettes SET image = :image WHERE id = :id');
                $query->bindValue(':image', $filename, PDO::PARAM_STR);
                $query->bindValue(':id', $id, PDO::PARAM_INT);
                $query->execute();
              }
              $global->change_view(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'Recette'.DIRECTORY_SEPARATOR.'modifier.php');
        }else{
            echo "Erreur lors de l'enregistrement de la recette";
        }

    }
}