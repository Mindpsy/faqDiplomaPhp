<?php

class ThemeController {
    public $config;

    public function __construct($config) {
        $this->config = $config;
    }

    public function showThemes () {
        $modelTheme = new ThemeModel($this->config);
        $questionModel = new QuestionModel ($this->config);
        $res = $modelTheme->getListThemes();
        if($res) {
            $modelTheme->render($res, $questionModel);
        } else {
            $modelTheme->render(false, $questionModel);
        }

    }

    public function addNewTheme () {
        if (isset($_GET['nameTheme'])) {
            $nameTheme = $_GET['nameTheme'];
            $modelTheme = new ThemeModel($this->config);
            $res = $modelTheme->addNewTheme($nameTheme);
            header('location: admin.php?controller=themes&action=showList');

        } else {
            echo "<li>inputed name of theme does not found!</li>";
        }
        
    }

    public function fillNewTheme () {
        $modelTheme = new ThemeModel($this->config);
        $modelTheme->showFeldNewTheme();
    }

    public function delTheme () {
        $modelTheme = new ThemeModel($this->config);
        $controllerQuestion = new QuestionsController($this->config);
        if(isset($_GET['idTheme'])) {
            $idTheme = $_GET['idTheme'];
            $modelTheme->delTheme($idTheme);
            $controllerQuestion->deleteQuestionOfTheme();
            header('location: admin.php?controller=themes&action=showList');
        }

    }

}