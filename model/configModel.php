<?php 

$config = new ConfigModel('localhost', 'faqData', 'root', '');
$config->connectDataBase();

class ConfigModel {
    public $host, $dbname, $login, $password, $pdo;

    public $createTableUsers = "CREATE TABLE IF NOT EXISTS `users` (
                                    `id` int NOT NULL AUTO_INCREMENT, 
                                    `name` varchar(50) NULL, 
                                    `email` varchar(50) NULL, 
                                    PRIMARY KEY (`id`)
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

    public $createTableAdmins = "CREATE TABLE IF NOT EXISTS `admins` (
                                `id` int NOT NULL AUTO_INCREMENT, 
                                `name` varchar(50) NULL, 
                                `email` varchar(50) NULL, 
                                `login` varchar(50) NULL, 
                                `password` varchar(50) NULL,
                                PRIMARY KEY (`id`)
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

    public $createTableThemes = "CREATE TABLE IF NOT EXISTS `themes` (
                                `id` int NOT NULL AUTO_INCREMENT, 
                                `name` varchar(120) NULL, 
                                PRIMARY KEY (`id`)
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

    public $createTableQuestions = "CREATE TABLE IF NOT EXISTS `questions` (
                                `id` int NOT NULL AUTO_INCREMENT, 
                                `id_theme` int(50) NULL, 
                                `date_create` varchar(50) NULL DEFAULT NULL, 
                                `id_author` int(50) NULL, 
                                `status` tinyint(4) NOT NULL DEFAULT '0', 
                                `question` varchar(500) NULL,
                                PRIMARY KEY (`id`)
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

    public $createTableAnswers = "CREATE TABLE IF NOT EXISTS `answers` (
                                `id` int NOT NULL AUTO_INCREMENT, 
                                `id_question` int(50) NULL, 
                                `answer` varchar(3000) NULL, 
                                PRIMARY KEY (`id`)
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

    public function __construct ($tmpHost, $tmpDbname, $tmpLogin, $tmpPassword) {
        $this->host = $tmpHost;
        $this->dbname = $tmpDbname;
        $this->login = $tmpLogin;
        $this->password = $tmpPassword;
    }

    public function connectDataBase () {
        $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->login, $this->password);
        return $this->pdo;
    }

    public function makerSqlQuery ($sql, $prePar=['']) {
        // dumper("sql");
        // dumper($sql);
        // dumper("prePar");
        // dumper($prePar);
        try 
        {
            $sth = $this->pdo->prepare($sql);
            $rres = $sth->execute($prePar);
            if (!$rres) {
                echo '\nPDO::errorInfo():\n';
                dumper($sth->errorInfo());
            }
            // dumper("resexecute");
            // dumper($rres);
            $res = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOException $e) {
            echo 'Ошибка запроса: </br>';
            dumper($e);
        }
        
    }
}