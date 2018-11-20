<?php 
require_once 'model/userModel.php';
require_once 'model/questionModel.php';
require_once 'model/themeModel.php';
require_once 'model/answerModel.php';


class UserController {
    public function render($config, $themeList) {
        require_once 'view/client/index.php';
    }

    public function showQuestions ($config) {
        $themeModel = new ThemeModel();
        $themeList = $themeModel->getListThemes ($config);
        $this->render($config, $themeList);
    }

    public function showAddForm ($config) {
        $userModel = new UserModel();
        $themeModel = new ThemeModel();
        $listThemes = $themeModel->getListThemes($config);
        $userModel->showAddForm($listThemes);
    }

    public function addNewQuestion ($config) {
        $questionModel = new QuestionModel();
        $userModel = new UserModel();
        if(!empty($_GET['nameAuthor']) && !empty($_GET['email']) && !empty($_GET['question'])  && !empty($_GET['idTheme'])) {
            $name = $_GET['nameAuthor'];
            $email = $_GET['email'];
            $idTheme = $_GET['idTheme'];
            $question = $_GET['question'];
            $idAuthor = $userModel->addNewUser($config, $name, $email);
            $questionModel->addNewQuestion($config, $idTheme, $question, $idAuthor);
            header('location: /');

        } else {
            $themeModel = new ThemeModel();
            $listThemes = $themeModel->getListThemes($config);
            $userModel->showAddForm($listThemes);
        }        
    }
}

?>