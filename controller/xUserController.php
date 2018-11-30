<?php 

class UserController {
    public $config, $themeModel, $userModel, $questionModel;

    public function __construct ($config) {
        $this->config = $config;
        $this->themeModel = new ThemeModel($this->config);
        $this->userModel = new UserModel($this->config);
        $this->questionModel = new QuestionModel($this->config);
    }

    public function render($themeList) {
        $config = $this->config;
        require_once 'view/client/index.php';
    }

    public function showQuestions () {
        $themeList = $this->themeModel->getListThemes();
        $this->render($themeList);
    }

    public function showAddForm () {
        
        $listThemes = $this->themeModel->getListThemes();
        $this->userModel->showAddForm($listThemes);
    }

    public function addNewQuestion () {
        if(!empty($_GET['nameAuthor']) && !empty($_GET['email']) && !empty($_GET['question'])  && !empty($_GET['idTheme'])) {
            $name = $_GET['nameAuthor'];
            $email = $_GET['email'];
            $idTheme = $_GET['idTheme'];
            $question = $_GET['question'];
            $idAuthor = $this->userModel->addNewUser($name, $email);
            $this->questionModel->addNewQuestion($idTheme, $question, $idAuthor);
            header('location: index.php');

        } else {
            $listThemes = $this->themeModel->getListThemes();
            $this->userModel->showAddForm($listThemes);
        }        
    }
}