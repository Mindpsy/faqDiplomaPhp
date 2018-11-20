<?php 
require_once 'model/answerModel.php';
require_once 'controller/questionController.php';

class AnswerController {
    public function addNewAnswer ($config) {
        $answerModel = new AnswerModel();
        $questionController = new QuestionModel();
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
        $res = $answerModel->addNewAnswer($config, $idQuestion, $answer);
        if (isset($_GET['hidePubl'])) {
            $questionController->addHidelStatusQuestion($config, $idQuestion);

        } else {
            $questionController->addPublStatusQuestion($config, $idQuestion);
        }
        header("location: admin.php?controller=Questions&action={$action}{$idTheme}#{$prevPos}");
    }

    public function showEditFormAnswer ($config) {
        $answerModel = new AnswerModel();
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


?>