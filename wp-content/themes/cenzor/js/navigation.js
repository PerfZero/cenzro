(function() {
	const navigation = document.getElementById('site-navigation');
	const menuToggle = navigation?.querySelector('.menu-toggle');
	const menu = navigation?.querySelector('#primary-menu');

	if (!navigation || !menuToggle || !menu) {
		return;
	}

	menuToggle.addEventListener('click', function() {
		navigation.classList.toggle('toggled');
		const isExpanded = navigation.classList.contains('toggled');
		menuToggle.setAttribute('aria-expanded', isExpanded);
	});

	const menuItems = menu.querySelectorAll('.menu-item-has-children');

	menuItems.forEach(function(menuItem) {
		const link = menuItem.querySelector('a');
		const subMenu = menuItem.querySelector('.sub-menu');

		if (!link || !subMenu) {
			return;
		}

		function handleSubMenuClick(e) {
			if (window.innerWidth <= 768) {
				e.preventDefault();
				subMenu.classList.toggle('active');
				link.classList.toggle('active');
			}
		}

		link.addEventListener('click', handleSubMenuClick);
	});

	document.addEventListener('click', function(e) {
		if (window.innerWidth <= 768) {
			if (navigation.classList.contains('toggled')) {
				const isClickInsideMenu = menu.contains(e.target);
				const isClickOnToggle = menuToggle.contains(e.target);
				if (!isClickInsideMenu && !isClickOnToggle) {
					navigation.classList.remove('toggled');
					menuToggle.setAttribute('aria-expanded', 'false');
				}
			}
		} else {
			const isClickInsideMenu = navigation.contains(e.target);
			if (!isClickInsideMenu) {
				const openSubMenus = menu.querySelectorAll('.sub-menu');
				openSubMenus.forEach(function(subMenu) {
					subMenu.style.opacity = '0';
					subMenu.style.visibility = 'hidden';
				});
			}
		}
	});

	window.addEventListener('resize', function() {
		if (window.innerWidth > 768) {
			navigation.classList.remove('toggled');
			menuToggle.setAttribute('aria-expanded', 'false');
			const activeSubMenus = menu.querySelectorAll('.sub-menu.active');
			activeSubMenus.forEach(function(subMenu) {
				subMenu.classList.remove('active');
			});
			const activeLinks = menu.querySelectorAll('a.active');
			activeLinks.forEach(function(link) {
				link.classList.remove('active');
			});
		}
	});
})();
