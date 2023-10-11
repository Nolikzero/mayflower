# Тестовое задание

## Запуск сервиса (в докере)

```bash
docker-compose -f docker-compose.local.yml up -d --build
```

## Запуск тестов

```bash
docker-compose -f docker-compose.local.yml run app ./vendor/bin/phpunit
```

## Доступные эндпоинты

### Увеличение счетчика по стране

```bash
curl --location --request POST 'http://localhost:8080/api/country-statistic' \
--header 'Content-Type: application/json' \
--data-raw '{
    "countryCode": "RU"
}'
```

### Получение счетчиков по странам

```bash
curl --location --request GET 'http://localhost:8080/api/country-statistic'
```

## Использованные технологии

В качестве фреймворка использован [Spiral](https://spiral.dev/) - фреймворк использует `roadrunner`, специально разработанный для `PHP`, который подгружает код только один раз, а затем взаимодействует с ним по каждому отдельному запросу. Такой подход позволяет значительно повысить производительность, обеспечивая в 2 раза более высокую производительность по сравнению с другими PHP-фреймворками.
