<?php
class AnswerModel {
    public $config;

    public function __construct($config) {
        $this->config = $config;
    }
    
    public function getAnswerForIdQuestion($idQuestion) {
        $tmpSql = "select answer from answers where id_question=?";
        $res = $this->config->makerSqlQuery($tmpSql, ["$idQuestion"]);
        if(isset($res[0]['answer'])) {
            return $res[0]['answer'];
        }
    }

    public function addNewAnswer ($idQuestion, $answer) {
        $tmpSql = "insert into answers(id_question, answer) values(?, ?)";
        $res = $this->config->makerSqlQuery($tmpSql, ["$idQuestion", "$answer"]);
        return $res;
    }

    public function updateAnswer ($answer, $idQuestion) {
        $tmpSql = "update answers set answer = ? where id_question=? limit 1";
        $res = $this->config->makerSqlQuery($tmpSql, ["$answer", "$idQuestion"]);
        return $res;
    }

    public function deleteAnswer ($idQuestion) {
        $tmpSql = "delete from answers where id_question=?";
        $res = $this->config->makerSqlQuery($tmpSql, ["$idQuestion"]);
        return $res;
    }

    public function showEditFormAnswer ($prevPos, $idQuestion, $idTheme) {
        if(!$idTheme) {
            $action = 'showNewQuestions';
            $idTheme = '';
            
        } else {
            $action = 'showList';
            $strIdTheme = '&idTheme='.$idTheme;
            
        }
        require_once 'view/admin/addNewAnswer.php';
    }

}