<?php 

class UserModel {

    public function addNewUser ($config, $name, $email) {
        $tmpSql = "insert into users(name, email) values(?, ?)";
        $res = $config->makerSqlQuery($tmpSql, ["$name", "$email"]);
        $tmpSql2 = "select id from users where name=? and email=?";
        $res2 = $config->makerSqlQuery($tmpSql2, ["$name", "$email"]);
        return $res2[0]['id'];
    }

    public function updateAuthor ($config, $newNameAuthor, $idAuthor) {
        $tmpSql = "update users set name = ? where id=? limit 1";
        $res = $config->makerSqlQuery($tmpSql, ["$newNameAuthor", "$idAuthor"]);
        return $res;
    }
    
    public function showAddForm ($listThemes) { 
        require_once 'view/client/addQuestion.php';
    }

}
?>