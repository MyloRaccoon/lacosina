<?php

class ContactController {
    function contact(){
        require_once __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'Contact'.DIRECTORY_SEPARATOR.'contact.php';
    }  
    function enregistrer($pdo){
        $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
        $mail = isset($_POST['mail']) ? $_POST['mail'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';

        $requete = $pdo ->prepare('INSERT INTO contact(nom, email, description) VALUES (:nom, :mail, :description)');
        $requete -> bindParam(':nom',$nom);
        $requete -> bindParam(':mail', $mail);
        $requete -> bindParam(':description', $description);

        $ajoutOk = $requete->execute();

        if($ajoutOk){
            require_once(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'Contact'.DIRECTORY_SEPARATOR.'envoyer.php');
        }else{
            echo "Erreur lors de l'enregistrement du contact";
        }
    }
}