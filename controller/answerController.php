<?php 
require_once 'model/AnswerModel.php';
require_once 'controller/QuestionController.php';

class AnswerController {
    public $config;

    public function __construct($config) {
        $this->config = $config;
    }

    public function addNewAnswer () {
        $answerModel = new AnswerModel($this->config);
        $questionController = new QuestionModel($this->config);
        if (isset($_GET['idTheme'])) {
            $idTheme = 'idTheme='.$_GET['idTheme'];
            $action = 'showList';
        } else {
            $idTheme = '';
            $action = 'showNewQuestions';
        }

        if (isset($_GET['idQuestion'])) {
            $idQuestion = $_GET['idQuestion'];
        }
        if (isset($_GET['answer'])) {
            $answer = $_GET['answer'];
        }
        if (isset($_GET['prevPos'])) {
            $prevPos = $_GET['prevPos'];
        }
        $res = $answerModel->addNewAnswer($idQuestion, $answer);
        if (isset($_GET['hidePubl'])) {
            $questionController->addHidelStatusQuestion($idQuestion);

        } else {
            $questionController->addPublStatusQuestion($idQuestion);
        }
        header("location: admin.php?controller=Questions&action={$action}{$idTheme}#{$prevPos}");
    }

    public function showEditFormAnswer () {
        $answerModel = new AnswerModel($this->config);
        if (isset($_GET['prevPos'])) {
            $prevPos = $_GET['prevPos'];
        }
        if (isset($_GET['idQuestion'])) {
            $idQuestion = $_GET['idQuestion'];
        }
        if (isset($_GET['idTheme'])) {
            $idTheme = $_GET['idTheme'];
        } else {
            $idTheme = '';
        }
        $answerModel->showEditFormAnswer($prevPos, $idQuestion, $idTheme);
    }
}