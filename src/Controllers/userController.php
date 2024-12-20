<?php

class UserController {

    function inscription($global) {
        $global->change_view(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'User'.DIRECTORY_SEPARATOR.'inscription.php');
    }
    function enregistrer($pdo, $global) {
        $username = $_POST['username'];
        $mail = $_POST['mail'];
        $pwd = $_POST['pwd'];

        $pwdHash = password_hash($pwd, PASSWORD_DEFAULT);
        $isAdmin = 0;

        $requete = $pdo ->prepare('INSERT INTO users(username, password, mail, create_time, isAdmin) VALUES (:username, :pwdHash, :mail, NOW(), :isAdmin)');
        $requete -> bindParam(':username',$username);
        $requete -> bindParam(':pwdHash', $pwdHash);
        $requete -> bindParam(':mail', $mail);
        $requete -> bindParam(':isAdmin', $isAdmin);

        $ajoutOk = $requete->execute();

        if($ajoutOk){
            $global->change_view(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'User'.DIRECTORY_SEPARATOR.'enregistrement.php');
        }else{
            echo "Erreur lors de l'enregistrement de l'utilisateur.";
        }
    }
    function connexion($global) {
        $global->change_view(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'User'.DIRECTORY_SEPARATOR.'connexion.php');
    }
    function verifieConnexion($pdo, $global) {
        $username = $_POST['username'];
        $pwd = $_POST['pwd'];

        $requeteUsername = $pdo->prepare('SELECT * FROM users WHERE username = :username');
        $requeteUsername->bindParam(':username', $username);
        $requeteUsername->execute();
        $user = $requeteUsername->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            $global->change_view( __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'User'.DIRECTORY_SEPARATOR.'connexionEchec.php');
        } else {
            $pwdHash = $user['password'];

            if (password_verify($pwd, $pwdHash)) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['mail'] = $user['mail'];
                $_SESSION['isAdmin'] = $user['isAdmin'];
                echo "<script>window.location.href = '/lacosina/';</script>";
            } else {
                require_once __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'User'.DIRECTORY_SEPARATOR.'connexionEchec.php';
            }
        }
    }
    function deconnexion() {
        session_destroy();
        echo "<script>window.location.href = '/lacosina/';</script>";
    }
    function afficherProfil($pdo, $id) {
        $requeteUsername = $pdo->prepare('SELECT * FROM users WHERE id = :id');
        $requeteUsername->bindParam(':id', $id);
        $requeteUsername->execute();
        $user = $requeteUsername->fetch(PDO::FETCH_ASSOC);
        require_once __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'User'.DIRECTORY_SEPARATOR.'profil.php';
    }
}