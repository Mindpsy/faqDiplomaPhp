<?php 

class AdminModel {
    public $config;

    public function __construct($config) {
        $this->config = $config;
    }

    public function login ($login, $password) {
        $sqlLogin = "SELECT id, name, email, login FROM admins WHERE login=? AND password=?";
        $res = $this->config->makerSqlQuery($sqlLogin, ["$login", "$password"]);
        if($res) {
            $_SESSION['login'] = $res[0]['login'];
            $_SESSION['authStatus'] = 'true';
            $_SESSION['user_id'] = $res[0]['id'];
        }
        return $res;
    }

    public function exitAcc () {
        session_destroy();
        
    }

    public function render($list) {
        require_once 'view/admin/listAdmins.php';
    }

    public function getListAdmins() {
        $tmpSql = 'select * from admins';
        $res = $this->config->makerSqlQuery($tmpSql);
        return $res;
    }

    public function showCreateAdminForm ($name = '', $login = '', $email = '', $password = '', $true = 'false') {
        require_once "view/admin/editNewAdmin.php";
        
    }
    public function isLoginExist ($login) {
        $tmpSql = 'select id from admins where login=?';
        $res = $this->config->makerSqlQuery($tmpSql, ["$login"]);
        return $res;
    }

    public function createNewAdmin ($name, $login, $email, $password) {
        $tmpSql = 'insert into admins(name, login, email, password) values(?, ?, ?, ?)';
        $res = $this->config->makerSqlQuery($tmpSql, ["$name", "$login", "$email", "$password"]);
        return $res;
    }

    public function deleteAdmin ($idAdmin) {
        $tmpSql = 'delete from admins where id=?';
        $res = $this->config->makerSqlQuery($tmpSql, ["$idAdmin"]);
        return $res;
    }

    public function getAdminDataForId ($idAdmin) {
        $tmpSql = 'select * from admins where id=?';
        $res = $this->config->makerSqlQuery($tmpSql, ["$idAdmin"]);
        return $res;
    }

    public function showEditAdminForm ($idAdmin = '', $name = '', $email = '', $password = '', $true = 'false') {
        require_once "view/admin/editAdmin.php";
        
    }

    public function updateAdmin ($idAdmin, $name, $email, $password) {
        $tmpSql = "update admins set name=?, email=?, password=? where id=?";
        $res = $this->config->makerSqlQuery($tmpSql, ["$name", "$email", "$password", "$idAdmin"]);
        return $res;
    }

    public function createBaseAdmin ($name, $login, $email, $password) {
        $tmpSql = 'insert into admins(name, login, email, password) values(?, ?, ?, ?)';
        $res = $this->config->makerSqlQuery($tmpSql, ["$name", "$login", "$email", "$password"]);
        return $res;
    }

    public function showAuthForm ($wrong = '') {
        require_once "view/admin/signin.php";
    }
}