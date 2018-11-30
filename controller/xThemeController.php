<?php

class ThemeController {
    public $config, $modelTheme, $questionModel, $controllerQuestion;

    public function __construct($config) {
        $this->config = $config;
        $this->modelTheme = new ThemeModel($this->config);
        $this->questionModel = new QuestionModel ($this->config);
        $this->controllerQuestion = new QuestionsController($this->config);
    }

    public function showThemes () {
        $res = $this->modelTheme->getListThemes();
        if($res) {
            $this->modelTheme->render($res, $this->questionModel);
        } else {
            $this->modelTheme->render(false, $this->questionModel);
        }

    }

    public function addNewTheme () {
        if (isset($_GET['nameTheme'])) {
            $nameTheme = $_GET['nameTheme'];
            $res = $this->modelTheme->addNewTheme($nameTheme);
            header('location: admin.php?controller=themes&action=showList');

        } else {
            echo "<li>inputed name of theme does not found!</li>";
        }
        
    }

    public function fillNewTheme () {
        $this->modelTheme->showFeldNewTheme();
    }

    public function delTheme () {
        if(isset($_GET['idTheme'])) {
            $idTheme = $_GET['idTheme'];
            $this->modelTheme->delTheme($idTheme);
            $this->controllerQuestion->deleteQuestionOfTheme();
            header('location: admin.php?controller=themes&action=showList');
        }

    }

}