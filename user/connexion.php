<?php

// Autoload
require_once 'autoload.php';

// Authentification
if (Authentification::isAuth()) {
    Utilis::redirect("profil.php");
}

// Instance User Manager
$userManager = new UserManager();

// Build form
$formBuilder = new FormBuilder($_POST, ['email', 'password']);
// Form validator
$formValidator = new FormValidator(
    $formBuilder,
    [
        'email' => FormConstraints::email(@$formBuilder->method['email']),
        'password' => FormConstraints::string(@$formBuilder->method['password']),
    ]
);

// IF Form is submit
if ($formValidator->isSubmit()) {
    if ($formValidator->isValide()) {
        // Verify if email is ok
        if ($auth = $userManager->connectUser(htmlspecialchars($formBuilder->method['email']))) {
            // Verify password
            if (password_verify($formBuilder->method['password'], $auth['password'])) {

                // Build a session Auth
                $_SESSION['auth'] =
                    [
                        'role' => $auth['role'],
                        'prenom' => $auth['nickname'],
                        'email' => $auth['mail'],
                        'date' => $auth['created_at']
                    ];

                if (isset($_SESSION['redirect'])) {
                    Utilis::redirect($_SESSION['redirect']);
                    unset($_SESSION['redirect']);
                }

                $_SESSION['message'] = ["Connecté"];
                header('Location: profil.php');
                exit();
            } else {
                $_SESSION['message'] = ['Informations invalides.'];
            }
        } else {
            $_SESSION['message'] = ['Informations invalides.'];
        }
    } else {
        // Return errors
        $_SESSION['message'] = $formValidator->errors;
    }
}

// render HTML
$title = "Connexion";       # Title
$navbar = "navbar_user";    # Nav bar
// Header
require_once '../templates/header.php'; ?>

<h1>Connexion</h1>

<div>
    <form method="POST">
        <div>
            <label for="email">Email*</label>
            <input type="text" name="email" id="email" placeholder="Adresse Email" />
        </div>
        <div>
            <label for="password">Mot de passe*</label>
            <input type="text" name="password" id="password" placeholder="Mot de passe" />
        </div>
        <div>
            <button class="btn btn-primary btn-sm" type="submit">Connexion</button>
        </div>
        <div>
            <a style="float:right;" class="btn btn-success btn-sm" href="./inscription.php">Inscription ></a>
        </div>
    </form>
</div>

<?php require_once '../templates/footer.php'; ?>