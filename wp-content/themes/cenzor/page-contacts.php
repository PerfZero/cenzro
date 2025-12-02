<?php
/**
 * Template Name: Контакты
 * The template for displaying contacts page
 *
 * @package cenzor
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	while ( have_posts() ) :
		the_post();
		?>

		<?php get_template_part( 'template-parts/breadcrumbs' ); ?>

		<section class="contacts-page">
			<div class="container">
				<div class="contacts-layout">
					<div class="contacts-left">
						<h1 class="contacts-title">Контакты</h1>
						
						<div class="contacts-info">
							<div class="contact-item">
								<div class="contact-label">Позвоните нам:</div>
								<a href="tel:88003026256" class="contact-value contact-phone">
									<?php 
									$phone = do_shortcode( '[belingogeo_city_field field="city_phone"]' );
									echo $phone ? esc_html( $phone ) : '8 (800) 302-62-56';
									?>
								</a>
							</div>

							<div class="contact-item">
								<div class="contact-label">Пишите на почту:</div>
								<a href="mailto:cenzor61@mail.ru" class="contact-value">cenzor61@mail.ru</a>
							</div>

			

							<div class="contact-item">
								<div class="contact-label">График работы:</div>
								<div class="contact-value">Пн.-Пт.: с 8:00 до 17:00</div>
							</div>
						</div>
					</div>

					<div class="contacts-center">
						<div class="contacts-map">
                        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Ad87b8da530aa39154d6c4cab3a17c1a287d1b72180e861214d3efb85c9481971&amp;width=500&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script></div>
					</div>

					<div class="contacts-right">
						<div class="contacts-form-widget">
							<h3 class="contacts-form-title">Остались вопросы?</h3>
							<p class="contacts-form-text">Оставьте ваши контактные данные, наш специалист перезвонит через 15 минут</p>
							
							<form class="contacts-form" method="post" action="">
								<div class="form-group">
									<input type="text" id="contacts-name" name="name" autocomplete="name" required placeholder="Введите ваше имя">
								</div>
								<div class="form-group">
									<input type="email" id="contacts-email" name="email" autocomplete="email" required placeholder="Введите ваш e-mail">
								</div>
								<div class="form-group">
									<input type="tel" id="contacts-phone" name="phone" autocomplete="tel" required placeholder="Введите ваш телефон*">
								</div>
								<button type="submit" class="contacts-submit-button">
									Оставить заявку
									<i class="fas fa-arrow-right"></i>
								</button>
								<div class="contacts-form-disclaimer">
									Оставляя контакты, вы даёте согласие на <a href="/soglasie-na-obrabotku-personalnyh-dannyh/" target="_blank">обработку своих персональных данных</a> и получение рекламных сообщений в соответствии с <a href="/politika-operatora-v-otnoshenii-obrabotki-personalnyh-dannyh/" target="_blank">Политикой конфиденциальности</a>
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="company-details-section">
					<h2 class="company-details-title">Реквизиты компании</h2>
					<table class="company-details-table">
						<tr>
							<td class="detail-label">Наименование организации</td>
							<td class="detail-value">ООО "ЦЕНЗОР"</td>
						</tr>
						<tr>
							<td class="detail-label">Краткое наименование организации</td>
							<td class="detail-value">ООО "ЦЕНЗОР"</td>
						</tr>
						<tr>
							<td class="detail-label">Юридический адрес</td>
							<td class="detail-value">346500, Ростовская область, г. Шахты, ул. Пролетарская, д. 188</td>
						</tr>
						<tr>
							<td class="detail-label">Почтовый адрес</td>
							<td class="detail-value">346500, Ростовская область, г. Шахты, ул. Пролетарская, д. 188</td>
						</tr>
						<tr>
							<td class="detail-label">ИНН</td>
							<td class="detail-value">6155067714</td>
						</tr>
						<tr>
							<td class="detail-label">КПП</td>
							<td class="detail-value">615501001</td>
						</tr>
						<tr>
							<td class="detail-label">ОГРН</td>
							<td class="detail-value">1136182002956</td>
						</tr>
						<tr>
							<td class="detail-label">Дата регистрации</td>
							<td class="detail-value">17 сентября 2013 года</td>
						</tr>
						<tr>
							<td class="detail-label">Уставный капитал</td>
							<td class="detail-value">12 000 рублей</td>
						</tr>
						<tr>
							<td class="detail-label">Руководитель</td>
							<td class="detail-value">Солодилова Дарья Станиславовна</td>
						</tr>
						<tr>
							<td class="detail-label">P/c</td>
							<td class="detail-value">-</td>
						</tr>
						<tr>
							<td class="detail-label">K/c</td>
							<td class="detail-value">-</td>
						</tr>
						<tr>
							<td class="detail-label">БИК</td>
							<td class="detail-value">-</td>
						</tr>
					</table>
				</div>
			</div>
		</section>

	<?php endwhile; ?>

</main>

<?php
get_footer();

