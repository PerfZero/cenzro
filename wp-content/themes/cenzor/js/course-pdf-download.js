(function() {
	const form = document.getElementById('course-pdf-form');
	if (!form) return;

	const coursesData = {};
	const courseSelect = document.getElementById('course-pdf-select');
	const entityTypeRadios = form.querySelectorAll('input[name="entity_type"]');
	const legalFields = document.getElementById('legal-fields');
	const legalFieldsInn = document.getElementById('legal-fields-inn');
	const companyNameInput = document.getElementById('course-pdf-company-name');
	const innInput = document.getElementById('course-pdf-inn');

	const floatInputs = form.querySelectorAll('.float-label-group input');
	
	function updateFloatLabel(input) {
		if (input.value.trim() !== '') {
			input.classList.add('has-value');
		} else {
			input.classList.remove('has-value');
		}
	}

	floatInputs.forEach(input => {
		updateFloatLabel(input);
		
		input.addEventListener('input', function() {
			updateFloatLabel(this);
		});
		
		input.addEventListener('blur', function() {
			updateFloatLabel(this);
		});
	});

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

	entityTypeRadios.forEach(radio => {
		radio.addEventListener('change', function() {
			if (this.value === 'legal') {
				legalFields.style.display = 'block';
				legalFieldsInn.style.display = 'block';
				companyNameInput.setAttribute('required', 'required');
				innInput.setAttribute('required', 'required');
			} else {
				legalFields.style.display = 'none';
				legalFieldsInn.style.display = 'none';
				companyNameInput.removeAttribute('required');
				innInput.removeAttribute('required');
				companyNameInput.value = '';
				innInput.value = '';
				updateFloatLabel(companyNameInput);
				updateFloatLabel(innInput);
			}
		});
	});

	form.addEventListener('submit', async function(e) {
		e.preventDefault();

		const name = document.getElementById('course-pdf-name').value.trim();
		const phone = document.getElementById('course-pdf-phone').value.trim();
		const email = document.getElementById('course-pdf-email').value.trim();
		const courseIndex = courseSelect.value;
		const entityType = form.querySelector('input[name="entity_type"]:checked').value;

		if (!name || !phone || !email || !courseIndex) {
			alert('Пожалуйста, заполните все обязательные поля');
			return;
		}

		if (entityType === 'legal') {
			const companyName = companyNameInput.value.trim();
			const inn = innInput.value.trim();
			if (!companyName || !inn) {
				alert('Пожалуйста, заполните название организации и ИНН');
				return;
			}
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
			formData.append('email', email);
			formData.append('entity_type', entityType);
			formData.append('course_index', courseIndex);

			if (entityType === 'legal') {
				formData.append('company_name', companyNameInput.value.trim());
				formData.append('inn', innInput.value.trim());
			}

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
				floatInputs.forEach(input => {
					input.classList.remove('has-value');
				});
				if (legalFields) legalFields.style.display = 'none';
				if (legalFieldsInn) legalFieldsInn.style.display = 'none';
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



