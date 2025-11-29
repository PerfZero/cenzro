(function() {
	const form = document.getElementById('pdf-download-form');
	if (!form) return;

	const professionSelect = document.getElementById('pdf-profession');
	const professionOptions = {};

	if (professionSelect) {
		Array.from(professionSelect.options).forEach(option => {
			if (option.value) {
				professionOptions[option.value] = option.text;
			}
		});
	}

	form.addEventListener('submit', async function(e) {
		e.preventDefault();

		const name = document.getElementById('pdf-name').value.trim();
		const phone = document.getElementById('pdf-phone').value.trim();
		const professionId = document.getElementById('pdf-profession').value;
		const professionName = professionOptions[professionId] || '';

		if (!name || !phone || !professionId) {
			alert('Пожалуйста, заполните все обязательные поля');
			return;
		}

		const submitButton = form.querySelector('.modal-submit');
		const originalText = submitButton.textContent;
		submitButton.disabled = true;
		submitButton.textContent = 'Обработка...';

		try {
			if (typeof jsPDF !== 'undefined') {
				const doc = new jsPDF();
				
				doc.setFontSize(20);
				doc.text('Заявка на обучение', 105, 20, { align: 'center' });
				
				doc.setFontSize(12);
				doc.text('Имя: ' + name, 20, 40);
				doc.text('Телефон: ' + phone, 20, 50);
				doc.text('Профессия: ' + professionName, 20, 60);
				
				const date = new Date();
				const dateStr = date.toLocaleDateString('ru-RU');
				doc.text('Дата: ' + dateStr, 20, 70);
				
				doc.text('ООО "ЦЕНЗОР"', 20, 90);
				doc.text('Дистанционное обучение по всей России', 20, 100);
				
				const fileName = 'zayavka_' + name.replace(/\s+/g, '_') + '_' + Date.now() + '.pdf';
				doc.save(fileName);
			} else {
				console.error('jsPDF не загружен');
			}

			const formData = new FormData();
			formData.append('action', 'submit_pdf_request');
			formData.append('name', name);
			formData.append('phone', phone);
			formData.append('profession_id', professionId);
			formData.append('profession_name', professionName);

			const response = await fetch(ajaxurl || '/wp-admin/admin-ajax.php', {
				method: 'POST',
				body: formData
			});

			const result = await response.json();

			if (result.success) {
				alert('Заявка успешно отправлена!');
				form.reset();
				const pdfModal = document.getElementById('pdf-download-modal');
				if (pdfModal) {
					pdfModal.classList.remove('active');
					document.body.style.overflow = '';
				}
			} else {
				alert('Ошибка при отправке заявки. Попробуйте позже.');
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
