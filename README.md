# Установка и запуск системы FAQ

## Установка

### Перенос файлов.
Необходимо распаковать архив faq в корневую папку сайта. Затем необходимо создать пустую базу данных. 

### Подключение базы.
После чего открыть в текстовом редакторе файл configModel.php и прописать на 3 строке  данные подключения для базы данных по примеру:
$config = new Config('localhost', 'faqData', 'root', '');  где 'localhost' это адрес хоста где хранится база,  'faqData' название базы, 'root' имя пользователя, а последний аргумент пароль к базе.

### Создание таблиц через php.
Один из двух возможных путей создания таблиц для системы является предустановленные функции по созданию таблиц и дефолтной учетной записи. Уже прописаны и закоментированы команды.

Для того чтобы создать таблицы и записи откройте для редактировония файл adminRouter.php в папке router. И раскоментируйте строчки кода с 15 по 19 и с 22 по 23. Сохраните изменения. Затем один раз перейдите по адресу вашего сайта такого вида: http://yourSite.ru/admin.php или обновите его если он открыт.

После чего сразу  закоментируйте строки обратно, иначе при каждом обращении или обновлении скрипт будет создавать в системе ещё одного нового администратора.
### Импорт таблиц из дампа.
Зайдите в панель управления БД phpMyAdmin. Создайте новую БД если этого еще не сделали ранее. Выберите созданную вами базу. Нажмите вкладку импортировать. Затем кликните на кнопку Выбрать файл, выберите файл дампа dumpFaq.sql и не меняя настройки нажмите кнопку импортировать. Таблицы будут импортированы и вы увидите об этом сообщение.

## Запуск системы
### Как работает система.
Если вы импортировали дамп базы то у вас уже будут созданы темы, вопросов и ответы. Их вы  можете  отредактировать  или удалить по своему усмотрению. Если структуру базы данных создавали через команды php то тем и вопросов еще не будет. Темы необходимо будет создать самостоятельно. 
В  системе по умлочанию через php создан один администратор. Можете создать  ещё одного при необходимости в соотвующем разделе. Если в системе остался один администратор то вы его удалить не сможете из админки. Также не рекомендуется удалять учетную запись через которую вы вошли. Система выдаст ошибку. 
Все посетители ресурса могут оставлять вопросы в системе, указав имя, тему вопроса, е-мейл и сам вопрос. Автоматически они попадают в раздел новые вопросы и не публикуются на сайте. Для их публикации в админке потребуется добавить на них ответ.

### Как войти в админку.
Чтобы войти в админку нужно перейти по адресу http://yourSite.ru/admin.php. Если ранее вы не были авторизованы через этот браузер, вам будет показана форма для авторизации. По умолчанию в системе установлен один администратор с логином: admin и паролем: admin. Рекомендуем изменить пароль после настройки системы.
### Как добавить свой вопрос.
Все посетители ресурса могут оставлять вопросов в системе, указав имя, тему вопроса, е-мейл и вопрос. Автоматически они попадают в раздел новые вопросы и не публикуются на сайте. Для этого на главной странице нужно нажать на кнопку добавить свой вопрос и заполнить все поля.

### Как создать нового администратора.
Перейдите в раздел администраторы и в правой части экране наведите на карандашик в кружке и нажмите на появившийся плюсик. После его откроется окно с полями которые необходимо заполнить. После заполнения нажмите сохранить.

### Как отредактировать существующего администратора.
Перейдите в раздел администраторов. В списке администраторов напротив каждого администратора будет кнопка редактировать. Нажмите и откроется окно редактирования с полями. Измените нужные поля и нажмите сохранить.

### Почему я не вижу новых вопросов?
Все добавленные пользователями вопросы, автоматически попадют в раздел новые вопросы и не публикуются. Для публикации необходимо зайти в раздел новые вопросы и добавить ответ на вопросы выбрать опцию публикации. Либо если вопрос опубликован но затем скрыт, нужно найти интересующую тему и вопрос в ней, и нажать на кнопку опубликовать.

### Как опубликовать новый вопрос?
Зайдите в раздел новые вопросы. Нажмите добавить ответ. Заполните поле ответа. Поставьте галочку опубликовать вопрос. Нажмите сохранить.

### Как добавить новую тему?
Зайдите в раздел темы. Наведите курсор на кружок с карандашиком в правой части экрана и нажмите на появившийся плюсик. После этого откроется окно  полем названии темы. Заполните поле и нажмите сохранить.

### Как удалить тему?
Зайдите в раздел темы. Найдите тему которую хотите удалить в списке. Нажмите на кнопку удалить.

### Как скрыть вопрос?
Зайдите в раздел темы. Выберите нужную тему и нажмите перейти в тему. Найдите нужный вопрос и нажмите на кнопку скрыть.

### Как удалить вопрос?
Зайдите в раздел темы. Выберите нужную тему и нажмите перейти в тему. Найдите нужный вопрос и нажмите на кнопку удалить.

### Как добавить ответ на вопрос?
Зайдите в раздел новые вопросы. Нажмите добавить ответ. Заполните поле ответа. Поставьте галочку опубликовать вопрос. Нажмите сохранить.

### Как отредактировать вопрос?
Зайдите в раздел темы. Найдите нужную тему. Нажмите на кнопку перейти в тему. Найдите нужный вопрос и нажмите на кнопку редактировать. После чего откроется окно редактирования вопроса с полями. Внесите изменения в нужные поля и нажмите сохранить.

### Где посмотреть все темы?
Перейдите в раздел темы. Там все темы.

### Где посмотреть все новые вопросы?
Нажмите на кнопку новые вопросы в горизонтальном меню.

### Где посмотреть все вопросы по конкретной теме?
Нажмите на пункт меню темы в горизонтальном меню. Выберите нужную тему. Нажмите перейти в тему. Откроется список всех вопросов по выбранной теме.

## UNL схема базы данных и описание системы в гугл документе:
 <a href="https://docs.google.com/document/d/18vtuKs3FtWhX1CG26DDXTGU28ENLr73xjvm7C0Ebyp8/edit?usp=sharing">Ссылка</a>

 <img src="uml.png">
