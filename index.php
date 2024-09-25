<?php

    //connexion à la base de données
require_once(__DIR__.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Models'.DIRECTORY_SEPARATOR.'connectDb.php');

    // ajout de l'en tête
require_once(__DIR__.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'header.php');


if (isset($_GET['c'])) {
    $controller = $_GET['c'];
} else {
    $controller = 'accueil'; 
}

// Switch pour exécuter les contrôleurs en fonction du paramètre
switch ($controller) {
    case 'accueil':
        // Exécution du contrôleur de l'accueil
        require_once(__DIR__.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.'homeController.php'); // Appel à la fonction du contrôleur
        break;
    case 'contact':
        // Exécution du contrôleur du contact
        require_once(__DIR__.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.'contactController.php'); // Appel à la fonction du contrôleur
        break;
    case 'ajout':
        // Exécution du contrôleur du ajout
        require_once(__DIR__.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.'ajoutController.php'); // Appel à la fonction du contrôleur
        break;
    case 'enregistrer':
        // Exécution du contrôleur du enregistrer
        require_once(__DIR__.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.'enregistrerController.php'); // Appel à la fonction du contrôleur
        break;
    default:
        echo "Contrôleur non trouvé.";
        break;
}

// ajout du pied de page
require_once(__DIR__.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'footer.php');