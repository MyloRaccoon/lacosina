<h1>Profil de l'utilisateur : <span id='profil_username_titre'><?php echo $user['username']; ?></span></h1>
<div class="row">
    <div class="col">
        <img class="w-75 rounded mx-auto img-fluid" src="<?php echo 'upload'.DIRECTORY_SEPARATOR.'profil.png';?>" alt="profil picture" class='card-img-top'>
    </div>
    <div class="col">
        <p><b>Nom d'utilisateur : </b><span id='profil_username' data-id="<?php echo $user['id']; ?>" contenteditable="true"><?php echo $user['username']; ?></span></p>
        <p><b>Email : </b><span id='profil_mail' data-id="<?php echo $user['id']; ?>" contenteditable="true"><?php echo $user['mail']; ?></span></p>
    </div>
</div>
<hr>
<div id='boutons'>
    <button id="bouton_modifier_profil" class="btn btn-primary d-none">Modifier le profil</button>
    <a href="?c=home" class="btn btn-primary">Retour à l'acceuil</a>
</div>

<script src="src/Views/js/recipes.js"></script>