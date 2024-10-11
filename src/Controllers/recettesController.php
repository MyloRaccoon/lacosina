<?php

class recettesController {

    function ajouter() {
        require_once __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'Recette'.DIRECTORY_SEPARATOR.'ajout.php';
    }
    function enregistrer($pdo) {
        $titre = isset($_POST['titre']) ? $_POST['titre'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $auteur = isset($_POST['auteur']) ? $_POST['auteur'] : '';

        $requete = $pdo ->prepare('INSERT INTO recettes(titre, description, auteur, date_creation) VALUES (:titre, :description, :auteur, NOW())');
        $requete -> bindParam(':titre',$titre);
        $requete -> bindParam(':description', $description);
        $requete -> bindParam(':auteur', $auteur);

        $ajoutOk = $requete->execute();

        if($ajoutOk){
            require_once(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'Recette'.DIRECTORY_SEPARATOR.'enregistrer.php');
        }else{
            echo "Erreur lors de l'enregistrement de la recette";
        }
    }
    function lister($pdo) {
        $requete = $pdo->prepare("SELECT * FROM recettes");
        $requete->execute();
        $recipes = $requete->fetchAll(PDO::FETCH_ASSOC);

        require_once(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'Recette'.DIRECTORY_SEPARATOR.'liste.php');
    }
    function detail($pdo, $id) {
        // préparation de la requete d'insertion dans la base de donnée
        
        /**@var PDO $pdo**/
        $requete = $pdo->prepare("SELECT * FROM recettes WHERE id = :id");
        $requete->bindParam(':id', $id);

        //execution de la requete, recup des données
        $requete->execute();
        $recipe = $requete->fetch(PDO::FETCH_ASSOC);

        require_once(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'Recette'.DIRECTORY_SEPARATOR.'detail.php');
    }
}