<?php 
class QuestionModel {
    public function getListQuestions ($config, $idTheme) {
        $tmpSql = 'select id, date_create, id_author, status, question from questions where id_theme=?';
        $resList = $config->makerSqlQuery($tmpSql, ["$idTheme"]);
        return $resList;

    }

    public function getListPublQuestions ($config, $idTheme) {
        $tmpSql = 'select id, date_create, id_author, status, question from questions where id_theme=? and status=1';
        $resList = $config->makerSqlQuery($tmpSql, ["$idTheme"]);
        return $resList;

    }

    public function getListAllNewQuestions ($config) {
        $tmpSql = 'select id, date_create, id_author, status, question from questions where status=0 order by date_create';
        $resList = $config->makerSqlQuery($tmpSql);
        return $resList;

    }

    public function render ($listQuestions, $idTheme) {
        require_once 'view/admin/listQuestions.php';

    }

    public function renderNew ($listQuestions) {
        require_once 'view/admin/listNewQuestions.php';

    }

    public function addNewQuestion ($config, $idTheme, $question, $idAuthor) {
        $nowDate = date('Y.m.d');
        $tmpSql = "insert into questions(id_theme, date_create, id_author, status, question) values(?, ?, ?, 0, ?)";
        $res = $config->makerSqlQuery($tmpSql, ["$idTheme", "$nowDate", "$idAuthor", "$question"]);
        return $res;
    }

    public function deleteQuestion ($config, $idQuestion) {
        $tmpSql = "delete from questions where id=? limit 1";
        $res = $config->makerSqlQuery($tmpSql, ["$idQuestion"]);
        return $res;
    }

    public function showEditForm($prevPos, $idAuthor, $nameAuthor, $question, $answer, $idQuestion, $idTheme, $listThemes) {
        require_once 'view/admin/editQuestion.php';

    }

    public function getIdAuthorForIdQuestion ($config, $idQuestion) {
        $tmpSql = "select id_author from questions where id=?";
        $res = $config->makerSqlQuery($tmpSql, ["$idQuestion"]);
        return $res[0]['id_author'];
    }

    public function getNameAuthorForIdAuthor ($config, $idAuthor) {
        $tmpSql = "select name from users where id=?";
        $res = $config->makerSqlQuery($tmpSql, ["$idAuthor"]);
        if (isset($res[0]['name'])) {
            return $res[0]['name'];
        }
        
    }

    public function getQuestionForId ($config, $idQuestion) {
        $tmpSql = "select question from questions where id=?";
        $res = $config->makerSqlQuery($tmpSql, ["$idQuestion"]);
        if (isset($res[0]['question'])) {
            return $res[0]['question'];
        }
    }

    public function updateQuestion ($config, $idQuestion, $question) {
        $tmpSql = "update questions set question = ? where id=? limit 1";
        $res = $config->makerSqlQuery($tmpSql, ["$question", "$idQuestion"]);
        return $res;
    }

    public function getCountQuestion ($config, $idTheme) {
        $tmpSql = "select count(*) as summ from questions where id_theme=?";
        $res = $config->makerSqlQuery($tmpSql, ["$idTheme"]);
        if (isset($res[0]['summ'])) {
            return $res[0]['summ'];
        }
        return 0;
    }

    public function getCountPublQuestion ($config, $idTheme) {
        $tmpSql = "select count(*) as summ from questions where id_theme=? and status=1";
        $res = $config->makerSqlQuery($tmpSql, ["$idTheme"]);
        if (isset($res[0]['summ'])) {
            return $res[0]['summ'];
        }
        return 0;
    }

    public function getCountDontPublQuestion ($config, $idTheme) {
        $tmpSql = "select count(*) as summ from questions where id_theme=? and status=0";
        $res = $config->makerSqlQuery($tmpSql, ["$idTheme"]);
        if (isset($res[0]['summ'])) {
            return $res[0]['summ'];
        }
        return 0;
    }

    public function addPublStatusQuestion ($config, $idQuestion) {
        $tmpSql = "update questions set status=1 where id=?";
        $res = $config->makerSqlQuery($tmpSql, ["$idQuestion"]);
        return $res;
    }

    public function addHidelStatusQuestion ($config, $idQuestion) {
        $tmpSql = "update questions set status=2 where id=?";
        $res = $config->makerSqlQuery($tmpSql, ["$idQuestion"]);
        return $res;
    }

    public function updateIdTheme ($config, $idQuestion, $newIdTheme) {
        $tmpSql = "update questions set id_theme=? where id=?";
        $resList = $config->makerSqlQuery($tmpSql, ["$newIdTheme", "$idQuestion"]);
        return $resList;
    }

    
}
?>