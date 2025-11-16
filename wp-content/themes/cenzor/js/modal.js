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

	const openButtons = document.querySelectorAll('a[href="#modal"], .benefits-btn, .hero-button, .modal-open');
	openButtons.forEach(button => {
		if (button.getAttribute('href') === '#modal' || button.classList.contains('modal-open') || button.classList.contains('hero-button')) {
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

