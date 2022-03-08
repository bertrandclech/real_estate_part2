<?php

require_once './src/autoload.php';			# Autoload

require_once './src/fonctions.php';          # fonctions pour ajout d'images

// Manager Advert
$adManager = new AdvertManager();

// Form Builder
$formBuilder = new FormBuilder($_POST, ['title', 'description', 'postcode', 'city', 'category_id', 'price']);

// Form Validator
$formValidator = new FormValidator(
	$formBuilder,
	[
		'title' => FormConstraints::length(@$formBuilder->method['title'], 2, 30),
		'description' => FormConstraints::string(@$formBuilder->method['description']),
		'postcode' => FormConstraints::postalCode(@$formBuilder->method['postcode']),
		'city' => FormConstraints::string(@$formBuilder->method['city']),
		'category_id' => FormConstraints::int(@$formBuilder->method['category']),
		'price' => FormConstraints::int(@$formBuilder->method['price']),
	]
);

if ($formValidator->isSubmit()) {


	if ($formValidator->isValide()) {
		
		// If Form is valide insert datas in entity
		$ad = new AdvertEntity(
			[
				'title' => htmlspecialchars($formBuilder->method['title']),
				'description' => htmlspecialchars($formBuilder->method['description']),
				'postcode' => htmlspecialchars($formBuilder->method['postcode']),
				'city' => htmlspecialchars($formBuilder->method['city']),
				'category_id' => htmlspecialchars($formBuilder->method['category']),
				'price' => htmlspecialchars($formBuilder->method['price']),
				'picture' => 'image.png',
			]
		);
		// Add advert (INSERT INTO DB)
		$lastId = $adManager->addAdvert($ad);

		// Vérifie les caractéristiques de l'image

		//var_dump($lastId);	

		$extension = verifPicture($_FILES['picture']);
		if ($extension) {
		// Sauvegarde de l'image
		// Upload de l'image
			$nom_image = uploadImage($_FILES['picture'], $lastId, $extension);

		// Met à jour le nom de l'image en BDD
			$ad->setPicture($nom_image);
			$adManager->updateAdvertById($lastId,  $ad	, $nom_image);
		} else {
			$_SESSION['message'] = ["<div class='alert alert-danger' role='alert'>Image invalide !</div>"];
		}	

		$_SESSION['message'] = ["Informations enregistrées."];
	} else {
		# Errors...
		$_SESSION['message'] = $formValidator->errors;
	}
}

// Ttile
$title = "Ajouter une annonce";	
// Navbar
$navbar = "navbar";
// Header
require_once './templates/header.php'; ?>

<h1>Nouvelle annonce</h1>

<div class="container-fluid">

	<form method="post" class="mt-5" enctype="multipart/form-data"> <!-- novalidate -->

		<div class="form-group">
			<label>Titre</label>
			<input type="text" class="form-control" name="title">	
		</div>

		<div class="form-group">
			<label>Description</label>
			<input type="text" class="form-control" name="description">
		</div>

		<div class="form-group">
			<label>Code postal</label>
			<input type="text" class="form-control" name="postcode">
		</div>

		<div class="form-group">
			<label>Ville</label>
			<input type="text" class="form-control" name="city">
		</div>
		
		<div class="form-group">
			<label>Type</label>
			<select name="category" class="custom-select">
				<?php foreach ($adManager->showCategoryList() as $cat) : ?>
					<option value="<?= $cat['id_category'] ?>"><?= $cat['value'] ?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="form-group">
			<label>Prix</label>
			<div class="input-group">
				<input type="text" class="form-control" name="price">
				<div class="input-group-append">
					<div class="input-group-text">€</div>
				</div>
			</div>
		</div>

		<div class="form-group">
			<label>Photo</label>
			<div class="custom-file">
				<input type="file" class="custom-file-input" name="picture">
				<label class="custom-file-label">Choisir une photo</label>
			</div>
		</div>	

		<a href="index.php" class="btn btn-outline-secondary">Annuler</a>
		<input type="submit" class="btn btn-primary" name="submit" value="Valider">
	</form>
</div>

<?php require_once './templates/footer.php' ?>