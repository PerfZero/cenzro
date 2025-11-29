(function() {
	const modal = document.getElementById('modal');
	const pdfModal = document.getElementById('pdf-download-modal');
	const coursePdfModal = document.getElementById('course-pdf-modal');

	const openModal = (e) => {
		e.preventDefault();
		document.body.style.overflow = 'hidden';
		if (modal) {
			modal.classList.add('active');
		}
	};

	const openPdfModal = (e) => {
		e.preventDefault();
		document.body.style.overflow = 'hidden';
		if (pdfModal) {
			pdfModal.classList.add('active');
		}
	};

	const openCoursePdfModal = (e) => {
		e.preventDefault();
		document.body.style.overflow = 'hidden';
		if (coursePdfModal) {
			coursePdfModal.classList.add('active');
		}
	};

	const closeModal = () => {
		document.body.style.overflow = '';
		if (modal) {
			modal.classList.remove('active');
		}
		if (pdfModal) {
			pdfModal.classList.remove('active');
		}
		if (coursePdfModal) {
			coursePdfModal.classList.remove('active');
		}
	};

	if (modal) {
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
	}

	if (pdfModal) {
		const pdfButtons = document.querySelectorAll('a[href="#pdf-download"], .mobil-trips-pdf');
		pdfButtons.forEach(button => {
			button.addEventListener('click', openPdfModal);
		});

		const pdfCloseButton = pdfModal.querySelector('.modal-close');
		if (pdfCloseButton) {
			pdfCloseButton.addEventListener('click', closeModal);
		}

		pdfModal.addEventListener('click', (e) => {
			if (e.target === pdfModal) {
				closeModal();
			}
		});
	}

	if (coursePdfModal) {
		const coursePdfButtons = document.querySelectorAll('a[href="#course-pdf-modal"], .mobil-trips-learn-more');
		coursePdfButtons.forEach(button => {
			button.addEventListener('click', openCoursePdfModal);
		});

		const coursePdfCloseButton = coursePdfModal.querySelector('.modal-close');
		if (coursePdfCloseButton) {
			coursePdfCloseButton.addEventListener('click', closeModal);
		}

		coursePdfModal.addEventListener('click', (e) => {
			if (e.target === coursePdfModal) {
				closeModal();
			}
		});
	}

	document.addEventListener('keydown', (e) => {
		if (e.key === 'Escape') {
			if (modal && modal.classList.contains('active')) {
				closeModal();
			}
			if (pdfModal && pdfModal.classList.contains('active')) {
				closeModal();
			}
			if (coursePdfModal && coursePdfModal.classList.contains('active')) {
				closeModal();
			}
		}
	});
})();

