<?php

    //connexion à la base de données
require_once(__DIR__.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Models'.DIRECTORY_SEPARATOR.'connectDb.php');

    // ajout de l'en tête
require_once(__DIR__.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'header.php');


require_once(__DIR__.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.'recettesController.php');
require_once(__DIR__.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.'contactController.php');

if (isset($_GET['c'])) {
    $controller = $_GET['c'];
} else {
    $controller = 'accueil'; 
}
$recetteController = new recettesController();
$contactController = new ContactController();
// Switch pour exécuter les contrôleurs en fonction du paramètre
switch ($controller) {
    case 'accueil':
        // Exécution du contrôleur de l'accueil
        require_once(__DIR__.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.'homeController.php'); // Appel à la fonction du contrôleur
        break;
    case 'ajout':
        $recetteController->ajouter();
        break;
    case 'enregistrer': 
        $recetteController->enregistrer($pdo);
        break;
    case 'recette':
        $recetteController->lister($pdo);
        break;
    case 'contact':
        $contactController->contact();
        break;
    case 'envoyer':
        $contactController->enregistrer($pdo);
        break;
    case 'detail':
        $recetteController->detail($pdo, $_GET['id']);
        break;
    case 'modif':
        $recetteController->modif($pdo, $_GET['id']);
        break;
    case 'modifier':
        $recetteController->modifier($pdo, $_GET['id']);
        break;
    default:
        echo "Contrôleur $controller non trouvé.";
        break;
}
// ajout du pied de page
require_once(__DIR__.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'footer.php');