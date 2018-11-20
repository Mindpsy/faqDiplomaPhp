<?php
require_once 'model/themeModel.php';
require_once 'model/questionModel.php';
require_once 'controller/questionController.php';

class ThemeController {
    public function showThemes ($config) {
        $modelTheme = new ThemeModel();
        $questionModel = new QuestionModel ();
        $res = $modelTheme->getListThemes($config);
        if($res) {
            $modelTheme->render($res, $config, $questionModel);
        } else {
            $modelTheme->render(false, $config, $questionModel);
        }

    }

    public function addNewTheme ($config) {
        if (isset($_GET['nameTheme'])) {
            $nameTheme = $_GET['nameTheme'];
            $modelTheme = new ThemeModel();
            $res = $modelTheme->addNewTheme($config, $nameTheme);
            header('location: admin.php?controller=themes&action=showList');

        } else {
            echo "<li>inputed name of theme does not found!</li>";
        }
        
    }

    public function fillNewTheme () {
        $modelTheme = new ThemeModel();
        $modelTheme->showFeldNewTheme();
    }

    public function delTheme ($config) {
        $modelTheme = new ThemeModel();
        $controllerQuestion = new QuestionsController();
        if(isset($_GET['idTheme'])) {
            $idTheme = $_GET['idTheme'];
            $modelTheme->delTheme($config, $idTheme);
            $controllerQuestion->deleteQuestionOfTheme($config);
            header('location: admin.php?controller=themes&action=showList');
        }

    }

}
?>