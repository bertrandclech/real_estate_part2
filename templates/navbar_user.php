<!-- Nav bar for user only -->
<nav>
    <div class="m-2 bg-body p-2">
        <ul class="nav nav-tabs">
            <li class="m-1"><a href="../index.php" class="btn btn-info btn-sm">
                    < Acceuil</a>
            </li>
        </ul>
    </div>
    <?php if (isset($_SESSION['auth'])) :  ?>
        <p style="float:right;"><a class="btn btn-warning btn-sm m-2" href="./deconnexion.php">Déconnexion</a></p>
    <?php endif; ?>
</nav>