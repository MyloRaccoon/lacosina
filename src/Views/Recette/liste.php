<body>
    <h1>Recettes</h1>

    <div class="row">
        <?php foreach($recipes as $recipe) : ?>
            <div class="col-4 p-2">
                <div class="card recipe" data-id="<?php echo $recipe['id']?>">
                <img src="upload/<?= $recipe['image'] ?? "no_image.png" ?>" alt="<?= $recipe['titre'] ?>" class="card-img-top">
                <div class="card-body">
                    <h2 class="card-title"><?php echo $recipe['titre']; ?></h2>
                    <p class="card-text"><?php echo $recipe['description']; ?></p>
                    Auteur : <a href="mailto:<?php echo $recipe['auteur']; ?>"><?php echo $recipe['auteur']; ?></a>
                </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <a href="?c=accueil" class="btn btn-primary">Retour à l'accueil</a>
</body>

<script src="src/Views/js/recipes.js"></script>