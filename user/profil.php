<?php

// Autoload
require_once 'autoload.php';

// Verify if auth exist or not
if (!Authentification::isAuth()) {
    $_SESSION['message'] = ["Veuillez vous connecter"];
    Utilis::redirect('connexion.php');
}

$title = "Profil";
$navbar = "navbar_user";
require_once '../templates/header.php'; ?>

<h1>Votre profil</h1>

<p>Prénom : <b><?= $_SESSION['auth']['prenom'] ?></b></p>
<p>Email : <b><?= $_SESSION['auth']['email'] ?></b></p>
<p>Date inscrption : <b><?= $_SESSION['auth']['date'] ?></b></p>




<?php require_once '../templates/footer.php'; ?>