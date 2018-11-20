<?php 
require_once 'model/questionModel.php';
require_once 'model/answerModel.php';
require_once 'model/userModel.php';
require_once 'model/themeModel.php';

class QuestionsController {

    public function showQuestionsOfTheme ($config) {
        $questionModel = new QuestionModel();
        if(isset($_GET['idTheme'])) {
            $idTheme = $_GET['idTheme'];
            $listQuestions = $questionModel->getListQuestions($config, $idTheme);
            if($listQuestions) {
                $questionModel->render($listQuestions, $idTheme);
    
            } else {
                $questionModel->render(false, $idTheme);
            }
        } else {
            echo '<li>Id theme not found in get parameter. <a href="admin.php">Go back<a></li>';
        }
    }

    public function deleteQuestion ($config) {
        $questionModel = new QuestionModel();
        $answerModel = new AnswerModel();
        if(isset($_GET['idQuestion'])) {
            $idQuestion = $_GET['idQuestion'];
            $questionModel->deleteQuestion($config, $idQuestion);
            if (isset($_GET['idTheme'])) {
                $idTheme = 'idTheme='.$_GET['idTheme'];
                $action = 'showList';
            } else {
                $idTheme = '';
                $action = 'showNewQuestions';
            }
            
            $answerModel->deleteAnswer($config, $idQuestion);
            header("location: admin.php?controller=Questions&action={$action}{$idTheme}");
        }
    }

    public function deleteQuestionOfTheme ($config) {
        $questionModel = new QuestionModel();
        $answerModel = new AnswerModel();
        $idTheme = $_GET['idTheme'];
        $listQuestions = $questionModel->getListQuestions($config, $idTheme);
        foreach($listQuestions as $question){
            $idQuestion = $question['id'];
            $questionModel->deleteQuestion($config, $idQuestion);
            $answerModel->deleteAnswer($config, $idQuestion);
        }
    }

    public function addNewQuestion ($config) {
        $questionModel = new QuestionModel();
        if(isset($_GET['idTheme']) && isset($_GET['question']) && isset($_GET['idAuthor'])) {
            $idTheme = $_GET['idTheme'];
            $question = $_GET['question'];
            $idAuthor = $_GET['idAuthor'];
            $res = $questionModel->addNewQuestion($config, $idTheme, $question, $idAuthor);
        }
    }

    public function editQuestion($config) {
        $questionModel = new QuestionModel();
        $answerModel = new AnswerModel();
        $themeModel = new ThemeModel();
        if(isset($_GET['prevPos'])) {
            $prevPos = $_GET['prevPos'];
        }
        if (isset($_GET['idQuestion'])) {
            $idQuestion = $_GET['idQuestion'];
        }
        if (isset($_GET['idTheme'])) {
            $idTheme = $_GET['idTheme'];
        }
        $listThemes = $themeModel->getListThemes($config);
        $idAuthor = $questionModel->getIdAuthorForIdQuestion($config, $idQuestion);
        $nameAuthor = $questionModel->getNameAuthorForIdAuthor($config, $idAuthor);
        $question = $questionModel->getQuestionForId($config, $idQuestion);
        $answer = $answerModel->getAnswerForIdQuestion($config, $idQuestion);
        $questionModel->showEditForm($prevPos, $idAuthor, $nameAuthor, $question, $answer, $idQuestion, $idTheme, $listThemes);

    }

    public function fixEditQuestionAnswerUser($config) {
        if(empty($_GET['question']) || empty($_GET['idQuestion']) || empty($_GET['answer']) || empty($_GET['nameAuthor']) || empty($_GET['idAuthor'])) {
            header("location: admin.php?controller=Questions&action=showList&idTheme={$_GET['idTheme']}#{$_GET['prevPos']}");
            return;
        }
        $questionModel = new QuestionModel();
        $answerModel = new AnswerModel();
        $userModel = new UserModel();
        if(!empty($_GET['question']) && !empty($_GET['idQuestion'])){
            $question = $_GET['question'];
            $idQuestion = $_GET['idQuestion'];
            $res = $questionModel->updateQuestion($config, $idQuestion, $question);
        }
        if(!empty($_GET['answer'])){
            $answer = $_GET['answer'];
            $res = $answerModel->updateAnswer($config, $answer, $idQuestion);
        }
        if(!empty($_GET['nameAuthor']) && !empty($_GET['idAuthor'])){
            $idAuthor = $_GET['idAuthor'];
            $newNameAuthor = $_GET['nameAuthor'];
            $res = $userModel->updateAuthor($config, $newNameAuthor, $idAuthor);
        }
        $newIdTheme = $_GET['newIdTheme'];
        $questionModel->updateIdTheme($config, $idQuestion, $newIdTheme);
        if (!empty($_GET['hidePubl'])) {
            $questionModel->addHidelStatusQuestion($config, $idQuestion);
        } else {
            $questionModel->addPublStatusQuestion($config, $idQuestion);
        }
        if (!empty($_GET['prevPos']) && !empty($_GET['idTheme'])) {
            $prevPos = $_GET['prevPos'];
            $idTheme = $_GET['idTheme'];
            header("location: admin.php?controller=Questions&action=showList&idTheme={$idTheme}#{$prevPos}");
        }
    }

    public function addPublStatusQuestion ($config) {
        $questionModel = new QuestionModel();
        if (isset($_GET['idQuestion'])) {
            $idQuestion = $_GET['idQuestion'];
        }
        $res = $questionModel->addPublStatusQuestion($config, $idQuestion);
        return $res;
    }
    
    public function addHidelStatusQuestion ($config) {
        $questionModel = new QuestionModel();
        if (isset($_GET['idQuestion'])) {
            $idQuestion = $_GET['idQuestion'];
        }
        $res = $questionModel->addHidelStatusQuestion($config, $idQuestion);
        return $res;
    }

    public function addPublStatusQuestionFromList ($config) {
        $questionModel = new QuestionModel();
        if (isset($_GET['idQuestion'])) {
            $idQuestion = $_GET['idQuestion'];
        }
        if (isset($_GET['idTheme'])) {
            $idTheme = $_GET['idTheme'];
        }
        if (isset($_GET['prevPos'])) {
            $prevPos = $_GET['prevPos'];
        }
        $res = $questionModel->addPublStatusQuestion($config, $idQuestion);
        header("location: admin.php?controller=Questions&action=showList&idTheme={$idTheme}#{$prevPos}");
        return $res;
    }

    public function addHidelStatusQuestionFromList ($config) {
        $questionModel = new QuestionModel();
        if (isset($_GET['idQuestion'])) {
            $idQuestion = $_GET['idQuestion'];
        }
        if (isset($_GET['idTheme'])) {
            $idTheme = $_GET['idTheme'];
        }
        if (isset($_GET['prevPos'])) {
            $prevPos = $_GET['prevPos'];
        }
        $res = $questionModel->addHidelStatusQuestion($config, $idQuestion);
        header("location: admin.php?controller=Questions&action=showList&idTheme={$idTheme}#{$prevPos}");
        return $res;
    }

    public function showAllNewQuestions ($config) {
        $questionModel = new QuestionModel();
        $listQuestions = $questionModel->getListAllNewQuestions($config);
        if($listQuestions) {
            $questionModel->renderNew($listQuestions);

        } else {
            $questionModel->renderNew(false);
        }
    }
}

?>