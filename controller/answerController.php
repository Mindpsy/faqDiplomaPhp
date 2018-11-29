<?php 

class AnswerController {
    public $config, $answerModel, $questionController;

    public function __construct($config) {
        $this->config = $config;
        $this->answerModel = new AnswerModel($this->config);
        $this->questionController = new QuestionModel($this->config);
    }

    public function addNewAnswer () {
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
        $res = $this->answerModel->addNewAnswer($idQuestion, $answer);
        if (isset($_GET['hidePubl'])) {
            $this->questionController->addHidelStatusQuestion($idQuestion);

        } else {
            $this->questionController->addPublStatusQuestion($idQuestion);
        }
        header("location: admin.php?controller=Questions&action={$action}{$idTheme}#{$prevPos}");
    }

    public function showEditFormAnswer () {
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
        $this->answerModel->showEditFormAnswer($prevPos, $idQuestion, $idTheme);
    }
}