<?php
/*
Template Name: Custom Hero Template
*/
?>
<section class="hero">
	<?php
	$hero_image = get_field('hero_image');
	$hero_title = get_field('hero_title');
	$hero_tagline = get_field('hero_tagline');
	$image_url = wp_get_attachment_url($hero_image);
	?>

	<div class="hero__container">
		<img class="hero__image" src="<?= $image_url ?>" alt="">
		<h2 class="hero__title"><?= $hero_title ?></h2>
	</div>
	<p class="hero__tagline"><?= $hero_tagline ?></p>
</section>