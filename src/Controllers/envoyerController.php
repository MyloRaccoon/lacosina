<?php
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $mail = isset($_POST['mail']) ? $_POST['mail'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';

    /** @var PDO $pdo **/
    $requete = $pdo ->prepare('INSERT INTO contact(nom, email, description, date_envoie) VALUES (:nom, :email, :description, NOW())');
    $requete -> bindParam(':nom', $nom);
    $requete -> bindParam(':email', $email);
    $requete -> bindParam(':description', $description);

    $bddRegisterOk = $requete->execute();

    $msg = $description;

    $msg = wordwrap($msg,70);

    print($bddRegisterOk);

    $sendOk = mail("joachim.fevre@etu-unilim.fr","Nouveau mail de contact",$msg);

    if($sendOk){
        require_once(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'envoyer.php');

    }else{
        echo "Erreur lors de l'envoie du message D:";
    }