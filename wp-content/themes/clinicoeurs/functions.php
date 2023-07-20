<?php
// Disable Wordpress' default Gutenberg Editor:
add_filter('use_block_editor_for_post', '__return_false', 10);

//on peut appeler des fonctions pour supprimer des items du menu
//https://developer.wordpress.org/reference/functions/remove_menu_page/


// Enregistrer un custom post type :
function clinicoeurs_register_custom_post_types()
{
	register_post_type('benevolat', [
		'label' => 'Bénévolat',
		'description' => 'Listes des postes recherchés',
		'public' => true,
		'menu_position' => 20,
		'menu_icon' => 'dashicons-portfolio', // https://developer.wordpress.org/resource/dashicons/#pets,
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
}

add_action('init', 'clinicoeurs_register_custom_post_types');

add_action('admin_menu', function (){
	remove_menu_page('plugins.php');
});