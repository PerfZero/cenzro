<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cenzor
 */

?>

<footer class="site-footer">
	<div class="container">
		<div class="footer-content">
			<div class="footer-brand">
				<?php if ( has_custom_logo() ) : ?>
					<div class="footer-logo">
						<?php the_custom_logo(); ?>
					</div>
				<?php else : ?>
					<div class="footer-logo-icon">
						<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
							<circle cx="20" cy="20" r="18" stroke="white" stroke-width="2"/>
							<circle cx="20" cy="20" r="8" fill="white"/>
						</svg>
					</div>
				<?php endif; ?>
				
			</div>

			<div class="footer-contacts">
				<div class="footer-contact-item">
					<div class="footer-contact-label">По всем вопросам</div>
					<a href="tel:88003026256" class="footer-contact-value">8 (800) 302-62-56</a>
				</div>
				<div class="footer-contact-item">
					<div class="footer-contact-label">Почта</div>
					<a href="mailto:cenzor61@mail.ru" class="footer-contact-value">cenzor61@mail.ru</a>
				</div>
				<div class="footer-contact-item">
					<div class="footer-contact-label">Адрес</div>
					<div class="footer-contact-value">
						<?php 
						$region = do_shortcode('[belingogeo_region_field field="bg_regions_name"]');
						$city = do_shortcode('[belingogeo_city_field field="city_name"]');
						$address_parts = array();
						if ( !empty($region) ) {
							$address_parts[] = $region;
						}
						if ( !empty($city) ) {
							$address_parts[] = $city;
						}
						echo implode(', ', $address_parts);
						?>
					</div>
				</div>
				<div class="footer-contact-item">
					<div class="footer-contact-label">ИНН/КПП</div>
					<div class="footer-contact-value">6155067714/615501001</div>
				</div>
			</div>

			<div class="footer-nav-column">
				<h3 class="footer-nav-title">ОБУЧЕНИЕ</h3>
				<ul class="footer-nav-menu">
					<li><a href="#">Транспортная безопасность</a></li>
					<li><a href="#">Экологическая безопасность</a></li>
					<li><a href="#">Опасный груз - ДОПОГ</a></li>
					<li><a href="#">Диспетчер Контролер Специалист БДД</a></li>
					<li><a href="#">Водитель ГБА</a></li>
					<li><a href="#">Охранник 4 разряда</a></li>
				</ul>
			</div>

			<div class="footer-nav-column">
				<h3 class="footer-nav-title">ОСНОВНЫЕ СВЕДЕНИЯ</h3>
				<ul class="footer-nav-menu">
					<li><a href="#">Структура и органы управления образовательной организацией</a></li>
					<li><a href="#">Документы</a></li>
					<li><a href="#">Самообследование автошколы</a></li>
					<li><a href="#">Образовательные стандарты и требования</a></li>
					<li><a href="#">Руководство. Педагогический (научно-педагогический) состав</a></li>
					<li><a href="#">Охранник 4 разряда</a></li>
				</ul>
			</div>

			<div class="footer-nav-column">
				<h3 class="footer-nav-title">Прочее</h3>
				<ul class="footer-nav-menu">
					<li><a href="#">Контакты</a></li>
					<li><a href="#">Прайс</a></li>
					<li><a href="#">Вход в Л.К</a></li>
					<li><a href="#">Демо Л.К</a></li>
				</ul>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="footer-promo">
				Проходить обучения у нас надежно и выгодно, потому что мы стараемся больше других!
			</div>
			<div class="footer-ministries">
				<a href="#">Министерство науки и высшего образования РФ</a>
				<a href="#">Министерство просвещения РФ</a>
			</div>
			<div class="footer-legal-text">
				Цены на сайте носят информационный характер и ни при каких условиях не являются публичной офертой. Отправляя свои данные, Вы даете согласие в соответствии с ФЗ «О персональных данных». Ознакомиться с политикой конфиденциальности можно <a href="#">здесь</a>
			</div>
			<div class="footer-policies">
				<a href="#">Политика оператора в отношении обработки персональных данных</a>
				<a href="#">Пользовательское соглашение (публичная оферта)</a>
				<a href="#">Согласие на обработку персональных данных</a>
				<a href="#">Политика в отношении файлов cookie</a>
			</div>
			<div class="footer-copyright">
				<div class="footer-copyright-text">
					© 2025. ООО "ЦЕНЗОР" При использовании материалов ссылка обязательна.
				</div>
				<div class="footer-privacy-link">
					<a href="#">Политика конфиденциальности</a>
				</div>
			</div>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>

</body>
</html>
