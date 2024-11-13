//ecoute le chargement du DOM
document.addEventListener('DOMContentLoaded', () => {

    //selection du profil username (contenu modifiable)
    let profil_username = document.getElementById("profil_username");
    //selection du profil mail (contenu modifiable)
    let profil_mail = document.getElementById("profil_mail");
    //selection du bouton
    let modifier_profil = document.getElementById("bouton_modifier_profil");

    //ajoute un écouteur d'évènement pour afficher le nouton de modification lorsque le contenu du profil est modifié
    profil_username.addEventListener('input', (event) => {
        modifier_profil.classList.remove('d-none'); //affiche le bouton de modif
    });

    profil_mail.addEventListener('input', (event) => {
        modifier_profil.classList.remove('d-none'); //affiche le bouton de modif
    });
    
});