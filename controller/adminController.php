<?php 
require_once "model/adminModel.php";

class adminController {
    public function showAuthForm () {
        $adminModel = new AdminModel();
        $adminModel->showAuthForm();
    }

    public function authorise ($config) {
        $adminModel = new adminModel();
        if(!empty($_GET['login']) && !empty($_GET['pass'])) {
            $res = $adminModel->login($config, $_GET['login'], $_GET['pass']);
            if(!empty($res)) {
                header('location: admin.php?controller=themes&action=showList');
            } else {
                $adminModel->showAuthForm('Неверный логин или пароль!');
            }

        } else {
            $adminModel->showAuthForm('Заполните поля для входа!');
        }

    }

    public function exitAcc () {
        $adminModel = new adminModel();
        $adminModel->exitAcc();
        header ('location: admin.php');
    }

    public function showListAdmins ($config) {
        $adminModel = new adminModel();
        $list = $adminModel->getListAdmins($config);
        if($list) {
            $adminModel->render($list);
        }
    }

    public function fillFormNewAdmin () {
        $adminModel = new adminModel();
        $adminModel->showCreateAdminForm();

    }

    public function fixEditionNewAdmin ($config) {
        $adminModel = new adminModel();
        if(empty($_GET['nameAdmin']) || empty($_GET['login']) || empty($_GET['email']) || empty($_GET['password'])) {
            $adminModel->showCreateAdminForm();
            return;
        }
        if(isset($_GET['nameAdmin'])) {
            $name = $_GET['nameAdmin'];
        }
        if(isset($_GET['login'])) {
            $login = $_GET['login'];
        }
        if(isset($_GET['email'])) {
            $email = $_GET['email'];
        }
        if(isset($_GET['password'])) {
            $password = $_GET['password'];
        }
        $resLog = $adminModel->isLoginExist($config, $login);
        if (!$resLog) {
            
            $adminModel->createNewAdmin($config, $name, $login, $email, $password);
            header('location: admin.php?controller=admins&action=showList');
        } else {
            $true = 'true';
            $adminModel->showCreateAdminForm($name, $login, $email, $password, $true);
        }

    }

    public function deleteAdmin ($config) {
        $adminModel = new adminModel();
        if(isset($_GET['idAdmin'])) {
            $idAdmin = $_GET['idAdmin'];
            $adminModel->deleteAdmin($config, $idAdmin);
            header('location: admin.php?controller=admins&action=showList');
        } else {
            echo '<li>Do not set parameter - idAdmin</i>';
        }
    }

    public function toEditAdmin ($config) {
        $adminModel = new adminModel();
        if(isset($_GET['idAdmin'])) {
            $idAdmin = $_GET['idAdmin'];
            $admin = $adminModel->getAdminDataForId($config, $idAdmin);
            if(isset($admin)){
                $adminModel->showEditAdminForm($idAdmin, $admin[0]['name'], $admin[0]['email'], $admin[0]['password']);
            }
        } else {
            echo '<li>Do not set parameter - idAdmin</i>';
        }
    }

    public function fixEditAdmin ($config) {
        $adminModel = new adminModel();

        if(isset($_GET['nameAdmin'])) {
            $name = $_GET['nameAdmin'];
        }
        if(isset($_GET['email'])) {
            $email = $_GET['email'];
        }
        if(isset($_GET['password'])) {
            $password = $_GET['password'];
        }
        if (isset($_GET['idAdmin'])) {
            $idAdmin = $_GET['idAdmin'];
        }
        if(empty($_GET['nameAdmin']) || empty($_GET['email']) || empty($_GET['password'])) {
            $adminModel->showEditAdminForm($idAdmin, $name, $email, $password);
            return;
        }

        $adminModel->updateAdmin($config, $idAdmin, $name, $email, $password);
        header('location: admin.php?controller=admins&action=showList');
    }
}

?>