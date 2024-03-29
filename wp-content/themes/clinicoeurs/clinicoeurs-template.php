<?php /* Template Name: Clinicoeurs template */ ?>
<?php get_header(); ?>
<?php if (have_posts()): while (have_posts()):the_post(); ?>
	<main class="clinicoeurs">
		<?php get_template_part('_hero-template'); ?>

		<section class="clinicoeurs__services services">
			<h3 class="sro"><?= $service_section = get_field('service_section')['title']; ?></h3>
			<?php
			$service_section = get_field('service_section');
			$services = $service_section['services'];
			?>
			<ul class="services__container">
				<?php foreach ($services as $service): ?>
					<?php
					$name = $service['name'];
					$exercpt = $service['exercpt'];
					$symbole_url = $service['symbol'];
					$single_url = $service['slug']
					?>
					<li class="services__item">
						<a class="services__link" href="<?= get_home_url() . $single_url ?>"  title="aller vers la page <?=$name?>">
							<article class="service__card card">
								<div class="card__container">
									<h3 class="card__title"> <?=$name?> </h3>
									<p class="card__excerpt"> <?=$exercpt?> </p>
								</div>
								<div class="card__container--symbol">
									<img class="card__symbole" src="<?=$symbole_url?>" alt="">
									<span class="card__arrow">></span>
								</div>
							</article>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</section>

		<section class="clinicoeurs__about about">
			<h2 class="sro"><?= get_field('about_us') ?></h2>
			<article class="about__story story">
				<?php
				$story = get_field('story');
				$title = $story['title'];
				$text = $story['text'];
				?>

				<h3 class="story__title"><?= $title ?></h3>
				<p class="story__text"><?= $text ?></p>
			</article>
			<article class="about__location location">
				<?php
				$location = get_field('location');
				$title = $location['title'];
				$text = $location['text'];
				?>
				<h3 class="location__title"><?= $title ?></h3>
				<p class="location__text"><?= $text ?></p>
			</article>
		</section>
		<section class="gallery clinicoeurs__gallery">
			<?php
			$gallery = get_field('gallery');
			$title = $gallery['title'];
			$pictures = $gallery['pictures'];
			?>
			<div class="gallery__container title__container">
				<h2 class="gallery__title"><?= $title ?></h2>
			</div>
			<div class="gallery__container picture__container">
				<?php if ($pictures && count($pictures) > 0): ?>
					<?php foreach ($pictures as $picture): ?>
						<!--					--><?php //dd($picture) ?>
						<?php
						$image_id = $picture;
						$alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
						$url = wp_get_attachment_image_url($image_id);
						$srcset = wp_get_attachment_image_srcset($image_id);
						?>
						<img class="gallery__picture" src="<?= $url ?>" alt="<?= $alt ?>" srcset="<?= $srcset ?>" sizes="(max-width: 767px) 300px, (min-width: 768px) 400px, 400px">
					<?php endforeach; ?>
				<?php else: ?>
					<p> il n'y a rien à afficher </p>
				<?php endif ?>
			</div>
		</section>
		<a href="<?= get_home_url() ?>/contact/" class="call-to-action" title="aller vers la page de contact"> <?= get_field('call_to_action')['text'] ?> </a>
	</main>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
