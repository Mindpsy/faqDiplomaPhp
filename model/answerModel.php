<?php
class AnswerModel {
    public function getAnswerForIdQuestion($config, $idQuestion) {
        $tmpSql = "select answer from answers where id_question=?";
        $res = $config->makerSqlQuery($tmpSql, ["$idQuestion"]);
        if(isset($res[0]['answer'])) {
            return $res[0]['answer'];
        }
    }

    public function addNewAnswer ($config, $idQuestion, $answer) {
        $tmpSql = "insert into answers(id_question, answer) values(?, ?)";
        $res = $config->makerSqlQuery($tmpSql, ["$idQuestion", "$answer"]);
        return $res;
    }

    public function updateAnswer ($config, $answer, $idQuestion) {
        $tmpSql = "update answers set answer = ? where id_question=? limit 1";
        $res = $config->makerSqlQuery($tmpSql, ["$answer", "$idQuestion"]);
        return $res;
    }

    public function deleteAnswer ($config, $idQuestion) {
        $tmpSql = "delete from answers where id_question=?";
        $res = $config->makerSqlQuery($tmpSql, ["$idQuestion"]);
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
?>