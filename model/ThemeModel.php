<?php 
class ThemeModel {
    public $config;

    public function __construct($config) {
        $this->config = $config;
    }
    public function getListThemes () {
        $tmpSql = "select id, name from themes";
        $res = $this->config->makerSqlQuery($tmpSql);
        return $res;

    }

    public function render ($list, $questionModel) {
        $config = $this->config;
        require_once "view/admin/listThemes.php";
    }

    public function showFeldNewTheme () {
        require_once "view/admin/createNewTheme.php";

    }

    public function addNewTheme ($nameTheme) {
        $tmpSql = "insert into themes(name) values(?)";
        $res = $this->config->makerSqlQuery($tmpSql, ["$nameTheme"]);
        return $res;
    }

    public function delTheme ($idTheme) {
        $tmpSql = "delete from themes where id=?";
        $res = $this->config->makerSqlQuery($tmpSql, ["$idTheme"]);
        return $res;
    }

    
}