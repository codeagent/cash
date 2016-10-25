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

