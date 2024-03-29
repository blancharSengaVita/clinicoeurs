<?php /* Template Name: Homepage template */ ?>
<?php get_header(); ?>
<?php if (have_posts()): while (have_posts()):the_post(); ?>
	<main class="home">
		<div class="hero">
			<div class="title__container">
				<img class="hero__shape hero__circle" src="<?= get_site_url() . "/wp-content/uploads/2023/07/Ellipse-12.svg" ?>" alt="">
				<h2 class="hero__title"> <?= __(get_field('tagline'), 'clinicoeurs') ?> </h2>
			</div>

			<img class="hero__shape hero__polygon" src="<?= get_site_url() . "/wp-content/uploads/2023/07/Polygon-7.svg" ?>" alt="">
			<img class="hero__shape hero__star" src="<?= get_site_url() . "/wp-content/uploads/2023/07/Star6.svg" ?>" alt="">

			<img class="hero__shape hero__rectangle" src="<?= get_site_url() . "/wp-content/uploads/2023/07/Rectangle-43.svg" ?>" alt="">
			<div class="hero__container">
				<p class="hero__paragraphe"> <?= __(get_field('excerpt'), 'clinicoeurs') ?>  </p>
				<a target="_blank" class="hero__link" href=""><?= __(get_field('excerpt_link')['link_label'], 'clinicoeurs') ?> </a>

			</div>

		</div>

		<Section class="services">
			<h2 class="services__title"><?= __(get_field('service_section')['section_title'], 'clinicoeurs') ?></h2>
			<h2 class="sro"><?= __(get_field('service_section')['section_title'], 'clinicoeurs') ?></h2>
			<div class="services__container">
				<nav class="services__tabs tabs">
					<h3 class="sro"> Menu des services </h3>
					<ul class="tabs__list">
						<?php $tabs_id = 1 ?>
						<?php foreach (get_field('service_section')['services'] as $services): ?>
							<li class="tabs__item">
								<button data-id="section-<?= $tabs_id ?>" class="tabs__links">
									<?php $tabs_id++ ?>
									<?= __($services['service']['service_name'], 'clinicoeurs') ?>
								</button>
								<img class="link__image" src="<?= __($services['service']['service_symbol'], 'clinicoeurs') ?>" alt="">
							</li>
						<?php endforeach; ?>
					</ul>
				</nav>
				<div class="tabs__container">
					<?php $content_id = 1; ?>
					<?php foreach (get_field('service_section')['services'] as $services): ?>
						<?php
						$image_id = $services['service']['service_image'];
						$alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);
						$image_url = wp_get_attachment_image_url($image_id);
						$srcset = wp_get_attachment_image_srcset($image_id)
						?>

						<article id="section-<?= $content_id ?>" class="tabs__content content">
							<img class="content__image" srcset="<?= $srcset ?>" src="<?= $image_url ?>" alt="<?= __($alt_text, 'clinicoeurs') ?>" sizes="(max-width: 767px) 300px, (min-width: 768px) 400px, 400px">
							<h3 class="content__title">  <?= __($services['service']['service_title'], 'clinicoeurs') ?> </h3>
							<p class="content__paragraph"> <?= __($services['service']['service_text'], 'clinicoeurs') ?> </p>
							<a  target="_blank" class="content__link content__link--section-<?= $content_id ?>" href="<?= get_home_url() . $services['service']['service_link'] ?>" title="<?= __($services['service']['service_link_title'], 'clinicoeurs') ?>">  <?= __($services['service']['service_link_label'], 'clinicoeurs') ?> </a>
						</article>
						<?php $content_id++; endforeach; ?>
				</div>
			</div>
		</Section>

		<section class="support">
			<?php
			$image_id = get_field('support_section')['section_image'];
			$alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);
			$image_url = wp_get_attachment_image_url($image_id);
			$srcset = wp_get_attachment_image_srcset($image_id);
			$content = get_field('support_section');
			?>

			<h2><?= __($content['section_title'], 'clinicoeurs') ?></h2>
			<p><?= __($content['section_text'], 'clinicoeurs') ?></p>
			<a href="<?= get_home_url() . $content['section_link'] ?>" title="<?= __($content['section_link_title'], 'clinicoeurs') ?>"> <?= __($content['section_link_label'], 'clinicoeurs') ?> </a>
			<img srcset="<?= $srcset ?>" src="<?= $image_url ?>" alt="<?= __($alt_text, 'clinicoeurs') ?>" sizes="(max-width: 767px) 300px, (max-width: 768px) 400px, 450px">
		</section>

		<section class="volunteering">
			<h2 class="volunteering__title"> <?= __(get_field('volunteering_section_1')['section_title'], 'clinicoeurs') ?>  </h2>
			<p class="volunteering__text"> <?= __(get_field('volunteering_section_1')['section_text'], 'clinicoeurs') ?> </p>

			<?php
			// Faire une requête en DB pour récupérer 3 projets
			$job = new WP_Query([
					'post_type' => 'poste',
					'posts_per_page' => 4,
			]); ?>
			<div class="volunteering__container">
				<?php // Lancer la boucle pour afficher chaque poste
				if ($job->have_posts()): while ($job->have_posts()):
					$job->the_post();
					?>
					<?php $content = get_field('job_presentation');
//					dd(get_field($content['job_location']));
					?>

					<article class="job job__card--<?= $content['card_color'] ?> ">
						<img class="style-svg" style="color: red;" src="<?= wp_get_attachment_image_url($content['job_symbol']) ?>" alt="">
						<h3 class=""><?= get_the_title(); ?> </h3>
						<dl class="job__container">
							<dd><?= __($content['job_location']['label'], 'clinicoeurs') ?></dd>
							<dt><?= __($content['job_location']['location'], 'clinicoeurs') ?></dt>
						</dl>
						<dl class="job__container">
							<dd><?= __($content['job_schedule']['label'], 'clinicoeurs') ?></dd>
							<dt><?= __($content['job_schedule']['schedule'], 'clinicoeurs') ?></dt>
						</dl>
						<dl class="job__container">
							<dd><?= __($content['job_description']['label'], 'clinicoeurs') ?></dd>
							<dt><?= __($content['job_description']['description'], 'clinicoeurs') ?></dt>
						</dl>
					</article>

				<?php endwhile; else: ?>
					<p> Aucune annonce pour l'instant </p>
				<?php endif;
				wp_reset_query(); ?>
			</div>

			<a href="<?= __(get_field('volunteering_section_1')['section_link'], 'clinicoeurs') ?>"
			   title="<?= __(get_field('volunteering_section_1')['section_link_title'], 'clinicoeurs') ?>">
				<?= __(get_field('volunteering_section_1')['section_link_label'], 'clinicoeurs') ?>
			</a>
		</section>

		<div class="volunteering__bg">
			<img src="<?= get_site_url() . "/wp-content/uploads/2023/08/banderole4.svg" ?>" alt="">
			<section class="volunteering__insert">
				<h3 class="sro"> Nous avons tous un talent </h3>
				<a href="<?= get_home_url() . '/contact/' ?>">
					<p> <?= __(get_field('volunteering_section_1')['volunteering_insert'], 'clinicoeurs') ?> </p>
				</a>
			</section>
			<img src="<?= get_site_url() . "/wp-content/uploads/2023/08/banderole4.svg" ?>" alt="">
		</div>


		<section class="product__section product">
			<div class="product__container">
				<h2 class="product__title">
					<?= __(get_field('product_section')['section_title'], 'clinicoeurs') ?>
				</h2>
				<a target="_blank" class="product__link--more" href="<?= __(get_field('product_section')['section_link'], 'clinicoeurs') ?>"
				   title="<?= __(get_field('product_section')['section_link_text'], 'clinicoeurs') ?>">
					<?= __(get_field('product_section')['section_link_text'], 'clinicoeurs') ?>
				</a>
			</div>


			<div class="product__container">
				<?php
				// Faire une requête en DB pour récupérer 3 projets
				$product = new WP_Query([
						'post_type' => 'produit',
						'posts_per_page' => 9999,
				]); ?>

				<?php // Lancer la boucle pour afficher chaque poste
				if ($product->have_posts()): while ($product->have_posts()):
					$product->the_post();
					?>

					<a target="_blank" class="product__link--product" href="<?= __(get_field('category_link'), 'clinicoeurs') ?>"
					   title="<?= __(get_field('category_link_title'), 'clinicoeurs') ?>">
						<article class="product__card product__card--<?= get_field('card_color') ?> ">
							<div>
								<img srcset="<?= wp_get_attachment_image_srcset(get_field('category_image')) ?>" src="<?= image(get_field('category_image'))['image_url'] ?>"
									 alt="<?= __(image(get_field('category_image'))['alt_text'], 'clinicoeurs') ?>" sizes="(min-width: 250px) 250px">
							</div>
							<h3><?= __(get_the_title(), 'clinicoeurs') ?></h3>
						</article>
					</a>
				<?php endwhile; else: ?>
					<p> Aucune annonce pour l'instant </p>
				<?php endif;
				wp_reset_query(); ?>
			</div>
		</section>

		<div class="news__background">
			<section class="news news__section">

				<h2 class="news__title">
					<?= __(get_field('news_section')['section_title'], 'clinicoeurs') ?>
				</h2>
				<div class="news__container">
					<?php
					// Faire une requête en DB pour récupérer 3 projets
					$recent_post = new WP_Query([
							'post_type' => 'post',
							'posts_per_page' => 3,
					]); ?>

					<?php // Lancer la boucle pour afficher chaque poste
					if ($recent_post->have_posts()): while ($recent_post->have_posts()):
						$recent_post->the_post();
						?>
						<a href="<?= get_field('article')['article_link'] ?>">
							<article class="news__item">
								<h3 class="item__title">
									<?= get_the_title() ?>
								</h3>
								<img class="item__img" srcset="<?= wp_get_attachment_image_srcset(get_field('article')['article_image']) ?>" src="<?= image(get_field('article')['article_image'])['image_url'] ?>"
									 alt="<?= __(image(get_field('article')['article_image'])['alt_text'], 'clinicoeurs') ?>"
									 sizes="(max-width: 480px) 300px,
						 (max-width: 1280px) 400px,
						 (min-width: 1281px) 500px"
								>

								<p class="item__date">
									<?= get_the_date() ?>
								</p>

								<p class="item__exercpt">
									<?= __(get_field('article')['article_summary'], 'clinicoeurs') ?>
								</p>
							</article>
						</a>
					<?php endwhile; else: ?>
						<p> Aucune nouvelle pour l'instant </p>
					<?php endif;
					wp_reset_query(); ?>
				</div>
			</section>
		</div>

		<section class="testimonials testimonials_section">
			<h2 class="testimonials__title">
				<?= __(get_field('testimonials_section')['section_title'], 'clinicoeurs') ?>
			</h2>

			<?php
			// Faire une requête en DB pour récupérer 3 projets
			$testimonials = new WP_Query([
					'post_type' => 'temoignage',
					'posts_per_page' => 3,
			]); ?>
			<div class="testimonials__container">
				<?php // Lancer la boucle pour afficher chaque poste
				if ($testimonials->have_posts()): while ($testimonials->have_posts()):
					$testimonials->the_post();
					?>
					<article class="testimonials__card">
						<h3 class="sro">
							<?= get_the_title() ?>
						</h3>
						<blockquote>&laquo;&nbsp;<?= get_the_content() ?>&nbsp;&raquo;</blockquote>
						<div class="testimonials__sub-container">
							<img src="<?= image(get_field('symbol'))['image_url'] ?>"
								 alt="">
							<p>
								<?= get_the_title() ?>
							</p>
						</div>
					</article>
				<?php endwhile; else: ?>
					<p> Aucune nouvelle pour l'instant </p>
				<?php endif;
				wp_reset_query(); ?>
			</div>
			<a href="<?= get_home_url() . '/contact/' ?>"><?= get_field("testimonials_section")['articles_link_label'] ?></a>
		</section>

		<section class="sponsor sponsor__section">
			<h2 class="sponsor__title"> <?= get_field('sponsor_section')['section_slogan'] ?> </h2>
			<!-- N'oublie pas de mettre les alt dans l'admin ET de génerer toutes les tailles d'images -->
			<div class="sponsor__container">
				<?php foreach (get_field('sponsor_section')['sponsors_images'] as $sponsor): ?>
					<img srcset=" <?= wp_get_attachment_image_srcset($sponsor['sponsor_image']) ?> " src="<?= wp_get_attachment_url($sponsor['sponsor_image']) ?>" alt="<?= __(get_post_meta($sponsor['sponsor_image'], '_wp_attachment_image_alt', true), 'clinicoeurs') ?>"
						 sizes="(max-width: 767px) 60px,
						 (max-width: 960px) 80px,
						 (min-width: 961px) 100px">
				<?php endforeach; ?>
			</div>
		</section>

	</main>
<?php endwhile; endif; ?>
<?php get_footer(); ?>

