<?php
session_start();

// полезная функция для отладки 
require_once 'dumper.php';

// настройки подключения к базе 
require_once 'config.php';

// подключаемся к базе 
$config->connectDataBase();




// далее закоментированные строки можно разкоментировать чтобы не загружать дамп базы
// просто создав их через php 
// если таблицы уже созданы этот код ошибок не вызовет, но для сохранения  ресурсов
// лучше закоментировать 
// $config->makerSqlQuery($config->createTableUsers);
// $config->makerSqlQuery($config->createTableAdmins);
// $config->makerSqlQuery($config->createTableThemes);
// $config->makerSqlQuery($config->createTableQuestions);
// $config->makerSqlQuery($config->createTableAnswers);

// эти 2 строчки раскоментируем и оновляем один раз страницу для создания стандартного акаунта в системе, затем обратно закоментируем, или при каждойм обращении к скрипту будет создаваться новая учетная запись
// $adminModel = new AdminModel();
// $adminModel->createBaseAdmin($config, 'admin', 'admin', 'mail@mail.ru', 'admin');

// в переменных $commonControllers и $commonActions возможные значения для controller и action параметров 

$commonControllers = ['Questions', 'admins', 'user', 'answers', 'base', 'form', 'themes'];
$commonActions = ['showNewQuestions', 'exitAcc', 'login', 'auth', 'showList', 'addNew', 'editNew', 'delete', 'edit', 'fixEdit', 
                'showPublList', 'showWithoutList', 'editNewAnswer', 'toPublQuestion', 'toHideQuestion', 'editAdmin', 'fixNewEdit'];

// если сессия жива 
if(isset($_SESSION['authStatus'])) {
    // по умолчаню в первом if задаем при входе в систему показывать соответсвующий раздел 
    if (!isset($_GET['controller']) && !isset($_GET['action'])) {
        $controller = 'themes';
        $action = 'showList';
        // для сокращения кода используем функцию in_array она работает с масивами для controller и action
        // и контроллирует заначения этих переменных 
    } else if (in_array($_GET['controller'], $commonControllers) && in_array($_GET['action'], $commonActions)) {
        $controller = $_GET['controller'];
        $action = $_GET['action'];

    } else {
        $controller = 'themes';
        $action = 'showList';
    }

    if ($controller === 'Questions') {
        $controllerQuestion = new QuestionsController ($config);
        
        if ($action === 'showNewQuestions') {
            $controllerQuestion->showAllNewQuestions();

        } else if ($action === 'showList') {
            $controllerQuestion->showQuestionsOfTheme();
            
        } else if ($action === 'delete') {
            $controllerQuestion->deleteQuestion();
            
        }  else if ($action === 'edit') {
            $controllerQuestion->editQuestion();
            
        }  else if ($action === 'fixEdit') {
            $controllerQuestion->fixEditQuestionAnswerUser();
            
        }  else if ($action === 'showPublList') {
            $controllerQuestion->showPublList();
            
        }  else if ($action === 'showWithoutAnswerList') {
            $controllerQuestion->showWithoutAnswerList();
            
        } else if ($action === 'toPublQuestion') {
            $controllerQuestion->addPublStatusQuestionFromList();

        } else if ($action === 'toHideQuestion') {
            $controllerQuestion->addHidelStatusQuestionFromList();
        }
    
    }  else if ($controller === 'admins') {
        $adminController = new AdminController($config);

        if ($action === 'showList') {
            $adminController->showListAdmins();

        } else if ($action === 'exitAcc') {
            $adminController->exitAcc();

        } else if ($action === 'editNew') {
            $adminController->fillFormNewAdmin();

        } else if ($action === 'fixNewEdit') {
            $adminController->fixEditionNewAdmin();

        } else if ($action === 'edit') {
            $adminController->toEditAdmin();

        } else if ($action === 'fixEdit') {
            $adminController->fixEditAdmin();

        } else if ($action === 'delete') { 
            $adminController->deleteAdmin();

        }

    } else if ($controller === 'themes') {
        $controllerTheme = new ThemeController($config);

        if ($action === 'showList') {
            $controllerTheme->showThemes();

        } else if ($action === 'editNew') {
            $controllerTheme->fillNewTheme();

        } else if ($action === 'addNew') {
            $controllerTheme->addNewTheme();

        } else if ($action === 'delete') {
            $controllerTheme->delTheme();

        }

    }  else if ($controller === 'answers') {
        $controllerAnswer = new AnswerController($config);

        if ($action === 'editNewAnswer') {
            $controllerAnswer->showEditFormAnswer();

        } else if ($action === 'addNew') {
            $controllerAnswer->addNewAnswer();
        }

    }


    // если сессии нет
} else {
    if (!isset($_GET['controller']) && !isset($_GET['action'])) {
        $controller = 'form';
        $action = 'auth';

    } else if (in_array($_GET['controller'], $commonControllers) && in_array($_GET['action'], $commonActions)) {
        $controller = $_GET['controller'];
        $action = $_GET['action'];
        
    } else {
        $controller = 'form';
        $action = 'auth';
    }

    require_once 'controller/AdminController.php';
    $adminController = new AdminController($config);

    if($controller === 'form') {
        if ($action === 'auth') {
            $adminController->showAuthForm();
        }

    } else if ($controller === 'base') {
        if ($action === 'login') {
            $adminController->authorise();
        }
        
    }


}