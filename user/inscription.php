<?php

// Autoload
require_once 'autoload.php';

// Authentification
if (Authentification::isAuth()) {
    Utilis::redirect("profil.php");
}

// User Manager
$userManager = new UserManager();

// Build Form
$formBuilder = new FormBuilder($_POST, ['nickname', 'email', 'password']);

// Form Validator
$formValidator = new FormValidator(
    $formBuilder,
    [
        'nickname' => FormConstraints::length(@$formBuilder->method['nickname'], 3, 30),
        'email' => FormConstraints::email(@$formBuilder->method['email']),
        'check_password' => FormConstraints::passCheck(@$formBuilder->method['password'], @$formBuilder->method['repeat_password']),
    ]
);

// Submit form
if ($formValidator->isSubmit()) {
    if ($formValidator->isValide()) {
        // Check if email exist
        if ($userManager->verifyEmailExist($formBuilder->method['email']) === 0) {
            
            // Entity User
            $userEntity = new UserEntity(
                [
                    'nickname' => htmlspecialchars($formBuilder->method['nickname']),
                    'email' => htmlspecialchars($formBuilder->method['email']),
                    // Hash password
                    'password' => htmlspecialchars(FormConstraints::passHash($formBuilder->method['password'])),
                ]
            );
            // Insert user in database
            if ($userManager->addUser($userEntity)) {
                Utilis::flash('message', ["Success enregistrement."]);
            } else {
                Utilis::flash('message', ["Erreur pendant l'enregistrement."]);
            }
        } else {
            Utilis::flash('message', ["Email déjà existante."]);
        }
    } else {
        Utilis::flash('message', $formValidator->errors);
    }
}

// Title
$title = "Inscription";
// Navbar
$navbar = "navbar_user";
// Header
require_once '../templates/header.php';
?>
<h1>Inscription</h1>

<div>
    <form method="POST">
        <div>
            <label for="nickname">Nom*</label>
            <input type="text" name="nickname" name="nickname" placeholder="Votre nom" />
        </div>
        <div>
            <label for="email">Email*</label>
            <input type="text" name="email" id="email" placeholder="Adresse Email" />
        </div>
        <div>
            <label for="password">Mot de passe*</label>
            <input type="text" name="password" id="password" placeholder="Mot de passe" />
        </div>
        <div>
            <label for="password">Répéter mot de passe*</label>
            <input type="text" name="repeat_password" placeholder="Répéter mot de passe" />
        </div>
        <div>
            <button class="btn btn-primary btn-sm" type="submit">S'inscrire</button>
        </div>
        <a style="float:right;" class="btn btn-success btn-sm" href="./connexion.php">Se connecter ></a>
    </form>
</div>

<?php require_once '../templates/footer.php'; ?>