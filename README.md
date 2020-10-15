# fins
Для начала надо клонировать проект себе локально и следовать следующим действиям:

1) composer install
2) php init(выбрать окуружение Development)
3) в файле common/config/main-local.php прописать свой локальный хост с портом
4) в файле docker-compose.yaml прописываем свои локальные данные
5) docker-compose up --build -d
6) заходим в php докер контейнер и запускаем миграции php yii migrate
7) находясь в том же контейнере, создаём двух тестовых пользователей командами:          
    php yii users/user admin@gmail.com admin 123 admin          
    php yii users/user user@gmail.com user 123 user             
8) переходим по ссылке и поднимаем апи на golang: https://github.com/Dilbar97/fins-api(там тоже будет прописан ридми)


