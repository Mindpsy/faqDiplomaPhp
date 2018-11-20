<?php 
class ThemeModel {
    public function getListThemes ($config) {
        $tmpSql = "select id, name from themes";
        $res = $config->makerSqlQuery($tmpSql);
        return $res;

    }

    public function render ($list, $config, $questionModel) {
        require_once "view/admin/listThemes.php";
    }

    public function showFeldNewTheme () {
        require_once "view/admin/createNewTheme.php";

    }

    public function addNewTheme ($config, $nameTheme) {
        $tmpSql = "insert into themes(name) values(?)";
        $res = $config->makerSqlQuery($tmpSql, ["$nameTheme"]);
        return $res;
    }

    public function delTheme ($config, $idTheme) {
        $tmpSql = "delete from themes where id=?";
        $res = $config->makerSqlQuery($tmpSql, ["$idTheme"]);
        return $res;
    }

    
}
?>