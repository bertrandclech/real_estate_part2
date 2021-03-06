<?php

// Autoload
require_once './src/autoload.php';


// If not auth
if (!Authentification::isAuth()) {
	Utilis::flash("message", ["Vous devez être connectée."]);
	Utilis::redirect("./user/connexion.php");
}

require_once './src/fonctions.php';          # fonctions pour ajout d'images

# Instance of advertMananger
$adManager = new AdvertManager();

// Récupère l'advert en cours et en force avec un "integer"
$advert = $adManager->getAdvertById((int)$_GET['id']);

# Show categories list
$categories = $adManager->showCategoryList();

// Build form
$formBuilder = new FormBuilder($_POST, ['id_avert', 'title', 'description', 'postcode', 'city', 'category', 'price']);

// Form validator
$formValidator = new FormValidator(
	$formBuilder,
	[
		'id_avert' => FormConstraints::int((int) htmlspecialchars($_GET['id'])),
		'title' => FormConstraints::length(@$formBuilder->method['title'], 2, 30),
		'description' => FormConstraints::string(@$formBuilder->method['description']),
		'postcode' => FormConstraints::postalCode(@$formBuilder->method['postcode']),
		'city' => FormConstraints::string(@$formBuilder->method['city']),
		'category' => FormConstraints::int(@$formBuilder->method['category']),
		'price' => FormConstraints::int(@$formBuilder->method['price'])
	]
);

// If form is submit
if ($formValidator->isSubmit()) {
	if ($formValidator->isValide()) {


		// Build a entity
		$ad = new AdvertEntity(
			[
				'id_avert' => htmlspecialchars((int) $_GET['id']),
				'title' => htmlspecialchars($formBuilder->method['title']),
				'description' => htmlspecialchars($formBuilder->method['description']),
				'postcode' => htmlspecialchars($formBuilder->method['postcode']),
				'city' => htmlspecialchars($formBuilder->method['city']),
				'category_id' => htmlspecialchars($formBuilder->method['category']),
				'price' => htmlspecialchars($formBuilder->method['price']),
				
			]
		);

		// Si une image est envoyée, effectuer les vérifications nécessaires
		if (!empty($_FILES['picture']['name'])) {

			$extension = verifPicture($_FILES['picture']);

			// Si pas d'erreur dans la vérification de l'image, on upload
			if ($extension) {
				// Upload de l'image
				$nom_photo = uploadImage($_FILES['picture'], $_GET['id'], $extension);

				// set de l'image
				$ad->setPicture(htmlspecialchars($nom_photo));

						// Update Advert into database
				if ($adManager->updateAdvertById(intval($_GET['id']), $ad, $nom_photo) > 0) {
					$_SESSION['message'] = ["Annonce modifié avec success."];
				} else {
					$_SESSION['message'] = ["L'annonce a pas été modifié."];
				}
				header('Location: editer.php?id=' . (int) $_GET['id'] . '');
				exit();
			}
			else {
				$_SESSION['messsage'] =	 '<div class="alert alert-danger" role="alert">Image invalide !</div>';
			}
		// on met à jour tout sauf l'image	
		} else {
			if ($adManager->updateAdvert($ad) > 0) {
				$_SESSION['message'] = ["Annonce modifié avec success."];
			} else {
				$_SESSION['message'] = ["L'annonce a pas été modifié."];
			}
			header('Location: editer.php?id=' . (int) $_GET['id'] . '');
			exit();

		}
	} else {
		Utilis::flash('message', $formValidator->errors);
	}
}

// Title
$title = "Modifier une annonce";
// navbar
$navbar = "navbar";
// Header
require_once './templates/header.php';
?>

<h1>Modifier une annonce</h1>

<!-- If advert exist -->
<?php if ((int) $advert) : ?>

	<form method="post" class="mt-5" enctype="multipart/form-data" novalidate>
		<input type="hidden" class="form-control" name="id" value="<?= htmlspecialchars((int) $_GET['id']); ?>">
		<div class="form-group">
			<label>Titre</label>
			<input type="text" class="form-control" name="title" value="<?= $advert['title']; ?>">
		</div>
		<div class="form-group">
			<label>Description</label>
			<input type="text" class="form-control" name="description" value="<?= $advert['description']; ?>">
		</div>
		<div class="form-group">
			<label>Code postal</label>
			<input type="number" class="form-control" name="postcode" value="<?= $advert['postcode']; ?>" />
		</div>
		<div class="form-group">
			<label>Ville</label>
			<input type="text" class="form-control" name="city" value="<?= $advert['city']; ?>" />
		</div>
		<div class="form-group">
			<label>Type</label>
			<?= $advert['value'] ?>

			<select name="category" class="custom-select">
				<option value="<?= $advert['category_id'] ?>"><?= $advert['category'] ?></option>
				<?php foreach ($categories as $cat) : ?>
					<option value="<?= $cat['id_category'] ?>">
						<?= $cat['value'] ?>
					</option>
				<?php endforeach; ?>

			</select>
		</div>
		<div class="form-group">
			<label>Prix</label>
			<div class="input-group">
				<input type="number" step="10" class="form-control" name="price" value="<?= $advert['price']; ?>" />
				<div class="input-group-append">
					<div class="input-group-text">€</div>
				</div>
			</div>
		</div>	

		<div class="form-group">
			<label>Photo</label>
			<img src="uploads/<?php echo $advert['picture']; ?>" alt="<?php echo $advert['title']; ?>" class="img-fluid">
			<div class="custom-file">
				<input type="hidden" name="old_picture" value="<?php echo $advert['picture']; ?>">	
				<input type="file" class="custom-file-input" name="picture">
				<label class="custom-file-label">Choisir une photo</label>
			</div>
		</div>

		<div class="form-group">
			<input type="hidden" class="form-control" name="reservation_message" value="disponible" />
		</div>

		<a href="index.php" class="btn btn-outline-secondary">Annuler</a>
		<input type="submit" class="btn btn-primary" name="submit" value="Modifier">
	</form>

	<!-- If not advert -->
<?php else :  ?>
	<p class="alert alert-danger">Aucune informations valides.</p>
<?php endif; ?>

<?php require_once './templates/footer.php' ?>