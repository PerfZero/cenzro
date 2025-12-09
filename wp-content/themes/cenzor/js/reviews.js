(function() {
	const reviewForm = document.getElementById('review-form');
	const reviewAddBtn = document.getElementById('review-add-btn');
	const reviewModal = document.getElementById('review-form-modal');
	const filterButtons = document.querySelectorAll('.review-filter-btn');

	if (reviewAddBtn && reviewModal) {
		reviewAddBtn.addEventListener('click', function(e) {
			e.preventDefault();
			document.body.style.overflow = 'hidden';
			reviewModal.classList.add('active');
		});

		const closeBtn = reviewModal.querySelector('.modal-close');
		if (closeBtn) {
			closeBtn.addEventListener('click', function() {
				reviewModal.classList.remove('active');
				document.body.style.overflow = '';
			});
		}

		reviewModal.addEventListener('click', function(e) {
			if (e.target === reviewModal) {
				reviewModal.classList.remove('active');
				document.body.style.overflow = '';
			}
		});

		document.addEventListener('keydown', function(e) {
			if (e.key === 'Escape' && reviewModal.classList.contains('active')) {
				reviewModal.classList.remove('active');
				document.body.style.overflow = '';
			}
		});
	}

	if (reviewForm) {
		reviewForm.addEventListener('submit', async function(e) {
			e.preventDefault();

			const name = document.getElementById('review-name').value.trim();
			const rating = document.querySelector('input[name="rating"]:checked')?.value;
			const text = document.getElementById('review-text').value.trim();
			const course = document.getElementById('review-course').value;
			const photo = document.getElementById('review-photo').files[0];

			if (!name || !rating || !text) {
				alert('Пожалуйста, заполните все обязательные поля');
				return;
			}

			const submitButton = reviewForm.querySelector('.modal-submit');
			const originalText = submitButton.textContent;
			submitButton.disabled = true;
			submitButton.textContent = 'Отправка...';

			try {
				const formData = new FormData();
				formData.append('action', 'submit_review');
				formData.append('name', name);
				formData.append('rating', rating);
				formData.append('text', text);
				formData.append('course', course);
				if (photo) {
					formData.append('photo', photo);
				}

				const ajaxUrl = (typeof cenzorAjax !== 'undefined' && cenzorAjax.ajaxurl) ? cenzorAjax.ajaxurl : '/wp-admin/admin-ajax.php';
				const response = await fetch(ajaxUrl, {
					method: 'POST',
					body: formData
				});

				const result = await response.json();

				if (result.success) {
					alert(result.data.message || 'Спасибо за отзыв!');
					reviewForm.reset();
					reviewModal.classList.remove('active');
					document.body.style.overflow = '';
					setTimeout(() => {
						location.reload();
					}, 1000);
				} else {
					alert(result.data && result.data.message ? result.data.message : 'Ошибка при отправке отзыва');
				}
			} catch (error) {
				console.error('Ошибка:', error);
				alert('Произошла ошибка. Попробуйте позже.');
			} finally {
				submitButton.disabled = false;
				submitButton.textContent = originalText;
			}
		});
	}


	const ratingInputs = document.querySelectorAll('.rating-input input[type="radio"]');
	ratingInputs.forEach(input => {
		input.addEventListener('change', function() {
			const value = parseInt(this.value);
			const labels = document.querySelectorAll('.star-label');
			labels.forEach((label, index) => {
				if (5 - index <= value) {
					label.classList.add('selected');
				} else {
					label.classList.remove('selected');
				}
			});
		});
	});
})();










