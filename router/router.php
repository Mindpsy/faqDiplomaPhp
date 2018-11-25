<?php
require_once "dumper.php";
require_once "model/ConfigModel.php";
require_once "model/UserModel.php";
require_once "controller/UserController.php";


$commonActions = ['showQuestion', 'editNew', 'addNewQuestion', 'showAddForm'];
$commonControllers = ['users'];


if (!isset($_GET['controller']) && !isset($_GET['action'])) {
    $controller = 'users';
    $action = 'showQuestions';

} else if (in_array($_GET['controller'], $commonControllers) && in_array($_GET['action'], $commonActions)) {
    $action = $_GET['action'];
    $controller = $_GET['controller'];

} else {
    $controller = 'users';
    $action = 'showQuestions';

}

if ($controller === 'users') {
    $userController = new UserController($config);
    

    if ($action === 'showQuestions') {
        $userController->showQuestions();

    } else if ($action === 'showAddForm') {
        $userController->showAddForm();

    } else if ($action === 'addNewQuestion') {
        $userController->addNewQuestion();      

    }

}