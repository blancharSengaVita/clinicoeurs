<?php /* Template Name: Contact template */ ?>
<?php get_header(); ?>
<?php if (have_posts()): while (have_posts()):the_post(); ?>
	<main class="contact">
		<section class="hero">
			<?php
			$hero_image = get_field('hero_image');
			$hero_title = get_field('hero_title');
			$hero_tagline = get_field('hero_tagline');
			$image_srcset = wp_get_attachment_image_srcset($hero_image);
			$image_url = wp_get_attachment_url($hero_image);
			?>

			<img class="hero__image" srcset="<?= $image_srcset ?>" src="<?= $image_url ?>" alt=""
				 sizes="100vw">
			<h2 class="hero__title"><?= $hero_title ?></h2>
			<p class="hero__tagline"><?= $hero_tagline ?></p>
		</section>
		
		<section class="address">
			<?php
			$address = get_field('adress_section');
			$title = __($address['title'], 'clinicoeurs');
			$street = __($address['street'], 'clinicoeurs');
			$city = __($address['city'], 'clinicoeurs');
			$phone_number = __($address['phone_number'], 'clinicoeurs');
			$email = __($address['email'], 'clinicoeurs');

			$image = $address['image'];
			$image_srcset = wp_get_attachment_image_srcset($image);
			$image_alt = __(get_post_meta($image, '_wp_attachment_image_alt', true));
			$image_url = wp_get_attachment_url($image);
			?>

			<h2 class="address__title"><?= $title ?></h2>
			<div class="address__container">
				<div class="address__sub-container address__sub-container--info">
					<a href="https://www.google.com/maps?q=<?= urlencode($street) ?>" title="Ouvrir <?= $street ?> sur Google Maps"><?= $street ?></a>
					<a href="https://www.google.com/search?q=<?= urlencode($city) ?>" title="En savoir plus sur <?= $city ?>"><?= $city ?></a>
					<a href="tel:<?= $phone_number ?>" title="Appeler <?= $phone_number ?>"><?= $phone_number ?></a>
					<a href="mailto:<?= $email ?>" title="Envoyer un mail à <?= $email ?>"><?= $email ?></a>
				</div>
				<div class="address__sub-container">
					<img src="<?= $image_url?>" alt="<?= $image_alt?>" srcset="<?=$image_srcset?>" sizes="(max-width: 767px) 300px,
                (max-width: 960px) 400px,
                (min-width: 961px) 500px">
				</div>
			</div>
		</section>
	</main>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
