## Установка

```
git clone https://github.com/codeagent/cash project_name
cd project_name
composer install
```

Прописать подключение к бд в файле @app/config/db

```
php yii migrate
php yii fixture/load 'User'
```
## Запуск

В папке проекта выполнить
```
php yii serve
```

## Аккаунты
*admin*/*admin* для администратора
*login_name*/*login_name* для простого пользователя. Для этого сначала нужно зайти под админом и посмотреть какие пользователи есть.

## Запрос к внешним crm
Запусить второй сервер который будет эмулировать crm:
```
cd project_name/web
php -S localhost:8001
```
Операции логируются в @app/runtime/logs/crm.php. Только для веб интерфейса.


## Интеграции с внешними системами

Репорты:
```
curl -i -H "Accept:application/json" "http://localhost:8080/api/reports?access-token=admin"
curl -i -H "Accept:application/json" "http://localhost:8080/api/reports?access-token=Bernard+Lindgren"

curl -i -H "Accept:application/json" -H "Content-Type:application/json" -XPOST "http://localhost:8080/api/reports?access-token=admin" -d '{"user_id": 1, "amount": 50000.00, "article":1}'
curl -i -H "Accept:application/json" -H "Content-Type:application/json" -XPOST "http://localhost:8080/api/reports?access-token=Bernard+Lindgren" -d '{"user_id": 1, "amount": 50000.00, "article":1}'
```

Операции:
```
curl -i -H "Accept:application/json" "http://localhost:8080/api/operations?access-token=admin"
curl -i -H "Accept:application/json" "http://localhost:8080/api/operations?access-token=Bernard+Lindgren"

curl -i -H "Accept:application/json" -H "Content-Type:application/json" -XPOST "http://localhost:8080/api/operations?access-token=admin" -d '{"is_debit": 1, "amount": 50000.00}'
curl -i -H "Accept:application/json" -H "Content-Type:application/json" -XPOST "http://localhost:8080/api/operations?access-token=Bernard+Lindgren" -d '{"is_debit": 1, "is_for_user": 1, "user_id": 2, "amount": 50000.00}'
```
