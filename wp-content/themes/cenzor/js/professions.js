(function() {
	if (document.querySelector('.professions-swiper')) {
		const swiper = new Swiper('.professions-swiper', {
			slidesPerView: 1,
			spaceBetween: 20,
			loop: true,
			autoplay: {
				delay: 3000,
				disableOnInteraction: false,
			},
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
					slidesPerView: 7,
					spaceBetween: 30,
				},
			},
		});
	}
})();

