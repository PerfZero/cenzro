(function() {
	const heroSlider = document.querySelector('.hero-slider');
	if (heroSlider) {
		const slides = heroSlider.querySelectorAll('.hero-slide');
		
		if (slides.length) {
			let currentIndex = 0;
			let autoplayTimer = null;
			const autoplayDelay = 5000;
			const totalSlides = slides.length;
			
			function getActiveSlide() {
				return heroSlider.querySelector('.hero-slide.active');
			}
			
			function updateProgress() {
				const activeSlide = getActiveSlide();
				if (!activeSlide) {
					return;
				}
				
				const progressFill = activeSlide.querySelector('.progress-fill');
				if (progressFill) {
					const progress = ((currentIndex + 1) / totalSlides) * 100;
					progressFill.style.width = progress + '%';
				}
			}
			
			function showSlide(index) {
				if (index < 0 || index >= totalSlides) {
					return;
				}
				
				slides.forEach((slide, i) => {
					slide.classList.remove('active');
				});
				
				slides[index].classList.add('active');
				currentIndex = index;
				updateProgress();
			}
			
			function nextSlide() {
				const nextIndex = (currentIndex + 1) % totalSlides;
				showSlide(nextIndex);
			}
			
			function prevSlide() {
				const prevIndex = (currentIndex - 1 + totalSlides) % totalSlides;
				showSlide(prevIndex);
			}
			
			function startAutoplay() {
				stopAutoplay();
				autoplayTimer = setInterval(nextSlide, autoplayDelay);
			}
			
			function stopAutoplay() {
				if (autoplayTimer) {
					clearInterval(autoplayTimer);
					autoplayTimer = null;
				}
			}
			
			function handleNext() {
				nextSlide();
				startAutoplay();
			}
			
			function handlePrev() {
				prevSlide();
				startAutoplay();
			}
			
			slides.forEach((slide, index) => {
				const nextBtn = slide.querySelector('.hero-next');
				const prevBtn = slide.querySelector('.hero-prev');
				
				if (nextBtn) {
					nextBtn.addEventListener('click', handleNext);
				}
				
				if (prevBtn) {
					prevBtn.addEventListener('click', handlePrev);
				}
			});
			
			heroSlider.addEventListener('mouseenter', stopAutoplay);
			heroSlider.addEventListener('mouseleave', startAutoplay);
			
			showSlide(0);
			startAutoplay();
		}
	}

	if (document.querySelector('.professions-swiper')) {
		const swiper = new Swiper('.professions-swiper', {
			slidesPerView: 1,
			slidesPerGroup: 1,
			spaceBetween: 20,
            
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
			},
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
			breakpoints: {
				640: {
					slidesPerView: 2,
					slidesPerGroup: 2,
					spaceBetween: 20,
				},
				768: {
					slidesPerView: 2,
					slidesPerGroup: 2,
					spaceBetween: 24,
				},
				1024: {
					slidesPerView: 3,
					slidesPerGroup: 3,
					spaceBetween: 30,
				},
				1280: {
					slidesPerView: 4,
					slidesPerGroup: 4,
					spaceBetween: 30,
				},
			},
		});
	}

	if (document.querySelector('.certificates-swiper')) {
		const certificatesSwiper = new Swiper('.certificates-swiper', {
			slidesPerView: 1,
			spaceBetween: 20,
			pagination: {
				el: '.certificates-swiper .swiper-pagination',
				clickable: true,
			},
			navigation: {
				nextEl: '.certificates-swiper .swiper-button-next',
				prevEl: '.certificates-swiper .swiper-button-prev',
			},
			breakpoints: {
				640: {
					slidesPerView: 2,
					spaceBetween: 20,
				},
				768: {
					slidesPerView: 3,
					spaceBetween: 30,
				},
				1024: {
					slidesPerView: 4,
					spaceBetween: 30,
				},
				1280: {
					slidesPerView: 5,
					spaceBetween: 30,
				},
			},
		});
	}

	if (typeof GLightbox !== 'undefined') {
		const lightbox = GLightbox({
			selector: '.glightbox',
			touchNavigation: true,
			loop: true,
			autoplayVideos: true
		});
	}

	if (document.querySelector('.teachers-swiper')) {
		const teachersSwiper = new Swiper('.teachers-swiper', {
			slidesPerView: 1,
			spaceBetween: 20,
			pagination: {
				el: '.teachers-swiper .swiper-pagination',
				clickable: true,
			},
			navigation: {
				nextEl: '.teachers-swiper .swiper-button-next',
				prevEl: '.teachers-swiper .swiper-button-prev',
			},
			breakpoints: {
				640: {
					slidesPerView: 2,
					spaceBetween: 20,
				},
				768: {
					slidesPerView: 3,
					spaceBetween: 30,
				},
				1024: {
					slidesPerView: 5,
					spaceBetween: 30,
				},
			},
		});
	}
})();

