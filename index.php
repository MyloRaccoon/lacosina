<?php
session_start();

    //connexion à la base de données
require_once(__DIR__.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Models'.DIRECTORY_SEPARATOR.'connectDb.php');
require_once(__DIR__.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.'globalController.php');
$global = new GlobalController();
    // ajout de l'en tête
if (!isset($_GET['x']))
    require_once(__DIR__.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'header.php');

require_once(__DIR__.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.'recettesController.php');
require_once(__DIR__.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.'contactController.php');
require_once(__DIR__.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.'userController.php');
require_once(__DIR__.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.'favoriController.php');

if (isset($_GET['c'])) {
    $controller = $_GET['c'];
} else {
    $controller = 'accueil'; 
}
$recetteController = new recettesController();
$contactController = new ContactController();
$userController = new UserController();
$favorisController = new FavoriController();
// Switch pour exécuter les contrôleurs en fonction du paramètre
switch ($controller) {
    case 'accueil':
        // Exécution du contrôleur de l'accueil
        $global->change_view(__DIR__.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.'homeController.php'); // Appel à la fonction du contrôleur
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
        $contactController->contact($global);
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
    case 'inscription':
        $userController->inscription();
        break;
    case 'inscrire':
        $userController->enregistrer($pdo);
        break;
    case 'connexion':
        $userController->connexion();
        break;
    case 'connecter':
        $userController->verifieConnexion($pdo);
        break;
    case 'deconnexion':
        $userController->deconnexion();
        break;
    case 'profil':
        $userController->afficherProfil($pdo, $_SESSION['id']);
        break;
    case 'ajoutFavori':
        $favorisController->ajouter($pdo, $_SESSION['id'], $_GET['id'], $global);
        break;
    case 'favoris':
        $favorisController->get_favoris($pdo, $_SESSION['id']);
        break;
    case 'favdetail':
        $favorisController->detail($pdo, $_GET['id']);
        break;
    case 'removeFavori':
        $favorisController->retirer($pdo, $_SESSION['id'], $_GET['id'], $global);
        break;
    default:
        echo "Contrôleur $controller non trouvé.";
        break;
}
require_once($global->current_view);
// ajout du pied de page
if (!isset($_GET['x']))
    require_once(__DIR__.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'footer.php');