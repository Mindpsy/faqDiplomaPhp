<?php 
require_once 'model/UserModel.php';
require_once 'model/QuestionModel.php';
require_once 'model/ThemeModel.php';
require_once 'model/AnswerModel.php';


class UserController {
    public $config;

    public function __construct ($config) {
        $this->config = $config;
    }
    public function render($themeList) {
        $config = $this->config;
        require_once 'view/client/index.php';
    }

    public function showQuestions () {
        $themeModel = new ThemeModel($this->config);
        $themeList = $themeModel->getListThemes();
        $this->render($themeList);
    }

    public function showAddForm () {
        $userModel = new UserModel($this->config);
        $themeModel = new ThemeModel($this->config);
        $listThemes = $themeModel->getListThemes();
        $userModel->showAddForm($listThemes);
    }

    public function addNewQuestion () {
        $questionModel = new QuestionModel($this->config);
        $userModel = new UserModel($this->config);
        if(!empty($_GET['nameAuthor']) && !empty($_GET['email']) && !empty($_GET['question'])  && !empty($_GET['idTheme'])) {
            $name = $_GET['nameAuthor'];
            $email = $_GET['email'];
            $idTheme = $_GET['idTheme'];
            $question = $_GET['question'];
            $idAuthor = $userModel->addNewUser($name, $email);
            $questionModel->addNewQuestion($idTheme, $question, $idAuthor);
            header('location: /');

        } else {
            $themeModel = new ThemeModel($this->config);
            $listThemes = $themeModel->getListThemes();
            $userModel->showAddForm($listThemes);
        }        
    }
}