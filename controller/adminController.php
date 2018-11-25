<?php 
require_once "model/AdminModel.php";

class AdminController {
    public $config;

    public function __construct($config) {
        $this->config = $config;
    }
    public function showAuthForm () {
        $adminModel = new AdminModel($this->config);
        $adminModel->showAuthForm();
    }

    public function authorise () {
        $adminModel = new AdminModel($this->config);
        if(!empty($_GET['login']) && !empty($_GET['pass'])) {
            $res = $adminModel->login($_GET['login'], $_GET['pass']);
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
        $adminModel = new AdminModel($this->config);
        $adminModel->exitAcc();
        header ('location: admin.php');
    }

    public function showListAdmins () {
        $adminModel = new AdminModel($this->config);
        $list = $adminModel->getListAdmins();
        if($list) {
            $adminModel->render($list);
        }
    }

    public function fillFormNewAdmin () {
        $adminModel = new AdminModel($this->config);
        $adminModel->showCreateAdminForm();

    }

    public function fixEditionNewAdmin () {
        $adminModel = new AdminModel($this->config);
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
        $resLog = $adminModel->isLoginExist($login);
        if (!$resLog) {
            
            $adminModel->createNewAdmin($name, $login, $email, $password);
            header('location: admin.php?controller=admins&action=showList');
        } else {
            $true = 'true';
            $adminModel->showCreateAdminForm($name, $login, $email, $password, $true);
        }

    }

    public function deleteAdmin () {
        $adminModel = new AdminModel($this->config);
        if(isset($_GET['idAdmin'])) {
            $idAdmin = $_GET['idAdmin'];
            $adminModel->deleteAdmin($idAdmin);
            header('location: admin.php?controller=admins&action=showList');
        } else {
            echo '<li>Do not set parameter - idAdmin</i>';
        }
    }

    public function toEditAdmin () {
        $adminModel = new AdminModel($this->config);
        if(isset($_GET['idAdmin'])) {
            $idAdmin = $_GET['idAdmin'];
            $admin = $adminModel->getAdminDataForId($idAdmin);
            if(isset($admin)){
                $adminModel->showEditAdminForm($idAdmin, $admin[0]['name'], $admin[0]['email'], $admin[0]['password']);
            }
        } else {
            echo '<li>Do not set parameter - idAdmin</i>';
        }
    }

    public function fixEditAdmin () {
        $adminModel = new AdminModel($this->config);

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

        $adminModel->updateAdmin($idAdmin, $name, $email, $password);
        header('location: admin.php?controller=admins&action=showList');
    }
}