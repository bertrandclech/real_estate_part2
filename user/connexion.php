<?php

// Autoload

$title = "Connexion";       # Title
$navbar = "navbar_user";    # Nav bar
// Header
require_once '../templates/header.php'; ?>


<h1>Connexion</h1>

<div>
    <form action="" method="POST">
        <div>
            <label for="user_email">Email*</label>
            <input type="text" name="user_email" id="user_email" placeholder="Adresse Email" />
        </div>
        <div>
            <label for="password">Mot de passe*</label>
            <input type="text" name="password" id="password" placeholder="Mot de passe" />
        </div>
        <div>
            <button class="btn btn-primary btn-sm" type="submit">Connexion</button>
        </div>
        <a style="float:right;" class="btn btn-success btn-sm" href="./inscription.php">Inscription ></a>
    </form>
</div>

<?php require_once '../templates/footer.php'; ?>