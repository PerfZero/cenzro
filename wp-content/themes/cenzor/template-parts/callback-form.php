<?php
/**
 * Template part for displaying callback form sidebar
 *
 * @package cenzor
 */
?>

<aside class="page-sidebar">
	<div class="callback-form-widget">
		<h3 class="callback-form-title">У ВАС ОСТАЛИСЬ ВОПРОСЫ?</h3>
		<p class="callback-form-text">Закажите обратный звонок либо позвоните нам</p>
		
		<a href="tel:88003026256" class="callback-phone-link">
			<?php 
			$phone = do_shortcode( '[belingogeo_city_field field="city_phone"]' );
			echo $phone ? esc_html( $phone ) : '8 (800) 302-62-56';
			?>
		</a>
		
		<form class="callback-form" method="post" action="">
			<div class="form-group">
				<label for="callback-phone">Номер телефона</label>
				<input type="tel" id="callback-phone" name="phone" autocomplete="tel" required placeholder="+7 (___) ___-__-__">
			</div>
			<div class="form-group">
				<label class="checkbox-label">
					<input type="checkbox" name="consent" required>
					<span>Я согласен на <a href="/soglasie-na-obrabotku-personalnyh-dannyh/" target="_blank">обработку персональных данных</a> в соответствии с <a href="/politika-operatora-v-otnoshenii-obrabotki-personalnyh-dannyh/" target="_blank">Политикой конфиденциальности</a></span>
				</label>
			</div>
			<button type="submit" class="callback-submit-button">Обратный звонок</button>
		</form>
	</div>
</aside>

