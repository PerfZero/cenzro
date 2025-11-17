(function() {
	if (document.querySelector('.professions-swiper')) {
		const swiper = new Swiper('.professions-swiper', {
			slidesPerView: 1,
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
				1280: {
					slidesPerView: 6,
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
					slidesPerView: 4,
					spaceBetween: 30,
				},
			},
		});
	}
})();

