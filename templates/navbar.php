<!-- Bar nav -->
<nav>
    <div class="m-2 bg-body p-2">
        <ul class="nav nav-tabs">
            <li class="m-1"><a href="./index.php" class="btn btn-primary btn-sm">Acceuil</a></li>
            <li class="m-1"><a href="./liste.php" class="btn btn-primary btn-sm">Toutes nos annonces</a></li>
            <li class="m-1"><a href="./ajouter.php" class="btn btn-success btn-sm">Ajouter une annonce</a></li>
        </ul>

        <ul class="nav justify-content-end">
            <?php if (!isset($_SESSION['auth'])) : ?>
                <li class="m-1"><a href="./user/connexion.php" class="btn btn-primary btn-sm">Se connecter</a></li>
            <?php else : ?>
                <li class="m-1"><a href="./user/deconnexion.php" class="btn btn-warning">Se deconnecter</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>