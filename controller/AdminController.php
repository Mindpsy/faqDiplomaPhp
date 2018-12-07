<?php 

class AdminController {
public $config, $adminModel;

    public function __construct($config) {
        $this->config = $config;
        $this->adminModel = new AdminModel($this->config);
    }
    public function showAuthForm () {
        $this->adminModel->showAuthForm();
    }

    public function authorise () {
        if(!empty($_POST['login']) && !empty($_POST['pass'])) {
            $res = $this->adminModel->login($_POST['login'], $_POST['pass']);
            if(!empty($res)) {
                header('location: admin.php?controller=themes&action=showList');
            } else {
                $this->adminModel->showAuthForm('Неверный логин или пароль!');
            }

        } else {
            $this->adminModel->showAuthForm('Заполните поля для входа!');
        }

    }

    public function exitAcc () {
        $this->adminModel->exitAcc();
        header ('location: admin.php');
    }

    public function showListAdmins () {
        $list = $this->adminModel->getListAdmins();
        if($list) {
            $this->adminModel->render($list);
        }
    }

    public function fillFormNewAdmin () {
        $this->adminModel->showCreateAdminForm();

    }

    public function fixEditionNewAdmin () {
        if(empty($_GET['nameAdmin']) || empty($_GET['login']) || empty($_GET['email']) || empty($_GET['password'])) {
            $this->adminModel->showCreateAdminForm();
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
        $resLog = $this->adminModel->isLoginExist($login);
        if (!$resLog) {
            
            $this->adminModel->createNewAdmin($name, $login, $email, $password);
            header('location: admin.php?controller=admins&action=showList');
        } else {
            $true = 'true';
            $this->adminModel->showCreateAdminForm($name, $login, $email, $password, $true);
        }

    }

    public function deleteAdmin () {
        if(isset($_GET['idAdmin'])) {
            $idAdmin = $_GET['idAdmin'];
            $this->adminModel->deleteAdmin($idAdmin);
            header('location: admin.php?controller=admins&action=showList');
        } else {
            echo '<li>Do not set parameter - idAdmin</i>';
        }
    }

    public function toEditAdmin () {
        if(isset($_GET['idAdmin'])) {
            $idAdmin = $_GET['idAdmin'];
            $admin = $this->adminModel->getAdminDataForId($idAdmin);
            if(isset($admin)){
                $this->adminModel->showEditAdminForm($idAdmin, $admin[0]['name'], $admin[0]['email'], $admin[0]['password']);
            }
        } else {
            echo '<li>Do not set parameter - idAdmin</i>';
        }
    }

    public function fixEditAdmin () {
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
            $this->adminModel->showEditAdminForm($idAdmin, $name, $email, $password);
            return;
        }

        $this->adminModel->updateAdmin($idAdmin, $name, $email, $password);
        header('location: admin.php?controller=admins&action=showList');
    }
}