<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cenzor
 */

get_header();
?>

<section class="hero-section">
	<div class="container">
	<?php
	$hero_image = get_field( 'hero_background_image' );
	$hero_image_url = '';
	if ( $hero_image ) {
		if ( is_array( $hero_image ) && isset( $hero_image['url'] ) ) {
			$hero_image_url = $hero_image['url'];
		} elseif ( is_numeric( $hero_image ) ) {
			$hero_image_url = wp_get_attachment_image_url( $hero_image, 'full' );
		} elseif ( is_string( $hero_image ) ) {
			$hero_image_url = $hero_image;
		}
	}
	?>
	<div class="hero-background"<?php echo $hero_image_url ? ' style="background-image: url(' . esc_url( $hero_image_url ) . ');"' : ''; ?>></div>
		<div class="hero-content">
			<h1 class="hero-title"><span>ЦЕНЗОР</span> - Дистанционное обучение по всей России</h1>
			<p class="hero-description">Дополнительное обучение<br>Повышение квалификации<br>Профессиональная переподготовка<br>После обучения бесплатно доставим документы в любую точку России<br>стань профессионалом в новой профессии</p>
			<a href="#modal" class="hero-button modal-open">Консультация</a>
		</div>
	

	<div class="hero_bottom">		
	<div class="hero-navigation">
		<button class="nav-arrow nav-prev">
			<i class="fas fa-chevron-left"></i>
		</button>
		<button class="nav-arrow nav-next">
			<i class="fas fa-chevron-right"></i>
		</button>
		<div class="progress-bar">
			<div class="progress-fill"></div>
		</div>
	</div>
	
	<div class="hero-stats">
			<div class="stats-grid">
				<div class="stat-item">
					<div class="stat-number">31127</div>
					<div class="stat-label">Выпускников</div>
				</div>
				<div class="stat-item">
					<div class="stat-number">11 Лет</div>
					<div class="stat-label">На рынке</div>
				</div>
				<div class="stat-item">
					<div class="stat-number">67 Человек</div>
					<div class="stat-label">Обучаются сегодня</div>
				</div>
		</div>
	</div>
	</div>
	</div>
</section>

<section class="professions-section">
	<div class="container">
		<h2 class="professions-title">Какую профессию хотите выбрать?</h2>
		<div class="swiper professions-swiper">
			<div class="swiper-wrapper">
				<?php
				$professions = new WP_Query( array(
					'post_type'      => 'profession',
					'posts_per_page' => -1,
					'post_status'    => 'publish',
					'post_parent'    => 0,
				) );

				if ( $professions->have_posts() ) :
					while ( $professions->have_posts() ) : $professions->the_post();
						$profession_image = get_field( 'profession_image' );
						$image_url = '';
						
						if ( $profession_image ) {
							if ( is_array( $profession_image ) && isset( $profession_image['url'] ) ) {
								$image_url = $profession_image['url'];
							} elseif ( is_numeric( $profession_image ) ) {
								$image_url = wp_get_attachment_image_url( $profession_image, 'full' );
							} elseif ( is_string( $profession_image ) ) {
								$image_url = $profession_image;
							}
						}
						
						if ( ! $image_url && has_post_thumbnail() ) {
							$image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
						}
						?>
						<div class="swiper-slide">
							<div class="profession-card">
								<?php if ( $image_url ) : ?>
									<div class="profession-image">
										<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
									</div>
								<?php endif; ?>
								<div class="profession-name"><?php echo esc_html( get_the_title() ); ?></div>
							</div>
						</div>
						<?php
					endwhile;
					wp_reset_postdata();
				endif;
				?>
			</div>
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
			<div class="swiper-pagination"></div>
		</div>
	</div>
</section>

<section class="advantages-section">
	<div class="container">
		<h2 class="advantages-title">Почему более 31 000 выпускников выбрали «<span class="advantages-title-accent">ЦЕНЗОР</span>»?</h2>
		<div class="advantages-grid">
			<div class="advantage-item">
				<div class="advantage-icon">
					<img src="<?php echo get_template_directory_uri(); ?>/images/guarantee-quality.svg" alt="Гарантия качества">
				</div>
				<h3 class="advantage-title">Гарантия качества</h3>
				<p class="advantage-description">Мы — учебный центр, работающий по всей России с высочайшим уровнем обучения, сервиса и организации учебного процесса.</p>
			</div>
			<div class="advantage-item">
				<div class="advantage-icon">
					<img src="<?php echo get_template_directory_uri(); ?>/images/guarantee-deadlines.svg" alt="Гарантия соблюдения сроков">
				</div>
				<h3 class="advantage-title">Гарантия соблюдения сроков</h3>
				<p class="advantage-description">Сроки указаны в договоре. За каждый день просрочки возвращаем 0,1% от стоимости услуги.</p>
			</div>
			<div class="advantage-item advantage-empty"></div>
			<div class="advantage-item">
				<div class="advantage-icon">
					<img src="<?php echo get_template_directory_uri(); ?>/images/guarantee-price.svg" alt="Гарантия точной стоимости">
				</div>
				<h3 class="advantage-title">Гарантия точной стоимости</h3>
				<p class="advantage-description">Мы сразу называем конечную цену. Дополнительных расходов у Вас не будет на протяжении всего обучения!</p>
			</div>
			<div class="advantage-item">
				<div class="advantage-icon">
					<img src="<?php echo get_template_directory_uri(); ?>/images/guarantee-reliability.svg" alt="Гарантия надежности">
				</div>
				<h3 class="advantage-title">Гарантия надежности</h3>
				<p class="advantage-description">Своевременное внесение документов в ФИС ФРДО и Минтруд.</p>
			</div>
			<div class="advantage-item advantage-empty"></div>
			<div class="advantage-item">
				<div class="advantage-icon">
					<img src="<?php echo get_template_directory_uri(); ?>/images/result-oriented.svg" alt="Нацеленность на результат">
				</div>
				<h3 class="advantage-title">Нацеленность на результат</h3>
				<p class="advantage-description"></p>
			</div>
			<div class="advantage-item">
				<div class="advantage-icon">
					<img src="<?php echo get_template_directory_uri(); ?>/images/new-technologies.svg" alt="Новейшие технологии">
				</div>
				<h3 class="advantage-title">Новейшие технологии</h3>
				<p class="advantage-description"></p>
			</div>
			<div class="advantage-item advantage-empty"></div>
			<div class="advantage-item">
				<div class="advantage-icon">
					<img src="<?php echo get_template_directory_uri(); ?>/images/official-license.svg" alt="Официальная лицензия">
				</div>
				<h3 class="advantage-title">Официальная лицензия</h3>
				<p class="advantage-description"></p>
			</div>
			<div class="advantage-item">
				<div class="advantage-icon">
					<img src="<?php echo get_template_directory_uri(); ?>/images/personal-curator.svg" alt="Персональный куратор">
				</div>
				<h3 class="advantage-title">Персональный куратор</h3>
				<p class="advantage-description"></p>
			</div>
			<div class="advantage-item advantage-empty"></div>
		</div>
	</div>
</section>

<section class="professions-tabs-section">
	<div class="container">
		<div class="professions-tabs-wrapper">
			<div class="professions-tabs-nav">
				<?php
				$parent_professions = new WP_Query( array(
					'post_type'      => 'profession',
					'posts_per_page' => -1,
					'post_status'    => 'publish',
					'post_parent'    => 0,
				) );

				if ( $parent_professions->have_posts() ) :
					$first = true;
					while ( $parent_professions->have_posts() ) : $parent_professions->the_post();
						?>
						<button class="professions-tab-btn <?php echo $first ? 'active' : ''; ?>" data-parent="<?php echo get_the_ID(); ?>">
							<?php echo esc_html( get_the_title() ); ?>
							<span class="professions-tab-courses">28 курсов</span>
						</button>
						<?php
						$first = false;
					endwhile;
					wp_reset_postdata();
				endif;
				?>
			</div>
			<div class="professions-tabs-content">
				<div class="professions-grid-tabs">
					<?php
					$professions = new WP_Query( array(
						'post_type'      => 'profession',
						'posts_per_page' => -1,
						'post_status'    => 'publish',
						'post_parent'    => 0,
					) );

					if ( $professions->have_posts() ) :
						while ( $professions->have_posts() ) : $professions->the_post();
							$parent_id = get_the_ID();
							$child_professions = new WP_Query( array(
								'post_type'      => 'profession',
								'posts_per_page' => -1,
								'post_status'    => 'publish',
								'post_parent'    => $parent_id,
							) );

							if ( $child_professions->have_posts() ) :
								while ( $child_professions->have_posts() ) : $child_professions->the_post();
									$profession_image = get_field( 'profession_image' );
									$image_url = '';
									
									if ( $profession_image ) {
										if ( is_array( $profession_image ) && isset( $profession_image['url'] ) ) {
											$image_url = $profession_image['url'];
										} elseif ( is_numeric( $profession_image ) ) {
											$image_url = wp_get_attachment_image_url( $profession_image, 'full' );
										} elseif ( is_string( $profession_image ) ) {
											$image_url = $profession_image;
										}
									}
									
									if ( ! $image_url && has_post_thumbnail() ) {
										$image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
									}
									?>
									<div class="profession-tab-card" data-parent="<?php echo esc_attr( $parent_id ); ?>">
										<?php if ( $image_url ) : ?>
											<div class="profession-tab-image">
												<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
											</div>
										<?php endif; ?>
										<div class="profession-tab-name"><?php echo esc_html( get_the_title() ); ?></div>
										
									</div>
									<?php
								endwhile;
								wp_reset_postdata();
							endif;
						endwhile;
						wp_reset_postdata();
					endif;
					?>
					<div class="profession-tab-card profession-tab-card-promo" data-parent="all">
						<div class="profession-tab-promo-content">
							<div class="profession-tab-promo-text">Так же попробуй другой курс по цене ниже этой 50%</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_template_part( 'template-parts/certificates-section' ); ?>

<?php get_template_part( 'template-parts/partners-section' ); ?>

<section class="teachers-section">
	<div class="container">
		<h2 class="teachers-title">В Цензор61 преподают топ-преподаватели</h2>
		<div class="swiper teachers-swiper">
			<div class="swiper-wrapper">
				<?php
				$teachers = new WP_Query( array(
					'post_type'      => 'teacher',
					'posts_per_page' => -1,
					'post_status'    => 'publish',
					'orderby'        => 'menu_order',
					'order'          => 'ASC',
				) );

				if ( $teachers->have_posts() ) :
					while ( $teachers->have_posts() ) : $teachers->the_post();
						$teacher_image = '';
						if ( has_post_thumbnail() ) {
							$teacher_image = get_the_post_thumbnail_url( get_the_ID(), 'full' );
						}
						?>
						<div class="swiper-slide">
							<div class="teacher-card">
								<?php if ( $teacher_image ) : ?>
									<div class="teacher-image">
										<img src="<?php echo esc_url( $teacher_image ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
									</div>
								<?php endif; ?>
								<div class="teacher-info">
									<h3 class="teacher-name"><?php echo esc_html( get_the_title() ); ?></h3>
									<?php if ( get_the_content() ) : ?>
										<div class="teacher-description"><?php the_content(); ?></div>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<?php
					endwhile;
					wp_reset_postdata();
				endif;
				?>
			</div>
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
			<div class="swiper-pagination"></div>
		</div>
	</div>
</section>

<section class="benefits-section">
	<div class="container">
		<div class="benefits-wrapper">
			<div class="benefits-content">
				<div class="benefits-title-block">
					<h2 class="benefits-title">Почему Вам будет выгодно проходить обучение именно у нас?!</h2>
					<p class="benefits-subtitle">ООО "ЦЕНЗОР"</p>
				</div>
				<p class="benefits-text">
					Цены на наши услуги дешевле конкурентов от 10 до 15%. Пришлите нам коммерческие предложения других учебных центров и мы сделаем для Вас скидку - обучение будет дешевле чем в других центрах! Проверьте это сами! У нас действуют большие скидки для обучения групп! В программу обучения включены только те знания и навыки, которые реально пригодятся на практике!
				</p>
				<a href="#modal" class="benefits-btn modal-open">Заказать консультацию</a>
			</div>
			<div class="benefits-grid">
				<div class="benefit-item">
					<div class="benefit-icon">
						<i class="fas fa-file-alt"></i>
					</div>
					<div class="benefit-caption">
						<div class="benefit-title">Получение официального документа</div>
					</div>
				</div>
				<div class="benefit-item">
					<div class="benefit-icon">
						<i class="fas fa-video"></i>
					</div>
					<div class="benefit-caption">
						<div class="benefit-title">очно и дистанционно</div>
					</div>
				</div>
				<div class="benefit-item">
					<div class="benefit-icon">
						<i class="fas fa-cogs"></i>
					</div>
					<div class="benefit-caption">
						<div class="benefit-title">поддержка на всех этапах</div>
					</div>
				</div>
				<div class="benefit-item">
					<div class="benefit-icon">
						<i class="fas fa-sync-alt"></i>
					</div>
					<div class="benefit-caption">
						<div class="benefit-title">Сопровождаем до аттестации</div>
					</div>
				</div>
				<div class="benefit-item">
					<div class="benefit-icon">
						<i class="fas fa-user-tie"></i>
					</div>
					<div class="benefit-caption">
						<div class="benefit-title">Персональный куратор</div>
					</div>
				</div>
				<div class="benefit-item">
					<div class="benefit-icon">
						<i class="fas fa-coins"></i>
					</div>
					<div class="benefit-caption">
						<div class="benefit-title">Демократичные цены</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="courses-info-section">
	<div class="container">
		<article class="courses-article">
			<header>
				<h1 class="courses-main-title">Что важно знать о курсах повышения квалификации дистанционно</h1>
			</header>
			<p class="courses-text">
				Самое главное – авторитетность компании, предлагающей обучение в удаленном формате. Не нарваться на мошенников просто – проверяйте наличие соответствующей лицензии. <strong>Учебный центр «Цензор»</strong> официально аккредитован проводить курсы повышения квалификации дистанционно по широкому спектру профессий. А значит обладает всеми необходимыми учебными материалами и квалифицированными педагогами. Ведет контроль прохождения практики, проверку тестовых заданий, по результату выдает официальное удостоверение государственного образца.
			</p>
			<h2 class="courses-subtitle">Выгоды онлайн режима обучения.</h2>
			<p class="courses-text">
				Прохождение курсов онлайн эффективно и экономит время. По электронной почте вы передаете необходимые документы – удостоверения личности, документы об образовании. Электронно и по почте получаете удостоверение о повышении квалификации. Все происходит дистанционно. В личном кабинете онлайн получаете доступ к образовательным программам, сдаете тесты и экзаменационную работу. Весь процесс проходит под контролем прикрепленного к Вам педагога. Он проверяет задания и тесты, отвечает на возникшие вопросы, консультирует по назначенным образовательным программам. Мы следим за всеми нововведениями. Так же с 1 сентября 2025 г. изменяются требования к <a href="/pojarnaya-bezopasnost-2025">программам противопожарного инструктажа</a>.
			</p>
			<h3 class="courses-h3">Преимущества прохождения курсов онлайн</h3>
			<ul class="courses-list">
				<li>программа соответствует лицензионным требованиям.</li>
				<li>Без отрыва от работы или повседневных занятий.</li>
				<li>Не нужно тратить время и силы на поездки.</li>
				<li>Все делает онлайн в личном кабинете на сайте и электронно.</li>
				<li>Онлайн лекции предоставляют все знания и помощь преподавателей в интерактивном взаимодействии через веб-камеру.</li>
				<li>Формы тестирования с проверкой нейросетей.</li>
				<li>Возможность задавать возникающие вопросы и проходить образовательные программы и тесты неограниченное количество раз. Доступ в личный кабинет сохраняется.</li>
				<li>Бесплатная отправка по почте дипломов и документов о повышении квалификации.</li>
				<li>Прохождение курсов дистанционное ничем не уступает офлайн обучению.</li>
				<li>Возможность учиться в удобное время в составе группы или индивидуально.</li>
			</ul>
			<h2 class="courses-subtitle">Качество полученного образования.</h2>
			<p class="courses-text">
				Лицензия учебного центра «Цензора» гарантирует Вам, что все полученные знания будут достаточными для успешной работы на новом или необходимом уровне квалификации. Выдаваемое удостоверение государственного образца подтверждает его, позволяет пройти все проверки и аттестации. Профессиональный рост в ряде профессий состоит из нескольких этапов, позволяя сначала получить удостоверение ответственного специалиста, а в будущем вырасти до руководителя подразделения, вплоть до главы предприятия. Качество полученного образования в учебном центре «Цензор» гарантирует старт карьеры. Дистанционные курсы выдаются в несколько этапов в зависимости от выбранной профессии. Каждый образовательная программа завершается тестами и экзаменационной работой. Формула прохождения обучения онлайн позволяет одновременно нарабатывать практический опыт на месте работы.
			</p>
			<h2 class="courses-subtitle">Дипломы и удостоверения.</h2>
			<div class="courses-images-grid">
				<figure class="courses-figure">
					<img src="http://localhost:8080/wp-content/uploads/2025/11/ud0.jpg" alt="Удостоверение о повышении квалификации">
					<figcaption>Удостоверение о повышении квалификации государственного образца</figcaption>
				</figure>
				<figure class="courses-figure">
					<img src="http://localhost:8080/wp-content/uploads/2025/11/ud1.jpg" alt="Свидетельство о профессиональном обучении">
					<figcaption>Свидетельство о профессиональном обучении учебного центра "ЦЕНЗОР"</figcaption>
				</figure>
				<figure class="courses-figure">
					<img src="http://localhost:8080/wp-content/uploads/2025/11/ud3.jpg" alt="Диплом о профессиональной переподготовке">
					<figcaption>Диплом о профессиональной переподготовке</figcaption>
				</figure>
				<figure class="courses-figure">
					<img src="http://localhost:8080/wp-content/uploads/2025/11/ud2.jpg" alt="Образец свидетельства о получении профессии">
					<figcaption>Образец свидетельства о получении профессии</figcaption>
				</figure>
			</div>
			<p class="courses-text">
				Государственная лицензия образовательного учреждения Российской Федерации позволяет выдавать учебному центру «Цензор» дипломы и удостоверения соответствующие требованиям любых контролирующих органов. Это позволит руководителям предприятий пройти все проверки, не получать штрафы, взыскания и ограничения от служб пожарной и экологической безопасности, иметь соответствующие уровни допуска к работе, подписывать нормативные документы. Срок действия дипломов и удостоверений учебного центра регламентируется законодательством Российской Федерации. Для удобства выдается электронная версия документов, доступная в личном кабинете на сайте.
			</p>
		</article>
	</div>
</section>

<?php get_template_part( 'template-parts/reviews-section' ); ?>

<div id="modal" class="modal-overlay">
	<div class="modal-content">
		<button class="modal-close" aria-label="Закрыть">&times;</button>
		<h2 class="modal-title">Заказать консультацию</h2>
		<form class="modal-form" method="post" action="">
			<div class="form-group">
				<label for="modal-name">Ваше имя *</label>
				<input type="text" id="modal-name" name="name" required>
			</div>
			<div class="form-group">
				<label for="modal-phone">Телефон *</label>
				<input type="tel" id="modal-phone" name="phone" required>
			</div>
			<div class="form-group">
				<label for="modal-email">Email</label>
				<input type="email" id="modal-email" name="email">
			</div>
			<div class="form-group">
				<label for="modal-message">Сообщение</label>
				<textarea id="modal-message" name="message" rows="4"></textarea>
			</div>
			<div class="form-group">
				<label class="checkbox-label">
					<input type="checkbox" name="consent" required>
					<span>Я согласен на обработку персональных данных</span>
				</label>
			</div>
			<button type="submit" class="modal-submit">Отправить</button>
		</form>
	</div>
</div>

<?php
get_footer();
