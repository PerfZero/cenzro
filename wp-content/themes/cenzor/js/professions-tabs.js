(function() {
	const tabButtons = document.querySelectorAll('.professions-tab-btn');
	const professionCards = document.querySelectorAll('.profession-tab-card');

	if (tabButtons.length === 0 || professionCards.length === 0) {
		return;
	}

	function filterProfessions(parentId) {
		professionCards.forEach(card => {
			const cardParent = card.getAttribute('data-parent');
			
			if (cardParent === parentId) {
				card.classList.remove('hidden');
			} else {
				card.classList.add('hidden');
			}
		});
	}

	const activeButton = document.querySelector('.professions-tab-btn.active');
	if (activeButton) {
		const activeParentId = activeButton.getAttribute('data-parent');
		filterProfessions(activeParentId);
	}

	tabButtons.forEach(button => {
		button.addEventListener('click', function() {
			const parentId = this.getAttribute('data-parent');

			tabButtons.forEach(btn => btn.classList.remove('active'));
			this.classList.add('active');

			filterProfessions(parentId);
		});
	});
})();

