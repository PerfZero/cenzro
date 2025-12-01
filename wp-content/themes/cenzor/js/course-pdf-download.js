(function() {
	const form = document.getElementById('course-pdf-form');
	if (!form) return;

	const coursesData = {};
	const courseSelect = document.getElementById('course-pdf-select');

	if (courseSelect) {
		Array.from(courseSelect.options).forEach(option => {
			if (option.value) {
				coursesData[option.value] = {
					name: option.text,
					index: option.value
				};
			}
		});
	}

	form.addEventListener('submit', async function(e) {
		e.preventDefault();

		const name = document.getElementById('course-pdf-name').value.trim();
		const phone = document.getElementById('course-pdf-phone').value.trim();
		const courseIndex = courseSelect.value;

		if (!name || !phone || !courseIndex) {
			alert('Пожалуйста, заполните все обязательные поля');
			return;
		}

		const submitButton = form.querySelector('.modal-submit');
		const originalText = submitButton.textContent;
		submitButton.disabled = true;
		submitButton.textContent = 'Обработка...';

		try {
			const formData = new FormData();
			formData.append('action', 'download_course_pdf');
			formData.append('name', name);
			formData.append('phone', phone);
			formData.append('course_index', courseIndex);

			const ajaxUrl = (typeof cenzorAjax !== 'undefined' && cenzorAjax.ajaxurl) ? cenzorAjax.ajaxurl : '/wp-admin/admin-ajax.php';
			const response = await fetch(ajaxUrl, {
				method: 'POST',
				body: formData
			});

			const result = await response.json();

			if (result.success) {
				if (result.data && result.data.pdf_url) {
					const link = document.createElement('a');
					link.href = result.data.pdf_url;
					link.download = result.data.filename || 'course.pdf';
					document.body.appendChild(link);
					link.click();
					document.body.removeChild(link);
				}

				alert('Заявка успешно отправлена! Файл скачан.');
				form.reset();
				const coursePdfModal = document.getElementById('course-pdf-modal');
				if (coursePdfModal) {
					coursePdfModal.classList.remove('active');
					document.body.style.overflow = '';
				}
			} else {
				alert(result.data && result.data.message ? result.data.message : 'Ошибка при отправке заявки. Попробуйте позже.');
			}
		} catch (error) {
			console.error('Ошибка:', error);
			alert('Произошла ошибка. Попробуйте позже.');
		} finally {
			submitButton.disabled = false;
			submitButton.textContent = originalText;
		}
	});
})();


