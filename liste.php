<?php

require_once './src/autoload.php';

$advertManager = new AdvertManager();

// Suppression d'une annonce
// Vérifie si un id est envoyé et si une variable $type est bien envoyée
if (!empty($_GET['id']) && !empty($_GET['type']) && $_GET['type'] === 'supprimer') {
    // Suppression d'une annonce en BDD
    $advertManager->deleteAdvertById($_GET['id']);
}

// Récupération de toutes les annonces
$allAdvers = $advertManager->getAllAdverts();

// Title
$title = "Toutes Les Annonces";	
// Navbar
$navbar = "navbar";
// Header
require_once './templates/header.php';
?>
<h1>Liste de toutes nos annonces</h1>

<div class="container-fluid">

    <table class="table table-striped mt-5">
        <thead>
            <tr>
                <th>Photo</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Code postal</th>
                <th>ville</th>
                <th>Catégorie</th>
                <th>Prix</th>
                <th>Date de création</th>

                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($allAdvers as $advert) : ?>
                <tr>
                    <td><img src="uploads/<?php echo $advert['picture']; ?>" alt="<?php echo $advert['title']; ?>" class="img-fluid"></td> 
                    <td><?= mb_strtoupper($advert['title']); ?></td>
                    <td><?= ucfirst(substr($advert['description'], 0, 10) . "..."); ?></td>
                    <td><?= $advert['postcode']; ?></td>
                    <td><?= $advert['city']; ?></td>
                    <td><?= $advert['category']; ?></td>
                    <td><?= $advert['price']; ?> €</td>
                    <td><?= $advert['created_at']; ?></td>

                    <td class="text-right">
                        <a href="details.php?id=<?= $advert['id_advert']; ?>" class="btn btn-warning btn-sm mb-1">Voir le détail</a>
                        <a href="editer.php?id=<?= $advert['id_advert']; ?>" class="btn btn-primary btn-sm mb-1">Mettre à jour</a>
                        <a onclick="return confirm('Voulez-vous bien supprimer ?');" href="index.php?id=<?= $advert['id_advert']; ?>&type=supprimer" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>

<?php require_once './templates/footer.php' ?>