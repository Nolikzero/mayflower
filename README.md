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

