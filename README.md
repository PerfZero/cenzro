# Cenzor WordPress Theme

Тема для WordPress сайта ЦЕНЗОР - Дистанционное обучение по всей России.

## Структура проекта

- `wp-content/themes/cenzor/` - основная тема

## Разработка

Проект использует Docker для локальной разработки.

```bash
docker-compose up -d
```

## Деплой

Автоматический деплой настроен через GitHub Actions. При пуше в ветку `main` тема автоматически деплоится на сервер.

### Настройка GitHub Secrets

Для работы CI/CD нужно добавить секреты в настройках репозитория GitHub:

1. Перейдите в Settings → Secrets and variables → Actions
2. Добавьте секрет `BEGET_PASSWORD` со значением пароля от SSH (8MOUfOWK1oG*)

### Первый пуш

```bash
git push -u origin main
```

После этого все последующие пуши в `main` будут автоматически деплоить тему на сервер `devdenis.ru-94`.

## Технологии

- WordPress
- ACF Pro
- Swiper.js
- Custom Post Types

