<?php
session_start();
require_once 'dumper.php';
require_once 'model/configModel.php';
require_once 'model/adminModel.php';


// настраиваем подключение к базе 
// указываем хост имя базы, логин и пароль соответсвенно 

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
        // для сокращения кода используем функцию in_arrAY она работает с масивами для controller и action
        // и контроллирует заначения этих переменных 
    } else if (in_arrAY($_GET['controller'], $commonControllers) && in_arrAY($_GET['action'], $commonActions)) {
        $controller = $_GET['controller'];
        $action = $_GET['action'];

    } else {
        $controller = 'themes';
        $action = 'showList';
    }

    if ($controller === 'Questions') {
        require_once 'controller/questionController.php';
        $controllerQuestion = new QuestionsController ();
        
        if ($action === 'showNewQuestions') {
            $controllerQuestion->showAllNewQuestions($config);

        } else if ($action === 'showList') {
            $controllerQuestion->showQuestionsOfTheme($config);
            
        } else if ($action === 'delete') {
            $controllerQuestion->deleteQuestion($config);
            
        }  else if ($action === 'edit') {
            $controllerQuestion->editQuestion($config);
            
        }  else if ($action === 'fixEdit') {
            $controllerQuestion->fixEditQuestionAnswerUser($config);
            
        }  else if ($action === 'showPublList') {
            $controllerQuestion->showPublList($config);
            
        }  else if ($action === 'showWithoutAnswerList') {
            $controllerQuestion->showWithoutAnswerList($config);
            
        } else if ($action === 'toPublQuestion') {
            $controllerQuestion->addPublStatusQuestionFromList($config);

        } else if ($action === 'toHideQuestion') {
            $controllerQuestion->addHidelStatusQuestionFromList($config);
        }
    
    }  else if ($controller === 'admins') {
        require_once 'controller/adminController.php';
        $adminController = new AdminController();

        if ($action === 'showList') {
            $adminController->showListAdmins($config);

        } else if ($action === 'exitAcc') {
            $adminController->exitAcc();

        } else if ($action === 'editNew') {
            $adminController->fillFormNewAdmin($config);

        } else if ($action === 'fixNewEdit') {
            $adminController->fixEditionNewAdmin($config);

        } else if ($action === 'edit') {
            $adminController->toEditAdmin($config);

        } else if ($action === 'fixEdit') {
            $adminController->fixEditAdmin($config);

        } else if ($action === 'delete') { 
            $adminController->deleteAdmin($config);

        }

    } else if ($controller === 'themes') {
        require_once 'controller/themeController.php';
        $controllerTheme = new ThemeController();

        if ($action === 'showList') {
            $controllerTheme->showThemes($config);

        } else if ($action === 'editNew') {
            $controllerTheme->fillNewTheme($config);

        } else if ($action === 'addNew') {
            $controllerTheme->addNewTheme($config);

        } else if ($action === 'delete') {
            $controllerTheme->delTheme($config);

        }

    }  else if ($controller === 'answers') {
        require_once 'controller/answerController.php';
        $controllerAnswer = new AnswerController();

        if ($action === 'editNewAnswer') {
            $controllerAnswer->showEditFormAnswer($config);

        } else if ($action === 'addNew') {
            $controllerAnswer->addNewAnswer($config);
        }

    }


    // если сессии нет
} else {
    if (!isset($_GET['controller']) && !isset($_GET['action'])) {
        $controller = 'form';
        $action = 'auth';

    } else if (in_arrAY($_GET['controller'], $commonControllers) && in_arrAY($_GET['action'], $commonActions)) {
        $controller = $_GET['controller'];
        $action = $_GET['action'];
        
    } else {
        $controller = 'form';
        $action = 'auth';
    }

    require_once 'controller/adminController.php';
    $adminController = new AdminController();

    if($controller === 'form') {
        if ($action === 'auth') {
            $adminController->showAuthForm();
        }

    } else if ($controller === 'base') {
        if ($action === 'login') {
            $adminController->authorise($config);
        }
        
    }


}

?>