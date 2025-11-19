(function() {
	const searchPopup = document.getElementById('search-popup');
	const searchToggle = document.querySelector('.mobile-search-toggle');
	const searchClose = document.querySelector('.search-popup-close');
	const searchOverlay = document.querySelector('.search-popup-overlay');

	if (!searchPopup || !searchToggle) return;

	function openSearchPopup() {
		searchPopup.classList.add('active');
		document.body.style.overflow = 'hidden';
		const searchField = searchPopup.querySelector('.search-popup-field');
		if (searchField) {
			setTimeout(() => searchField.focus(), 100);
		}
	}

	function closeSearchPopup() {
		searchPopup.classList.remove('active');
		document.body.style.overflow = '';
	}

	searchToggle.addEventListener('click', openSearchPopup);
	
	if (searchClose) {
		searchClose.addEventListener('click', closeSearchPopup);
	}
	
	if (searchOverlay) {
		searchOverlay.addEventListener('click', closeSearchPopup);
	}

	document.addEventListener('keydown', function(e) {
		if (e.key === 'Escape' && searchPopup.classList.contains('active')) {
			closeSearchPopup();
		}
	});
})();

