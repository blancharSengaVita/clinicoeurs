<?php get_header(); ?>
<?php if (have_posts()): while (have_posts()):the_post(); ?>
	<main class="single-service">
	<?php get_template_part('_hero-template'); ?>
	<section class="single-service__section section">
		<?php
		$section = get_field('section_1');
		$title = __($section['title'], 'clinicoeurs');
		$text = __($section['text'], 'clinicoeurs');
		$image_id = $section['image'];
		$image_srcset = wp_get_attachment_image_srcset($image_id);
		$image_alt = __(get_post_meta($image_id, '_wp_attachment_image_alt', true), 'clinicoeurs');
		$image_url = wp_get_attachment_url($image_id);
		?>
		<img class="section__image" srcset="<?= $image_srcset ?>" src="<?= $image_url ?>" alt="<?= $image_alt ?>">
		<h3 class="section__title"> <?= $title ?></h3>
		<p class="section_text"> <?= $text ?></p>
	</section>

	<div class="section__bg">
	<section class="single-service__section--reversed section">
		<?php
		$section = get_field('section_2');
		$title = __($section['title'], 'clinicoeurs');
		$text = __($section['text'], 'clinicoeurs');
		$image_id = $section['image'];
		$image_srcset = wp_get_attachment_image_srcset($image_id);
		$image_alt = __(get_post_meta($image_id, '_wp_attachment_image_alt', true), 'clinicoeurs');
		$image_url = wp_get_attachment_url($image_id);
		?>
		<img class="section__image" srcset="<?= $image_srcset ?>" src="<?= $image_url ?>" alt="<?= $image_alt ?>">
		<h3 class="section__title"><?= $title ?></h3>
		<p class="section_text"><?= $text ?></p>
	</section>
	</div>

		<section class="single-service__section--member single-service__section--color-<?= 'zer' ?> section--member ">
			<?php
			$section = get_field('member_section');
			$title = $section['title'];
			$members = $section['members'];
			?>

			<h3> <?= $title ?> </h3>
			<?php foreach ($members as $member):?>
				<p> <?= $member['name'] ?> </p>
			<?php endforeach;?>
		</section>

		<a href="<?= get_home_url() ?>/contact/" class="call-to-action" title="aller vers la page de contact"> <?= get_field('call_to_action')['text'] ?> </a>
	</main>
	<?php endwhile;
endif; ?>
	<?php get_footer(); ?>