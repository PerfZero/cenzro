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
				Цены на сайте носят информационный характер и ни при каких условиях не являются публичной офертой. Отправляя свои данные, Вы даете согласие в соответствии с ФЗ «О персональных данных». Ознакомиться с политикой конфиденциальности можно <a href="/politika-operatora-v-otnoshenii-obrabotki-personalnyh-dannyh/">здесь</a>
			</div>
			<div class="footer-policies">
				<a href="/politika-operatora-v-otnoshenii-obrabotki-personalnyh-dannyh/">Политика оператора в отношении обработки персональных данных</a>
				<a href="/polzovatelskoe-soglashenie-publichnaya-oferta/">Пользовательское соглашение (публичная оферта)</a>
				<a href="/soglasie-na-obrabotku-personalnyh-dannyh/">Согласие на обработку персональных данных</a>
				<a href="/politika-v-otnoshenii-fajlov-cookie/">Политика в отношении файлов cookie</a>
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

<div class="mobil_trips">
	<div class="trips_1 trip">
		<a href="#consultation" class="mobil-trips-application">ЗАЯВКА</a>
	</div>
	<div class="trips_1 trips-learn-more trip">
		<a href="#course-pdf-modal" class="mobil-trips-learn-more">ПОЛУЧИТЬ КП</a>
	</div>
	<div class="trips_block">
		<div class="trips_2">
			<?php 
			$phone = do_shortcode( '[belingogeo_city_field field="city_phone"]' );
			$phone_clean = $phone ? preg_replace( '/[^0-9]/', '', $phone ) : '88003026256';
			?>
			<a href="tel:<?php echo esc_attr( $phone_clean ); ?>">
				<i class="fas fa-phone"></i>
			</a>
		</div>
		<div class="trips_3">
			<a href="https://wa.me/79185080155?text=Я%20заинтересован%20в%20заказе%20ваших%20услуг" target="_blank">
				<i class="fab fa-whatsapp"></i>
			</a>
		</div>
	</div>
</div>

<div id="modal" class="modal-overlay">
	<div class="modal-content">
		<button class="modal-close" aria-label="Закрыть">&times;</button>
		<h2 class="modal-title">Заказать консультацию</h2>
		<form class="modal-form" method="post" action="">
			<div class="form-group">
				<label for="modal-name">Ваше имя *</label>
				<input type="text" id="modal-name" name="name" autocomplete="name" required>
			</div>
			<div class="form-group">
				<label for="modal-phone">Телефон *</label>
				<input type="tel" id="modal-phone" name="phone" autocomplete="tel" required>
			</div>
			<div class="form-group">
				<label for="modal-email">Email</label>
				<input type="email" id="modal-email" name="email" autocomplete="email">
			</div>
			<div class="form-group">
				<label for="modal-message">Сообщение</label>
				<textarea id="modal-message" name="message" rows="4" autocomplete="off"></textarea>
			</div>
			<div class="form-group">
				<label class="checkbox-label">
					<input type="checkbox" name="consent" required>
					<span>Я согласен на <a href="/soglasie-na-obrabotku-personalnyh-dannyh/" target="_blank">обработку персональных данных</a> в соответствии с <a href="/politika-operatora-v-otnoshenii-obrabotki-personalnyh-dannyh/" target="_blank">Политикой конфиденциальности</a></span>
				</label>
			</div>
			<button type="submit" class="modal-submit">Отправить</button>
		</form>
	</div>
</div>

	<div id="course-pdf-modal" class="modal-overlay">
		<div class="modal-content">
			<button class="modal-close" aria-label="Закрыть">&times;</button>
			<h2 class="modal-title">Получение коммерческого предложения</h2>
			<form id="course-pdf-form" class="modal-form" method="post" action="">
				<div class="form-group float-label-group">
					<input type="text" id="course-pdf-name" name="name" autocomplete="name" required>
					<label for="course-pdf-name">Ваше имя *</label>
				</div>
				<div class="form-group float-label-group">
					<input type="tel" id="course-pdf-phone" name="phone" autocomplete="tel" required>
					<label for="course-pdf-phone">Телефон *</label>
				</div>
				<div class="form-group float-label-group">
					<input type="email" id="course-pdf-email" name="email" autocomplete="email" required>
					<label for="course-pdf-email">Email *</label>
				</div>
				<div class="form-group">
					<label>Тип лица *</label>
					<div class="radio-group">
						<label class="radio-label">
							<input type="radio" name="entity_type" value="individual" checked required>
							<span>Физическое лицо</span>
						</label>
						<label class="radio-label">
							<input type="radio" name="entity_type" value="legal" required>
							<span>Юридическое лицо</span>
						</label>
					</div>
				</div>
				<div class="form-group float-label-group" id="legal-fields" style="display: none;">
					<input type="text" id="course-pdf-company-name" name="company_name" autocomplete="organization">
					<label for="course-pdf-company-name">Название организации *</label>
				</div>
				<div class="form-group float-label-group" id="legal-fields-inn" style="display: none;">
					<input type="text" id="course-pdf-inn" name="inn" autocomplete="off">
					<label for="course-pdf-inn">ИНН *</label>
				</div>
				<div class="form-group">
					<label for="course-pdf-select">Выберите курс *</label>
					<select id="course-pdf-select" name="course" required>
						<option value="">-- Выберите курс --</option>
						<?php
						$courses = get_field( 'courses_pdf_list', 'option' );
						if ( $courses ) {
							foreach ( $courses as $index => $course ) {
								$course_name = $course['course_name'] ?? '';
								$course_file = $course['course_pdf'] ?? null;
								if ( $course_name && $course_file && !empty( $course_file['url'] ) ) {
									echo '<option value="' . esc_attr( $index ) . '">' . esc_html( $course_name ) . '</option>';
								}
							}
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label class="checkbox-label">
						<input type="checkbox" name="consent" required>
						<span>Я согласен на <a href="/soglasie-na-obrabotku-personalnyh-dannyh/" target="_blank">обработку персональных данных</a> в соответствии с <a href="/politika-operatora-v-otnoshenii-obrabotki-personalnyh-dannyh/" target="_blank">Политикой конфиденциальности</a></span>
					</label>
				</div>
				<button type="submit" class="modal-submit">Отправить</button>
			</form>
		</div>
	</div>

<div id="cookie-consent" class="cookie-consent">
	<div class="cookie-consent-content">
		<div class="cookie-consent-text">
			<p>Мы используем файлы cookie для улучшения работы сайта и персонализации контента. Продолжая использовать сайт, вы соглашаетесь с использованием cookie в соответствии с <a href="/politika-v-otnoshenii-fajlov-cookie/" target="_blank">Политикой в отношении файлов cookie</a> и <a href="/politika-operatora-v-otnoshenii-obrabotki-personalnyh-dannyh/" target="_blank">Политикой конфиденциальности</a>.</p>
		</div>
		<div class="cookie-consent-buttons">
			<button id="cookie-accept" class="cookie-btn cookie-btn-accept">Принять</button>
			<button id="cookie-decline" class="cookie-btn cookie-btn-decline">Отклонить</button>
		</div>
	</div>
</div>

<?php wp_footer(); ?>

<script>
	(function() {
		if (typeof isvek !== 'undefined' && typeof isvek.Bvi !== 'undefined' && !window.bviInstance) {
			var bviElement = document.querySelector('.bvi-open');
			if (bviElement) {
				window.bviInstance = new isvek.Bvi({
					target: '.bvi-open',
					lang: 'ru-RU'
				});
			}
		}
	})();
</script>

<script>
	(function() {
		var cookieConsent = document.getElementById('cookie-consent');
		var cookieAccept = document.getElementById('cookie-accept');
		var cookieDecline = document.getElementById('cookie-decline');
		
		function getCookie(name) {
			var matches = document.cookie.match(new RegExp(
				"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
			));
			return matches ? decodeURIComponent(matches[1]) : undefined;
		}
		
		function setCookie(name, value, days) {
			var expires = "";
			if (days) {
				var date = new Date();
				date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
				expires = "; expires=" + date.toUTCString();
			}
			document.cookie = name + "=" + (value || "") + expires + "; path=/; SameSite=Lax";
		}
		
		if (!getCookie('cookie_consent')) {
			setTimeout(function() {
				cookieConsent.classList.add('show');
			}, 1000);
		}
		
		cookieAccept.addEventListener('click', function() {
			setCookie('cookie_consent', 'accepted', 365);
			cookieConsent.classList.remove('show');
		});
		
		cookieDecline.addEventListener('click', function() {
			setCookie('cookie_consent', 'declined', 365);
			cookieConsent.classList.remove('show');
		});
	})();
</script>

<script>
	(function() {
		if (typeof Inputmask === 'undefined') return;
		
		const phoneInputs = document.querySelectorAll('input[type="tel"]');
		phoneInputs.forEach(function(input) {
			Inputmask({ 
				mask: '+7 (999) 999-99-99',
				placeholder: '+7 (___) ___-__-__',
				showMaskOnHover: false,
				showMaskOnFocus: true
			}).mask(input);
		});
		
		const innInputs = document.querySelectorAll('input[name="inn"]');
		innInputs.forEach(function(input) {
			Inputmask({ 
				mask: '9{10,12}',
				placeholder: '',
				showMaskOnHover: false,
				showMaskOnFocus: false
			}).mask(input);
		});
	})();
</script>

</body>
</html>
