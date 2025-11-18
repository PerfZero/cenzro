(function() {
	const modal = document.getElementById('modal');
	if (!modal) return;

	const openModal = (e) => {
		e.preventDefault();
		document.body.style.overflow = 'hidden';
		modal.classList.add('active');
	};

	const closeModal = () => {
		document.body.style.overflow = '';
		modal.classList.remove('active');
	};

	const openButtons = document.querySelectorAll('a[href="#modal"], a[href="#consultation"], .benefits-btn, .hero-button, .modal-open, .profession-consultation-button, .profession-pricing-button, .profession-step-button, .mobil-trips-application');
	openButtons.forEach(button => {
		const href = button.getAttribute('href');
		if (href === '#modal' || href === '#consultation' || button.classList.contains('modal-open') || button.classList.contains('hero-button') || button.classList.contains('profession-consultation-button') || button.classList.contains('profession-pricing-button') || button.classList.contains('profession-step-button') || button.classList.contains('mobil-trips-application')) {
			button.addEventListener('click', openModal);
		}
	});

	const closeButton = modal.querySelector('.modal-close');
	if (closeButton) {
		closeButton.addEventListener('click', closeModal);
	}

	modal.addEventListener('click', (e) => {
		if (e.target === modal) {
			closeModal();
		}
	});

	document.addEventListener('keydown', (e) => {
		if (e.key === 'Escape' && modal.classList.contains('active')) {
			closeModal();
		}
	});
})();

