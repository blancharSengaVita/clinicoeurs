<footer>
	<ul class="footer__container">
		<?php foreach (clinicoeurs_get_menu('footer') as $link): ?>
			<li class="footer__link">
				<a href="<?= $link->href; ?>" class="footer__url"><?= $link->label; ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
	<div class="footer__container">
		<p>© <?= get_bloginfo() ?></p>
		<a href="#">Mention légales</a>
		<p>Fait par <a href="https://blanchar.be" title="vers blanchar.be">BLANCHAR !</a></p>
	</div>
	<div class="footer__container footer__contact">
		<?php
		$contact = get_field('contact');
		$street = __($contact['street'], 'clinicoeurs');
		$city = __($contact['city'], 'clinicoeurs');
		$phone_number = __($contact['phone_number'], 'clinicoeurs');
		$email = __($contact['email'], 'clinicoeurs');
		?>

		<a class="contact__link" target="_blank" href="https://www.google.com/maps?q=<?= urlencode($street) ?>" title="Ouvrir <?= $street ?> sur Google Maps"><?= $street ?></a>
		<a class="contact__link" target="_blank" href="https://www.google.com/search?q=<?= urlencode($city) ?>" title="En savoir plus sur <?= $city ?>"><?= $city ?></a>
		<a class="contact__link" target="_blank" href="tel:<?= $phone_number ?>" title="Appeler <?= $phone_number ?>"><?= $phone_number ?></a>
		<a class="contact__link" target="_blank" href="mailto:<?= $email ?>" title="Envoyer un mail à <?= $email ?>"><?= $email ?></a>
	</div>
</footer>
</body>
</html>