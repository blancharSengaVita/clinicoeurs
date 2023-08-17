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

		<div class="contact__information">
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
						<a target="_blank" href="https://www.google.com/maps?q=<?= urlencode($street) ?>" title="Ouvrir <?= $street ?> sur Google Maps"><?= $street ?></a>
						<a target="_blank" href="https://www.google.com/search?q=<?= urlencode($city) ?>" title="En savoir plus sur <?= $city ?>"><?= $city ?></a>
						<a target="_blank" href="tel:<?= $phone_number ?>" title="Appeler <?= $phone_number ?>"><?= $phone_number ?></a>
						<a target="_blank" href="mailto:<?= $email ?>" title="Envoyer un mail à <?= $email ?>"><?= $email ?></a>
					</div>
					<div class="address__sub-container">
						<img src="<?= $image_url ?>" alt="<?= $image_alt ?>" srcset="<?= $image_srcset ?>" sizes="(max-width: 767px) 300px,
                (max-width: 960px) 400px,
                (min-width: 961px) 500px">
					</div>
				</div>
			</section>
			<section class="section__form">
				<?php
				$feedback = clinicoeurs_session_get('clinicoeurs_contact_form_feedback') ?? false;
				$errors = clinicoeurs_session_get('clinicoeurs_contact_form_errors') ?? [];

				$title = __(get_field('form_title'), 'clinicoeurs');
				?>

<!--				<h2 class="sro"> Formulaire de contact </h2>-->
				<p class="form__title"> <?= $title ?> </p>

				<?php if ($feedback): ?>
					<div class="success"">
					<p>Merci&nbsp;! Votre message a bien été envoyé.</p>
				<?php endif; ?>

				<?php if ($errors): ?>
					<div class="error">
						<p>Attention&nbsp;! Merci de corriger les erreurs du formulaire.</p>
					</div>
				<?php endif; ?>

				<form action="<?= esc_url(admin_url('admin-post.php')); ?>" method="POST" class="contact">
					<fieldset class="contact__info">
						<div class="contact__container ">
							<div class="field">
								<label for="firstname" class="field__label">Votre prénom</label>
								<input type="text" name="firstname" id="firstname" class="field__input"/>
								<?php if ($errors['firstname'] ?? null): ?>
									<p class="field__error"><?= $errors['firstname']; ?></p>
								<?php endif; ?>
							</div>
							<div class="field">
								<label for="lastname" class="field__label">Votre nom</label>
								<input type="text" name="lastname" id="lastname" class="field__input"/>
								<?php if ($errors['lastname'] ?? null): ?>
									<p class="field__error"><?= $errors['lastname']; ?></p>
								<?php endif; ?>
							</div>
						</div>

						<div class="field">
							<label for="email" class="field__label">Votre adresse mail</label>
							<input type="email" name="email" id="email" class="field__input"/>
							<?php if ($errors['email'] ?? null): ?>
								<p class="field__error"><?= $errors['email']; ?></p>
							<?php endif; ?>
						</div>
						<div class="field">
							<label for="message" class="field__label">Votre message</label>
							<textarea name="message" id="message" cols="30" rows="10" class="field__textarea"></textarea>
							<?php if ($errors['message'] ?? null): ?>
								<p class="field__error"><?= $errors['message']; ?></p>
							<?php endif; ?>
						</div>
					</fieldset>
					<div class="contact__footer">
						<input type="hidden" name="action" value="clinicoeurs_contact_form"/>
						<input type="hidden" name="contact_nonce" value="<?= wp_create_nonce('clinicoeurs_contact_form'); ?>"/>
						<button class="contact__submit" type="submit">Envoyer</button>
					</div>
				</form>
			</section>
		</div>
	</main>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
