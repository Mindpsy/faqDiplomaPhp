<?php
require_once "dumper.php";
require_once "model/configModel.php";
require_once "model/userModel.php";
require_once "controller/userController.php";


$commonActions = ['showQuestion', 'editNew', 'addNewQuestion', 'showAddForm'];
$commonControllers = ['users'];


if (!isset($_GET['controller']) && !isset($_GET['action'])) {
    $controller = 'users';
    $action = 'showQuestions';

} else if (in_arrAY($_GET['controller'], $commonControllers) && in_arrAY($_GET['action'], $commonActions)) {
    $action = $_GET['action'];
    $controller = $_GET['controller'];

} else {
    $controller = 'users';
    $action = 'showQuestions';

}

if ($controller === 'users') {
    $userController = new UserController();

    if ($action === 'showQuestions') {
        $userController->showQuestions($config);

    } else if ($action === 'showAddForm') {
        $userController->showAddForm($config);

    } else if ($action === 'addNewQuestion') {
        $userController->addNewQuestion($config);      

    }

}
?>