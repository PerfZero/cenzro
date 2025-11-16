(function() {
	const tabButtons = document.querySelectorAll('.profession-tab-btn');

	if (tabButtons.length === 0) {
		return;
	}

	function updateActiveTab() {
		const sections = document.querySelectorAll('.profession-content-section');
		const scrollPosition = window.scrollY + 150;

		sections.forEach((section) => {
			const sectionId = section.getAttribute('id');
			const sectionTop = section.offsetTop;
			const sectionBottom = sectionTop + section.offsetHeight;

			if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
				tabButtons.forEach(btn => {
					btn.classList.remove('active');
					if (btn.getAttribute('href') === '#' + sectionId) {
						btn.classList.add('active');
					}
				});
			}
		});
	}

	tabButtons.forEach(button => {
		button.addEventListener('click', function(e) {
			e.preventDefault();
			const targetId = this.getAttribute('href');
			const targetSection = document.querySelector(targetId);

			if (targetSection) {
				const offsetTop = targetSection.offsetTop - 100;
				window.scrollTo({
					top: offsetTop,
					behavior: 'smooth'
				});

				tabButtons.forEach(btn => btn.classList.remove('active'));
				this.classList.add('active');
			}
		});
	});

	window.addEventListener('scroll', updateActiveTab);
	updateActiveTab();
})();

