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

		if (window.innerWidth <= 1024) {
			link.addEventListener('click', function(e) {
				if (subMenu) {
					e.preventDefault();
					subMenu.classList.toggle('active');
					
					const icon = link.querySelector('::after');
					if (subMenu.classList.contains('active')) {
						link.style.transform = 'rotate(180deg)';
					} else {
						link.style.transform = 'rotate(0deg)';
					}
				}
			});
		}
	});

	document.addEventListener('click', function(e) {
		if (window.innerWidth > 1024) {
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
		if (window.innerWidth > 1024) {
			const activeSubMenus = menu.querySelectorAll('.sub-menu.active');
			activeSubMenus.forEach(function(subMenu) {
				subMenu.classList.remove('active');
			});
		}
	});
})();
