<?php 
class QuestionModel {
    public $config;

    public function __construct($config) {
        $this->config = $config;
    }
    public function getListQuestions ($idTheme) {
        $tmpSql = 'select id, date_create, id_author, status, question from questions where id_theme=?';
        $resList = $this->config->makerSqlQuery($tmpSql, ["$idTheme"]);
        return $resList;

    }

    public function getListPublQuestions ($idTheme) {
        $tmpSql = 'select id, date_create, id_author, status, question from questions where id_theme=? and status=1';
        $resList = $this->config->makerSqlQuery($tmpSql, ["$idTheme"]);
        return $resList;

    }

    public function getListAllNewQuestions () {
        $tmpSql = 'select id, date_create, id_author, status, question from questions where status=0 order by date_create';
        $resList = $this->config->makerSqlQuery($tmpSql);
        return $resList;

    }

    public function render ($listQuestions, $idTheme) {
        require_once 'view/admin/listQuestions.php';

    }

    public function renderNew ($listQuestions) {
        require_once 'view/admin/listNewQuestions.php';

    }

    public function addNewQuestion ($idTheme, $question, $idAuthor) {
        $nowDate = date('Y.m.d');
        $tmpSql = "insert into questions(id_theme, date_create, id_author, status, question) values(?, ?, ?, 0, ?)";
        $res = $this->config->makerSqlQuery($tmpSql, ["$idTheme", "$nowDate", "$idAuthor", "$question"]);
        return $res;
    }

    public function deleteQuestion ($idQuestion) {
        $tmpSql = "delete from questions where id=? limit 1";
        $res = $this->config->makerSqlQuery($tmpSql, ["$idQuestion"]);
        return $res;
    }

    public function showEditForm($prevPos, $idAuthor, $nameAuthor, $question, $answer, $idQuestion, $idTheme, $listThemes) {
        require_once 'view/admin/editQuestion.php';

    }

    public function getIdAuthorForIdQuestion ($idQuestion) {
        $tmpSql = "select id_author from questions where id=?";
        $res = $this->config->makerSqlQuery($tmpSql, ["$idQuestion"]);
        return $res[0]['id_author'];
    }

    public function getNameAuthorForIdAuthor ($idAuthor) {
        $tmpSql = "select name from users where id=?";
        $res = $this->config->makerSqlQuery($tmpSql, ["$idAuthor"]);
        if (isset($res[0]['name'])) {
            return $res[0]['name'];
        }
        
    }

    public function getQuestionForId ($idQuestion) {
        $tmpSql = "select question from questions where id=?";
        $res = $this->config->makerSqlQuery($tmpSql, ["$idQuestion"]);
        if (isset($res[0]['question'])) {
            return $res[0]['question'];
        }
    }

    public function updateQuestion ($idQuestion, $question) {
        $tmpSql = "update questions set question = ? where id=? limit 1";
        $res = $this->config->makerSqlQuery($tmpSql, ["$question", "$idQuestion"]);
        return $res;
    }

    public function getCountQuestion ($idTheme) {
        $tmpSql = "select count(*) as summ from questions where id_theme=?";
        $res = $this->config->makerSqlQuery($tmpSql, ["$idTheme"]);
        if (isset($res[0]['summ'])) {
            return $res[0]['summ'];
        }
        return 0;
    }

    public function getCountPublQuestion ($idTheme) {
        $tmpSql = "select count(*) as summ from questions where id_theme=? and status=1";
        $res = $this->config->makerSqlQuery($tmpSql, ["$idTheme"]);
        if (isset($res[0]['summ'])) {
            return $res[0]['summ'];
        }
        return 0;
    }

    public function getCountDontPublQuestion ($idTheme) {
        $tmpSql = "select count(*) as summ from questions where id_theme=? and status=0";
        $res = $this->config->makerSqlQuery($tmpSql, ["$idTheme"]);
        if (isset($res[0]['summ'])) {
            return $res[0]['summ'];
        }
        return 0;
    }

    public function addPublStatusQuestion ($idQuestion) {
        $tmpSql = "update questions set status=1 where id=?";
        $res = $this->config->makerSqlQuery($tmpSql, ["$idQuestion"]);
        return $res;
    }

    public function addHidelStatusQuestion ($idQuestion) {
        $tmpSql = "update questions set status=2 where id=?";
        $res = $this->config->makerSqlQuery($tmpSql, ["$idQuestion"]);
        return $res;
    }

    public function updateIdTheme ($idQuestion, $newIdTheme) {
        $tmpSql = "update questions set id_theme=? where id=?";
        $resList = $this->config->makerSqlQuery($tmpSql, ["$newIdTheme", "$idQuestion"]);
        return $resList;
    }

    
}