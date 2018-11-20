-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 20 2018 г., 18:02
-- Версия сервера: 5.6.38
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `faqData`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `login`, `password`) VALUES
(4, 'admin', 'mail@mail.ru', 'admin', 'admin'),
(11, 'admin2', 'admin2@gmail.com', 'wert', 'admin2');

-- --------------------------------------------------------

--
-- Структура таблицы `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `id_question` int(50) DEFAULT NULL,
  `answer` varchar(3000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `answers`
--

INSERT INTO `answers` (`id`, `id_question`, `answer`) VALUES
(1, 2, 'Необходимо распаковать архив faq в корневую папку сайта. Затем необходимо создать пустую базу данных.'),
(2, 3, '<p>Открыть в текстовом редакторе файл configModel.php в папке model и прописать на 3 строке  данные подключения для базы данных по примеру:</p>\r\n\r\n<p>$config = new Config(\'localhost\', \'faqData\', \'root\', \'\');  </p>\r\n\r\n<p>Где \'localhost\' это адрес хоста где хранится база,  \'faqData\' название базы, \'root\' имя пользователя, а последний аргумент пароль к базе.</p>\r\n'),
(3, 4, '<p>Один из двух возможных путей создания таблиц для системы является предустановленные функции по созданию таблиц и дефолтной учетной записи. Уже прописаны и закоментированы команды.</p>\r\n\r\n<p>Для того чтобы создать таблицы и записи откройте для редактировония файл adminRouter.php в папке router. И раскоментируйте строчки кода с 15 по 19 и с 22 по 23. Сохраните изменения. Затем один раз перейдите по адресу вашего сайта такого вида: http://yourSite.ru/admin.php или обновите его если он открыт.</p>\r\n\r\n<p>После чего сразу  закоментируйте строки обратно, иначе при каждом обращении или обновлении скрипт будет создавать в системе ещё одного нового администратора.</p>\r\n'),
(4, 5, 'Зайдите в панель управления БД phpMyAdmin. Создайте новую БД если этого еще не сделали ранее. Выберите созданную вами базу. Нажмите вкладку импортировать. Затем кликните на кнопку Выбрать файл, не меняя настройки нажмите кнопку импортировать. Таблицы будут импортированы и вы увидите об этом сообщение.'),
(5, 6, '<p>Если вы импортировали дамп базы то у вас уже будут созданы темы, вопросов и ответы. Их вы  можете  отредактировать  или удалить по своему усмотрению. Если структуру базы данных создавали через команды php то тем и вопросов еще не будет. Темы необходимо будет создать самостоятельно. </p>\r\n<p>В  системе по умлочанию через php создан один администратор. Можете создать  ещё одного при необходимости в соотвующем разделе. Если в системе остался один администратор то вы его удалить не сможете из админки. Также не рекомендуется удалять учетную запись через которую вы вошли. Система выдаст ошибку. </p>\r\n<p>Все посетители ресурса могут оставлять вопросы в системе, указав имя, тему вопроса, е-мейл и сам вопрос. Автоматически они попадают в раздел новые вопросы и не публикуются на сайте. Для их публикации в админке потребуется добавить на них ответ.</p>\r\n'),
(6, 7, '<p>Чтобы войти в админку нужно перейти по адресу http://yourSite.ru/admin.php. Если ранее вы не были авторизованы через этот браузер, вам будет показана форма для авторизации. По умолчанию в системе установлен один администратор с логином: admin и паролем: admin. Рекомендуем изменить пароль после настройки системы.</p>'),
(7, 8, 'Все посетители ресурса могут оставлять вопросов в системе, указав имя, тему вопроса, е-мейл и вопрос. Автоматически они попадают в раздел новые вопросы и не публикуются на сайте. Для этого на главной странице нужно нажать на кнопку добавить свой вопрос и заполнить все поля.'),
(8, 9, 'Перейдите в раздел администраторы и в правой части экране наведите на карандашик в кружке и нажмите на появившийся плюсик. После его откроется окно с полями которые необходимо заполнить. После заполнения нажмите сохранить.'),
(9, 10, 'Перейдите в раздел администраторов. В списке администраторов напротив каждого администратора будет кнопка редактировать. Нажмите и откроется окно редактирования с полями. Измените нужные поля и нажмите сохранить.'),
(10, 11, 'Все добавленные пользователями вопросы, автоматически попадют в раздел новые вопросы и не публикуются. Для публикации необходимо зайти в раздел новые вопросы и добавить ответ на вопросы выбрать опцию публикации. Либо если вопрос опубликован но затем скрыт, нужно найти интересующую тему и вопрос в ней, и нажать на кнопку опубликовать.'),
(11, 12, 'Зайдите в раздел новые вопросы. Нажмите добавить ответ. Заполните поле ответа. Поставьте галочку опубликовать вопрос. Нажмите сохранить.'),
(12, 13, 'Зайдите в раздел темы. Наведите курсор на кружок с карандашиком в правой части экрана и нажмите на появившийся плюсик. После этого откроется окно  полем названии темы. Заполните поле и нажмите сохранить.'),
(13, 14, 'Зайдите в раздел темы. Найдите тему которую хотите удалить в списке. Нажмите на кнопку удалить.'),
(14, 15, 'Зайдите в раздел темы. Выберите нужную тему и нажмите перейти в тему. Найдите нужный вопрос и нажмите на кнопку скрыть.'),
(15, 16, 'Зайдите в раздел темы. Выберите нужную тему и нажмите перейти в тему. Найдите нужный вопрос и нажмите на кнопку удалить.'),
(16, 17, 'Зайдите в раздел новые вопросы. Нажмите добавить ответ. Заполните поле ответа. Поставьте галочку опубликовать вопрос. Нажмите сохранить.'),
(17, 18, 'Зайдите в раздел темы. Найдите нужную тему. Нажмите на кнопку перейти в тему. Найдите нужный вопрос и нажмите на кнопку редактировать. После чего откроется окно редактирования вопроса с полями. Внесите изменения в нужные поля и нажмите сохранить.'),
(18, 19, 'Перейдите в раздел темы. Там все темы.'),
(19, 20, 'Нажмите на кнопку новые вопросы в горизонтальном меню.'),
(20, 21, 'Нажмите на пункт меню темы в горизонтальном меню. Выберите нужную тему. Нажмите перейти в тему. Откроется список всех вопросов по выбранной теме.');

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `id_theme` int(50) DEFAULT NULL,
  `date_create` varchar(50) DEFAULT NULL,
  `id_author` int(50) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `question` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`id`, `id_theme`, `date_create`, `id_author`, `status`, `question`) VALUES
(2, 8, '2018.11.20', 2, 1, 'Как перенести файлы чтобы система работала?'),
(3, 8, '2018.11.20', 2, 1, 'Как подключить систему к созданной базе данных?'),
(4, 8, '2018.11.20', 2, 1, 'Как создать структуру таблиц для системы без дампа через код php?'),
(5, 8, '2018.11.20', 2, 1, 'Как импортировать структуру таблиц без php через sql дамп?'),
(6, 9, '2018.11.20', 2, 1, 'Как работает система?'),
(7, 9, '2018.11.20', 2, 1, 'Как войти в админку?'),
(8, 9, '2018.11.20', 2, 1, 'Как добавить свой вопрос?'),
(9, 9, '2018.11.20', 2, 1, 'Как создать нового администратора?'),
(10, 9, '2018.11.20', 2, 1, 'Как отредактировать существующего администратора?'),
(11, 9, '2018.11.20', 2, 1, 'Почему я не вижу новых вопросов?'),
(12, 9, '2018.11.20', 2, 1, 'Как опубликовать новый вопрос?'),
(13, 9, '2018.11.20', 2, 1, 'Как добавить новую тему?'),
(14, 9, '2018.11.20', 2, 1, 'Как удалить тему?'),
(15, 9, '2018.11.20', 2, 1, 'Как скрыть вопрос?'),
(16, 9, '2018.11.20', 2, 1, 'Как удалить вопрос?'),
(17, 9, '2018.11.20', 2, 1, 'Как добавить ответ на вопрос?'),
(18, 9, '2018.11.20', 2, 1, 'Как отредактировать вопрос?'),
(19, 9, '2018.11.20', 2, 1, 'Где посмотреть все темы?'),
(20, 9, '2018.11.20', 2, 1, 'Где можно посмотреть все новые вопросы?'),
(21, 8, '2018.11.20', 2, 1, 'Где посмотреть все вопросы по конкретной теме?');

-- --------------------------------------------------------

--
-- Структура таблицы `themes`
--

CREATE TABLE `themes` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `themes`
--

INSERT INTO `themes` (`id`, `name`) VALUES
(8, 'Установка'),
(9, 'Запуск системы');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`) VALUES
(1, 'Ак', 'psihacker8@gmail.com'),
(2, 'Kalashnikov Viktor', 'psihacker8@gmail.com');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
