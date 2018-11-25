<?php 
require_once 'model/QuestionModel.php';
require_once 'model/AnswerModel.php';
require_once 'model/UserModel.php';
require_once 'model/ThemeModel.php';

class QuestionsController {

    public $config;

    public function __construct($config) {
        $this->config = $config;
    }

    public function showQuestionsOfTheme () {
        $questionModel = new QuestionModel($this->config);
        if(isset($_GET['idTheme'])) {
            $idTheme = $_GET['idTheme'];
            $listQuestions = $questionModel->getListQuestions($idTheme);
            if($listQuestions) {
                $questionModel->render($listQuestions, $idTheme);
    
            } else {
                $questionModel->render(false, $idTheme);
            }
        } else {
            echo '<li>Id theme not found in get parameter. <a href="admin.php">Go back<a></li>';
        }
    }

    public function deleteQuestion () {
        $questionModel = new QuestionModel($this->config);
        $answerModel = new AnswerModel($this->config);
        if(isset($_GET['idQuestion'])) {
            $idQuestion = $_GET['idQuestion'];
            $questionModel->deleteQuestion($idQuestion);
            if (isset($_GET['idTheme'])) {
                $idTheme = 'idTheme='.$_GET['idTheme'];
                $action = 'showList';
            } else {
                $idTheme = '';
                $action = 'showNewQuestions';
            }
            
            $answerModel->deleteAnswer($idQuestion);
            header("location: admin.php?controller=Questions&action={$action}{$idTheme}");
        }
    }

    public function deleteQuestionOfTheme () {
        $questionModel = new QuestionModel($this->config);
        $answerModel = new AnswerModel($this->config);
        $idTheme = $_GET['idTheme'];
        $listQuestions = $questionModel->getListQuestions($idTheme);
        foreach($listQuestions as $question){
            $idQuestion = $question['id'];
            $questionModel->deleteQuestion($idQuestion);
            $answerModel->deleteAnswer($idQuestion);
        }
    }

    public function addNewQuestion () {
        $questionModel = new QuestionModel($this->config);
        if(isset($_GET['idTheme']) && isset($_GET['question']) && isset($_GET['idAuthor'])) {
            $idTheme = $_GET['idTheme'];
            $question = $_GET['question'];
            $idAuthor = $_GET['idAuthor'];
            $res = $questionModel->addNewQuestion($idTheme, $question, $idAuthor);
        }
    }

    public function editQuestion() {
        $questionModel = new QuestionModel($this->config);
        $answerModel = new AnswerModel($this->config);
        $themeModel = new ThemeModel($this->config);
        if(isset($_GET['prevPos'])) {
            $prevPos = $_GET['prevPos'];
        }
        if (isset($_GET['idQuestion'])) {
            $idQuestion = $_GET['idQuestion'];
        }
        if (isset($_GET['idTheme'])) {
            $idTheme = $_GET['idTheme'];
        }
        $listThemes = $themeModel->getListThemes();
        $idAuthor = $questionModel->getIdAuthorForIdQuestion($idQuestion);
        $nameAuthor = $questionModel->getNameAuthorForIdAuthor($idAuthor);
        $question = $questionModel->getQuestionForId($idQuestion);
        $answer = $answerModel->getAnswerForIdQuestion($idQuestion);
        $questionModel->showEditForm($prevPos, $idAuthor, $nameAuthor, $question, $answer, $idQuestion, $idTheme, $listThemes);

    }

    public function fixEditQuestionAnswerUser() {
        if(empty($_GET['question']) || empty($_GET['idQuestion']) || empty($_GET['answer']) || empty($_GET['nameAuthor']) || empty($_GET['idAuthor'])) {
            header("location: admin.php?controller=Questions&action=showList&idTheme={$_GET['idTheme']}#{$_GET['prevPos']}");
            return;
        }
        $questionModel = new QuestionModel($this->config);
        $answerModel = new AnswerModel($this->config);
        $userModel = new UserModel($this->config);
        if(!empty($_GET['question']) && !empty($_GET['idQuestion'])){
            $question = $_GET['question'];
            $idQuestion = $_GET['idQuestion'];
            $res = $questionModel->updateQuestion($idQuestion, $question);
        }
        if(!empty($_GET['answer'])){
            $answer = $_GET['answer'];
            $res = $answerModel->updateAnswer($answer, $idQuestion);
        }
        if(!empty($_GET['nameAuthor']) && !empty($_GET['idAuthor'])){
            $idAuthor = $_GET['idAuthor'];
            $newNameAuthor = $_GET['nameAuthor'];
            $res = $userModel->updateAuthor($newNameAuthor, $idAuthor);
        }
        $newIdTheme = $_GET['newIdTheme'];
        $questionModel->updateIdTheme($idQuestion, $newIdTheme);
        if (!empty($_GET['hidePubl'])) {
            $questionModel->addHidelStatusQuestion($idQuestion);
        } else {
            $questionModel->addPublStatusQuestion($idQuestion);
        }
        if (!empty($_GET['prevPos']) && !empty($_GET['idTheme'])) {
            $prevPos = $_GET['prevPos'];
            $idTheme = $_GET['idTheme'];
            header("location: admin.php?controller=Questions&action=showList&idTheme={$idTheme}#{$prevPos}");
        }
    }

    public function addPublStatusQuestion () {
        $questionModel = new QuestionModel($this->config);
        if (isset($_GET['idQuestion'])) {
            $idQuestion = $_GET['idQuestion'];
        }
        $res = $questionModel->addPublStatusQuestion($idQuestion);
        return $res;
    }
    
    public function addHidelStatusQuestion () {
        $questionModel = new QuestionModel($this->config);
        if (isset($_GET['idQuestion'])) {
            $idQuestion = $_GET['idQuestion'];
        }
        $res = $questionModel->addHidelStatusQuestion($idQuestion);
        return $res;
    }

    public function addPublStatusQuestionFromList () {
        $questionModel = new QuestionModel($this->config);
        if (isset($_GET['idQuestion'])) {
            $idQuestion = $_GET['idQuestion'];
        }
        if (isset($_GET['idTheme'])) {
            $idTheme = $_GET['idTheme'];
        }
        if (isset($_GET['prevPos'])) {
            $prevPos = $_GET['prevPos'];
        }
        $res = $questionModel->addPublStatusQuestion($idQuestion);
        header("location: admin.php?controller=Questions&action=showList&idTheme={$idTheme}#{$prevPos}");
        return $res;
    }

    public function addHidelStatusQuestionFromList() {
        $questionModel = new QuestionModel($this->config);
        if (isset($_GET['idQuestion'])) {
            $idQuestion = $_GET['idQuestion'];
        }
        if (isset($_GET['idTheme'])) {
            $idTheme = $_GET['idTheme'];
        }
        if (isset($_GET['prevPos'])) {
            $prevPos = $_GET['prevPos'];
        }
        $res = $questionModel->addHidelStatusQuestion($idQuestion);
        header("location: admin.php?controller=Questions&action=showList&idTheme={$idTheme}#{$prevPos}");
        return $res;
    }

    public function showAllNewQuestions () {
        $questionModel = new QuestionModel($this->config);
        $listQuestions = $questionModel->getListAllNewQuestions();
        if($listQuestions) {
            $questionModel->renderNew($listQuestions);

        } else {
            $questionModel->renderNew(false);
        }
    }
}