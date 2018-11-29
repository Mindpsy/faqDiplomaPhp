<?php 

class QuestionsController {

    public $config, $questionModel, $answerModel, $userModel;

    public function __construct($config) {
        $this->config = $config;
        $this->questionModel = new QuestionModel($this->config);
        $this->answerModel = new AnswerModel($this->config);
        $this->userModel = new UserModel($this->config);
    }

    public function showQuestionsOfTheme () {
        if(isset($_GET['idTheme'])) {
            $idTheme = $_GET['idTheme'];
            $listQuestions = $this->questionModel->getListQuestions($idTheme);
            if($listQuestions) {
                $this->questionModel->render($listQuestions, $idTheme);
    
            } else {
                $this->questionModel->render(false, $idTheme);
            }
        } else {
            echo '<li>Id theme not found in get parameter. <a href="admin.php">Go back<a></li>';
        }
    }

    public function deleteQuestion () {
        if(isset($_GET['idQuestion'])) {
            $idQuestion = $_GET['idQuestion'];
            $this->questionModel->deleteQuestion($idQuestion);
            if (isset($_GET['idTheme'])) {
                $idTheme = 'idTheme='.$_GET['idTheme'];
                $action = 'showList';
            } else {
                $idTheme = '';
                $action = 'showNewQuestions';
            }
            
            $this->answerModel->deleteAnswer($idQuestion);
            header("location: admin.php?controller=Questions&action={$action}&{$idTheme}");
        }
    }

    public function deleteQuestionOfTheme () {
        $idTheme = $_GET['idTheme'];
        $listQuestions = $this->questionModel->getListQuestions($idTheme);
        foreach($listQuestions as $question){
            $idQuestion = $question['id'];
            $this->questionModel->deleteQuestion($idQuestion);
            $this->answerModel->deleteAnswer($idQuestion);
        }
    }

    public function addNewQuestion () {
        if(isset($_GET['idTheme']) && isset($_GET['question']) && isset($_GET['idAuthor'])) {
            $idTheme = $_GET['idTheme'];
            $question = $_GET['question'];
            $idAuthor = $_GET['idAuthor'];
            $res = $this->questionModel->addNewQuestion($idTheme, $question, $idAuthor);
        }
    }

    public function editQuestion() {
        if(isset($_GET['prevPos'])) {
            $prevPos = $_GET['prevPos'];
        }
        if (isset($_GET['idQuestion'])) {
            $idQuestion = $_GET['idQuestion'];
        }
        if (isset($_GET['idTheme'])) {
            $idTheme = $_GET['idTheme'];
        }
        $listThemes = $this->themeModel->getListThemes();
        $idAuthor = $this->questionModel->getIdAuthorForIdQuestion($idQuestion);
        $nameAuthor = $this->questionModel->getNameAuthorForIdAuthor($idAuthor);
        $question = $this->questionModel->getQuestionForId($idQuestion);
        $answer = $this->answerModel->getAnswerForIdQuestion($idQuestion);
        $this->questionModel->showEditForm($prevPos, $idAuthor, $nameAuthor, $question, $answer, $idQuestion, $idTheme, $listThemes);

    }

    public function fixEditQuestionAnswerUser() {
        if(empty($_GET['question']) || empty($_GET['idQuestion']) || empty($_GET['answer']) || empty($_GET['nameAuthor']) || empty($_GET['idAuthor'])) {
            header("location: admin.php?controller=Questions&action=showList&idTheme={$_GET['idTheme']}#{$_GET['prevPos']}");
            return;
        }

        if(!empty($_GET['question']) && !empty($_GET['idQuestion'])){
            $question = $_GET['question'];
            $idQuestion = $_GET['idQuestion'];
            $res = $this->questionModel->updateQuestion($idQuestion, $question);
        }
        if(!empty($_GET['answer'])){
            $answer = $_GET['answer'];
            $res = $this->answerModel->updateAnswer($answer, $idQuestion);
        }
        if(!empty($_GET['nameAuthor']) && !empty($_GET['idAuthor'])){
            $idAuthor = $_GET['idAuthor'];
            $newNameAuthor = $_GET['nameAuthor'];
            $res = $this->userModel->updateAuthor($newNameAuthor, $idAuthor);
        }
        $newIdTheme = $_GET['newIdTheme'];
        $this->questionModel->updateIdTheme($idQuestion, $newIdTheme);
        if (!empty($_GET['hidePubl'])) {
            $this->questionModel->addHidelStatusQuestion($idQuestion);
        } else {
            $this->questionModel->addPublStatusQuestion($idQuestion);
        }
        if (!empty($_GET['prevPos']) && !empty($_GET['idTheme'])) {
            $prevPos = $_GET['prevPos'];
            $idTheme = $_GET['idTheme'];
            header("location: admin.php?controller=Questions&action=showList&idTheme={$idTheme}#{$prevPos}");
        }
    }

    public function addPublStatusQuestion () {
        if (isset($_GET['idQuestion'])) {
            $idQuestion = $_GET['idQuestion'];
        }
        $res = $this->questionModel->addPublStatusQuestion($idQuestion);
        return $res;
    }
    
    public function addHidelStatusQuestion () {
        if (isset($_GET['idQuestion'])) {
            $idQuestion = $_GET['idQuestion'];
        }
        $res = $this->questionModel->addHidelStatusQuestion($idQuestion);
        return $res;
    }

    public function addPublStatusQuestionFromList () {
        if (isset($_GET['idQuestion'])) {
            $idQuestion = $_GET['idQuestion'];
        }
        if (isset($_GET['idTheme'])) {
            $idTheme = $_GET['idTheme'];
        }
        if (isset($_GET['prevPos'])) {
            $prevPos = $_GET['prevPos'];
        }
        $res = $this->questionModel->addPublStatusQuestion($idQuestion);
        header("location: admin.php?controller=Questions&action=showList&idTheme={$idTheme}#{$prevPos}");
        return $res;
    }

    public function addHidelStatusQuestionFromList() {
        if (isset($_GET['idQuestion'])) {
            $idQuestion = $_GET['idQuestion'];
        }
        if (isset($_GET['idTheme'])) {
            $idTheme = $_GET['idTheme'];
        }
        if (isset($_GET['prevPos'])) {
            $prevPos = $_GET['prevPos'];
        }
        $res = $this->questionModel->addHidelStatusQuestion($idQuestion);
        header("location: admin.php?controller=Questions&action=showList&idTheme={$idTheme}#{$prevPos}");
        return $res;
    }

    public function showAllNewQuestions () {
        $listQuestions = $this->questionModel->getListAllNewQuestions();
        if($listQuestions) {
            $this->questionModel->renderNew($listQuestions);

        } else {
            $this->questionModel->renderNew(false);
        }
    }
}