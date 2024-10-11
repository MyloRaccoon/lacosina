//ecoute le chargement du DOM
document.addEventListener('DOMContentLoaded', () => {

    //sélectione toutes les recettes avec la classe 'recipe'
    let recipes = document.querySelectorAll('.recipe');

    //ajoute un ecouteur d'evenement sur chaque recette
    recipes.forEach(recipe => {

        recipe.addEventListener('mouseover', (event) => {
            recipe.style.backgroundColor = 'lightgray'; //add gray background when mouse enter
            recipe.style.cursor = 'pointer';
        });

        recipe.addEventListener('mouseout', (event) => {
            recipe.style.backgroundColor = ''; //remove background color when mouse exit
            recipe.style.cursor = '';
        });

        recipe.addEventListener('click', (event) => {
            event.preventDefault(); //empêche le comportement par défault
            let recipeId = recipe.dataset.id; //get id
            // alert('detail de la recette : ${recipeId}'); //affiche une alerte avec l'id
            window.open('?c=detail&id=' + recipeId, '_self'); //ouvre le detail de la recette
        });
    });
});