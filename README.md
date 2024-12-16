# REST API сервис и админка для ближайшего склада по координатам
Используется swagger для документации, админка Filament 3

## Запуск
- composer install
- cp .env.example .env
- docker-compose up
- docker-compose exec db psql -U laravel -d laravel -c "CREATE EXTENSION postgis;"
- docker-compose run --rm app php artisan migrate:fresh --seed

## Вход в админку
- http://localhost/admin
- логин: test@example.com
- пароль: password

## Основные ссылки
- http://localhost/api/documentation
- http://localhost/admin
