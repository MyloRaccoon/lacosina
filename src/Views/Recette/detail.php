<main>
  <h1><?= $recipe['titre'] ?></h1>

  <!-- two cols -->
  <div class="row">
    <div class="col-6">
      <img src="upload/<?= $recipe['image'] ?? "no_image.png" ?>" alt="<?= $recipe['titre'] ?>" class="img-fluid">
      <a href='?c=recette' class="btn btn-primary mt-4">Retour à la liste des recettes</a>
      <?php if (isset($_SESSION['username'])) { ?>
        <a href="?c=modif&id=<?= $recipe['id'];?>" class="btn btn-primary">Modifier la recette</a>
        <a href="?c=ajoutFavori&id=<?php echo $recipe["id"];?>" class="btn btn-primary">Ajouter aux favoris</a>
      <?php } ?>
    </div>
    <div class="col-6">
      <p><?= $recipe['description'] ?></p>
      <p>
        Auteur : <a href="mailto:<?= $recipe['auteur'] ?>">
          <?= $recipe['auteur'] ?>
        </a>
      </p>
    </div>
</main>