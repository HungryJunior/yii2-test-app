Yii 2 Basic Project Template
============================

Развернуть веб-приложение на основе yii 2 с авторизацией пользователей. 
После ввода email пользователю высылается одноразовая ссылка. После перехода по ссылке, если пользователь не зарегистрирован, создается учетная запись и пользователь авторизуется, в противном случае просто авторизуется.
Авторизованный пользователь попадает в личный кабинет, где может изменить имя и разлогиниться. 

Требования: 
============================
yii2
mysql с миграциями
github (история коммитов обязательна)
composer (управление всеми зависимостями приложения) 
Наличие юнит-тестов будет большим плюсом.

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources
