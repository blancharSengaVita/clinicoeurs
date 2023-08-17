<!doctype html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content=""/> <!-- clowns avec -->
	<meta name="keywords" content="clowns hospitalier"/>
	<link rel="stylesheet" href="<?= get_stylesheet_directory_uri() . '/public/css/site.css'; ?>"/>
	<script src="<?= get_stylesheet_directory_uri() . '/public/js/main.js'; ?>" defer></script>
	<title> <?= __(get_the_title(), 'clinicoeurs'); ?> </title>
	<link rel="apple-touch-icon" sizes="180x180" href="<?= image(get_field('logo'))['image_url'] ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?= image(get_field('logo'))['image_url'] ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= image(get_field('logo'))['image_url'] ?>">
</head>
<body>
<h1 class="sro"><?= __(get_the_title(), 'clinicoeurs'); ?></h1>
<header class="header">
	<div class="header__container">
		<a class="header__logo logo" href="<?= home_url() ?>">
			<div class="logo__container">
				<img class="logo__image" title="Vers la page d'accueil" src="<?= image(get_field('logo'))['image_url'] ?>" alt="<?= image(get_field('logo'))['alt_text'] ?>">
				<p class="logo__text"><?= get_bloginfo(); ?></p>
			</div>
		</a>


	</div>
	<nav class="nav header__container menu menu--desktop display-none">
		<h2 class="sro">Navigation principale</h2>
		<ul class="nav__list">
			<?php foreach (clinicoeurs_get_menu('main') as $link): ?>
				<li class="nav__item">
					<a href="<?= $link->href; ?>" class="item__link link--menu">
						<span class="link__label">
							<?= $link->label; ?>
						</span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</nav>

	<div class="header__container menu menu--mobile">

		<input type="checkbox" name="menu" id="menu" class="sro menu__checkbox">
		<label for="menu" class="menu__open ">
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu" width="40" height="40" viewBox="0 0 24 24" stroke-width="1">
				<line x1="4" x2="20" y1="12" y2="12"></line>
				<line x1="4" x2="20" y1="6" y2="6"></line>
				<line x1="4" x2="20" y1="18" y2="18"></line>
			</svg>
		</label>

		<div class="menu__content">
			<label for="menu" class="menu__close">
				<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
					<line x1="18" x2="6" y1="6" y2="18"/>
					<line x1="6" x2="18" y1="6" y2="18"/>
				</svg>
			</label>

			<nav class="menu__nav nav">
				<h2 class="header__title sro"> Menu de navigation principale </h2>
				<?php foreach (clinicoeurs_get_menu('main') as $link): ?>
					<a href="<?= $link->href; ?>" class="nav__link">
						<span class="nav__label">
							<?= $link->label; ?>
						</span>
					</a>
				<?php endforeach; ?>
			</nav>
		</div>
	</div>
</header>
<!--	--><?php //dd('') ?>



