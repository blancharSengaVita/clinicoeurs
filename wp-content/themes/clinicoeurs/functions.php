<?php
// Démarrer le système de sessions pour pouvoir afficher des messages de feedback venant des formulaires.
if(session_status() === PHP_SESSION_NONE) session_start();

// Disable Wordpress' default Gutenberg Editor:
add_filter('use_block_editor_for_post', '__return_false', 10);

//on peut appeler des fonctions pour supprimer des items du menu
//https://developer.wordpress.org/reference/functions/remove_menu_page/


// Enregistrer un custom post type :
function clinicoeurs_register_custom_post_types()
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
}

add_action('init', 'clinicoeurs_register_custom_post_types');

register_nav_menu('main', 'Navigation principale du site web (en-tête)');
register_nav_menu('footer', 'Navigation de pied de page');

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

//add_action('admin_menu', function (){
//	remove_menu_page('plugins.php');
//});

// Travailler avec la session de PHP
function portfolio_session_flash(string $key, mixed $value)
{
	if(! isset($_SESSION['portfolio_flash'])) {
		$_SESSION['portfolio_flash'] = [];
	}

	$_SESSION['portfolio_flash'][$key] = $value;
}

function portfolio_session_get(string $key)
{
	if(isset($_SESSION['portfolio_flash']) && array_key_exists($key, $_SESSION['portfolio_flash'])) {
		// 1. Récupérer la donnée qui a été flash.
		$value = $_SESSION['portfolio_flash'][$key];
		// 2. Supprimer la donnée de la session.
		unset($_SESSION['portfolio_flash'][$key]);
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
add_image_size('w300', 300, 9999, false);
add_image_size('w150', 300, 9999, false);
add_image_size('h70', 9999, 70, false);

//disable automatic tag p on wysiwyg content
function disable_wpautop(): void {
	remove_filter('the_content', 'wpautop');
	remove_filter('the_excerpt', 'wpautop');
	remove_filter('acf_the_content', 'wpautop');
}

add_action('init', 'disable_wpautop');