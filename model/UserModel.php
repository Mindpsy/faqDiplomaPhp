<?php 

class UserModel {

public $config;

public function __construct($config) {
    $this->config = $config;
}

    public function addNewUser ($name, $email) {
        $tmpSql = "insert into users(name, email) values(?, ?)";
        $res = $this->config->makerSqlQuery($tmpSql, ["$name", "$email"]);
        $tmpSql2 = "select id from users where name=? and email=?";
        $res2 = $this->config->makerSqlQuery($tmpSql2, ["$name", "$email"]);
        return $res2[0]['id'];
    }

    public function updateAuthor ($newNameAuthor, $idAuthor) {
        $tmpSql = "update users set name = ? where id=? limit 1";
        $res = $this->config->makerSqlQuery($tmpSql, ["$newNameAuthor", "$idAuthor"]);
        return $res;
    }
    
    public function showAddForm ($listThemes) { 
        require_once 'view/client/addQuestion.php';
    }

}