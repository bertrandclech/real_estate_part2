<?php

// Autoload
require_once 'autoload.php';

// Instance auth
$auth = new Authentification();

// Verify if auth exist or not
if (!$auth->isAuth()) {
    $_SESSION['message'] = ["Veuillez vous connecter"];
    header('Location: connexion.php');
    exit();
}

$title = "Profil";
$navbar = "navbar_user";
require_once '../templates/header.php'; ?>

<h1>Votre profil</h1>


<?php require_once '../templates/footer.php'; ?>