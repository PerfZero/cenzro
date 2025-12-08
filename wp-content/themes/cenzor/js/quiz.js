(function() {
	const quizForm = document.getElementById('quiz-form');
	if (!quizForm) return;

	const quizContainer = document.getElementById('quiz-container');
	const quizResult = document.getElementById('quiz-result');
	const quizResultContent = document.getElementById('quiz-result-content');
	const quizProgressFill = document.getElementById('quiz-progress-fill');
	const quizProgressText = document.getElementById('quiz-progress-text');
	const quizRestartBtn = document.getElementById('quiz-restart');

	const questions = document.querySelectorAll('.quiz-question');
	const totalQuestions = questions.length;
	let currentQuestion = 0;

	const answerInputs = document.querySelectorAll('.quiz-answer input[type="radio"]');
	answerInputs.forEach(input => {
		input.addEventListener('change', function() {
			const answer = this.closest('.quiz-answer');
			const question = answer.closest('.quiz-question');
			question.querySelectorAll('.quiz-answer').forEach(a => a.classList.remove('selected'));
			answer.classList.add('selected');
		});
	});

	function updateProgress() {
		const progress = ((currentQuestion + 1) / totalQuestions) * 100;
		quizProgressFill.style.width = progress + '%';
		quizProgressText.textContent = 'Вопрос ' + (currentQuestion + 1) + ' из ' + totalQuestions;
	}

	function showQuestion(index) {
		questions.forEach((q, i) => {
			q.style.display = i === index ? 'block' : 'none';
		});
		currentQuestion = index;
		updateProgress();
	}

	document.addEventListener('click', function(e) {
		if (e.target.classList.contains('quiz-btn-next')) {
			e.preventDefault();
			const question = e.target.closest('.quiz-question');
			const questionIndex = parseInt(question.dataset.question);
			const selected = question.querySelector('input[type="radio"]:checked');
			if (!selected) {
				alert('Пожалуйста, выберите ответ');
				return;
			}
			if (questionIndex < totalQuestions - 1) {
				showQuestion(questionIndex + 1);
			}
		}

		if (e.target.classList.contains('quiz-btn-prev')) {
			e.preventDefault();
			const question = e.target.closest('.quiz-question');
			const questionIndex = parseInt(question.dataset.question);
			if (questionIndex > 0) {
				showQuestion(questionIndex - 1);
			}
		}
	});

	quizForm.addEventListener('submit', async function(e) {
		e.preventDefault();

		const lastQuestion = questions[totalQuestions - 1];
		const selected = lastQuestion.querySelector('input[type="radio"]:checked');
		if (!selected) {
			alert('Пожалуйста, выберите ответ');
			return;
		}

		const formData = new FormData();
		formData.append('action', 'submit_quiz');
		formData.append('quiz_id', quizForm.dataset.quizId || '');

		let totalPoints = 0;
		questions.forEach((question, qIndex) => {
			const selectedAnswer = question.querySelector('input[type="radio"]:checked');
			if (selectedAnswer) {
				const points = parseInt(selectedAnswer.dataset.points) || 0;
				totalPoints += points;
				formData.append('answers[' + qIndex + ']', selectedAnswer.value);
			}
		});

		if (quizForm) quizForm.style.display = 'none';
		const contactForm = document.getElementById('quiz-contact-form');
		if (contactForm) {
			contactForm.style.display = 'block';
			contactForm.dataset.totalPoints = totalPoints;
			contactForm.dataset.answers = JSON.stringify(Array.from(questions).map((q, idx) => {
				const selected = q.querySelector('input[type="radio"]:checked');
				return selected ? selected.value : '';
			}));
		}
	});

	const contactForm = document.getElementById('quiz-contact-form-inner');
	if (contactForm) {
		contactForm.addEventListener('submit', async function(e) {
			e.preventDefault();

			const name = document.getElementById('quiz-contact-name').value.trim();
			const phone = document.getElementById('quiz-contact-phone').value.trim();
			const email = document.getElementById('quiz-contact-email').value.trim();

			if (!name) {
				alert('Пожалуйста, укажите ваше имя');
				return;
			}

			if (!phone && !email) {
				alert('Пожалуйста, укажите телефон или email');
				return;
			}

			const contactFormContainer = document.getElementById('quiz-contact-form');
			const totalPoints = parseInt(contactFormContainer.dataset.totalPoints) || 0;
			const answers = JSON.parse(contactFormContainer.dataset.answers || '[]');
			const quizId = quizForm.dataset.quizId || '';

			const formData = new FormData();
			formData.append('action', 'submit_quiz');
			formData.append('quiz_id', quizId);
			formData.append('name', name);
			formData.append('phone', phone);
			formData.append('email', email);
			formData.append('total_points', totalPoints);
			answers.forEach((answer, index) => {
				formData.append('answers[' + index + ']', answer);
			});

			const submitButton = contactForm.querySelector('.quiz-btn-submit-contact');
			const originalText = submitButton ? submitButton.textContent : 'Получить результаты';
			if (submitButton) {
				submitButton.disabled = true;
				submitButton.textContent = 'Обработка...';
			}

			try {
				const ajaxUrl = (typeof cenzorAjax !== 'undefined' && cenzorAjax.ajaxurl) ? cenzorAjax.ajaxurl : '/wp-admin/admin-ajax.php';
				const response = await fetch(ajaxUrl, {
					method: 'POST',
					body: formData
				});

				const result = await response.json();

				if (result.success) {
					if (contactFormContainer) contactFormContainer.style.display = 'none';
					if (quizResult) {
						quizResult.style.display = 'block';
						if (quizResultContent) {
							quizResultContent.innerHTML = result.data.html || '<p>Спасибо за прохождение квиза!</p>';
						}
					}
				} else {
					alert(result.data && result.data.message ? result.data.message : 'Ошибка при отправке данных');
				}
			} catch (error) {
				console.error('Ошибка:', error);
				alert('Произошла ошибка. Попробуйте позже.');
			} finally {
				if (submitButton) {
					submitButton.disabled = false;
					submitButton.textContent = originalText;
				}
			}
		});
	}

	if (quizRestartBtn) {
		quizRestartBtn.addEventListener('click', function() {
			if (quizForm) {
				quizForm.reset();
				quizForm.style.display = 'block';
			}
			const contactFormContainer = document.getElementById('quiz-contact-form');
			if (contactFormContainer) {
				contactFormContainer.style.display = 'none';
			}
			if (quizResult) {
				quizResult.style.display = 'none';
			}
			questions.forEach((q, i) => {
				q.querySelectorAll('.quiz-answer').forEach(a => a.classList.remove('selected'));
			});
			showQuestion(0);
		});
	}

	updateProgress();
})();









