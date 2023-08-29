<?php

// Charger les fichiers des fonctionnalités extraites dans des classes.
require_once(__DIR__ . '/controllers/ContactForm.php');

// Démarrer le système de sessions pour pouvoir afficher des messages de feedback venant des formulaires.
if(session_status() === PHP_SESSION_NONE) session_start();

// Disable Wordpress' default Gutenberg Editor:
add_filter('use_block_editor_for_post', '__return_false', 10);

//on peut appeler des fonctions pour supprimer des items du menu
//https://developer.wordpress.org/reference/functions/remove_menu_page/


// Enregistrer un custom post type :
function clinicoeurs_register_custom_post_types(): void
{
	register_post_type('poste', [
		'label' => 'Profils bénévoles recherchés',
		'description' => 'Listes des profils bénévoles recherchés',
		'public' => true,
		'menu_position' => 20,
		'menu_icon' => 'dashicons-universal-access', // https://developer.wordpress.org/resource/dashicons/#pets,
		'supports' => ['title', 'thumbnail', 'editor'],
	]);

	register_post_type('message', [
		'label' => 'Message de contact',
		'description' => 'Les messages envoyés via le formulaire de contact.',
		'public' => true,
		'menu_position' => 20,
		'menu_icon' => 'dashicons-email', // https://developer.wordpress.org/resource/dashicons/#pets,
		'supports' => ['title','editor'],
	]);

	register_post_type('produit', [
		'label' => 'Categories de produits',
		'description' => 'Les categories de produit que nous faisons',
		'public' => true,
		'menu_position' => 20,
		'menu_icon' => 'dashicons-products', // https://developer.wordpress.org/resource/dashicons/#pets,
		'supports' => ['title','thumbnail', 'editor'],
	]);

	register_post_type('temoignage', [
		'label' => 'Témoignage',
		'description' => 'Liste de témoignages recueilli',
		'public' => true,
		'menu_position' => 20,
		'menu_icon' => 'dashicons-testimonial', // https://developer.wordpress.org/resource/dashicons/#pets,
		'supports' => ['title', 'editor'],
	]);

	register_post_type('service', [
		'label' => 'Nos Services',
		'description' => 'Liste de Nos Services',
		'public' => true,
		'menu_position' => 20,
		'menu_icon' => 'dashicons-admin-tools', // https://developer.wordpress.org/resource/dashicons/#pets,
		'supports' => ['title', 'editor'],
	]);
}

add_action('init', 'clinicoeurs_register_custom_post_types');

register_nav_menu('main', 'Navigation principale du site web (en-tête)');
register_nav_menu('footer', 'Navigation de pied de page');
register_nav_menu('services', 'Navigation des services');

function clinicoeurs_get_menu(string $location, ?array $attributes = []): array
{
	// 1. Récupérer les liens en base de données pour la location $location
	$locations = get_nav_menu_locations();
	$menuId = $locations[$location];
	$items = wp_get_nav_menu_items($menuId);

	// 2. Formater les liens récupérés en objets qui contiennent les attributs suivants :
	// - href : l'URL complète pour ce lien
	// - label : le libellé affichable pour ce lien
	$links = [];

	foreach ($items as $item) {
		$link = new stdClass();
		$link->href = $item->url;
		$link->label = $item->title;

		foreach($attributes as $attribute) {
			$link->$attribute = get_field($attribute, $item->ID);
		}

		$links[] = $link;
	}

	// 3. Retourner l'ensemble des liens formatés en un seul tableau non-associatif
	return $links;
}

// Gérer le formulaire de contact "custom"
// Inspiré de : https://wordpress.stackexchange.com/questions/319043/how-to-handle-a-custom-form-in-wordpress-to-submit-to-another-page

function clinicoeurs_execute_contact_form()
{
	$config = [
		'nonce_field' => 'contact_nonce',
		'nonce_identifier' => 'clinicoeurs_contact_form',
	];

	(new \Clinicoeurs\ContactForm($config, $_POST))
		->sanitize([
			'firstname' => 'text_field',
			'lastname' => 'text_field',
			'email' => 'email',
			'message' => 'textarea_field',
		])
		->validate([
			'firstname' => ['required'],
			'lastname' => ['required'],
			'email' => ['required','email'],
			'message' => [],
		])
		->save(
			title: fn($data) => $data['firstname'] . ' ' . $data['lastname'] . ' <' . $data['email'] . '>',
			content: fn($data) => $data['message'],
		)
		->send(
			title: fn($data) => 'Nouveau message de ' . $data['firstname'] . ' ' . $data['lastname'],
			content: fn($data) => 'Prénom: ' . $data['firstname'] . PHP_EOL . 'Nom: ' . $data['lastname'] . PHP_EOL . 'Email: ' . $data['email'] . PHP_EOL . 'Message:' . PHP_EOL . $data['message'],
		)
		->feedback();
}

add_action('admin_post_nopriv_clinicoeurs_contact_form', 'clinicoeurs_execute_contact_form');
add_action('admin_post_clinicoeurs_contact_form', 'clinicoeurs_execute_contact_form');

// Travailler avec la session de PHP
function clinicoeurs_session_flash(string $key, mixed $value)
{
	if(! isset($_SESSION['clinicoeurs_flash'])) {
		$_SESSION['clinicoeurs_flash'] = [];
	}

	$_SESSION['clinicoeurs_flash'][$key] = $value;
}

function clinicoeurs_session_get(string $key)
{
	if(isset($_SESSION['clinicoeurs_flash']) && array_key_exists($key, $_SESSION['clinicoeurs_flash'])) {
		// 1. Récupérer la donnée qui a été flash.
		$value = $_SESSION['clinicoeurs_flash'][$key];
		// 2. Supprimer la donnée de la session.
		unset($_SESSION['clinicoeurs_flash'][$key]);
		// 3. Retourner la donnée récupérée.
		return $value;
	}

	// La donnée n'existait pas dans la session flash, on retourne null.
	return null;
}

function dd($var){
	echo '<pre>';
	var_dump($var);
	echo '<pre>';
	die;
}


//image function
function image(string $image_id){
	$image_info = [];
	$image_info['id'] = $image_id;
	$image_info['alt_text'] = get_post_meta($image_id, '_wp_attachment_image_alt', true);
	$image_info['image_url']  = wp_get_attachment_image_url($image_id);
	$image_info['srcset']= wp_get_attachment_image_srcset($image_id);
	return $image_info;
}

//image size
add_image_size('w500', 500, 9999, false);
add_image_size('w400', 400, 9999, false);
add_image_size('w300', 300, 9999, false);
add_image_size('w250', 250, 9999, false);
add_image_size('w150', 150, 9999, false);
add_image_size('w100', 100, 9999, false);
add_image_size('w80', 80, 9999, false);
add_image_size('w60', 60, 9999, false);

add_image_size('h70', 9999, 70, false);
add_image_size('h55', 9999, 55, false);
add_image_size('h40', 9999, 40, false);

//disable automatic tag p on wysiwyg content
function disable_wpautop(): void {
	remove_filter('the_content', 'wpautop');
	remove_filter('the_excerpt', 'wpautop');
	remove_filter('acf_the_content', 'wpautop');
}

add_action('init', 'disable_wpautop');

//add_action('admin_menu', function (){
//	remove_menu_page('plugins.php');
//});
