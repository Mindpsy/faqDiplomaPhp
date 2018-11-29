<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Новые вопросы</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/png" href="favicon.png" />
</head>

<body>
    <!-- <div class="navbar-fixed"> -->
        <nav>
            <div class="nav-wrapper">
                <a href="#" class="brand-logo">Logo</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="admin.php?controller=admins&action=showList">Администраторы</a></li>
                    <li><a href="admin.php?controller=themes&action=showList">Темы</a></li>
                    <li class="active"><a href="admin.php?controller=Questions&action=showNewQuestions">Новые вопросы</a></li>
                    <li><a href="admin.php?controller=admins&action=exitAcc">Выход</a></li>
                </ul>
            </div>
        </nav>

        <ul class="sidenav" id="mobile-demo">
            <li><a href="admin.php?controller=admins&action=showList">Администраторы</a></li>
            <li><a href="admin.php?controller=themes&action=showList">Темы</a></li>
            <li class="active"><a href="admin.php?controller=Questions&action=showNewQuestions">Новые вопросы</a></li>
            <li><a href="admin.php?controller=admins&action=exitAcc">Выход</a></li>
        </ul>
    <!-- </div> -->

    <main> <!-- Выводим циклом вопросы -->
        <div class="container">
            <?php if($listQuestions): ?>
                    <?php foreach($listQuestions as $item): 
                        $idQuestion = $item['id']; ?>
                        <!-- если не опубликован то выдаем один набор упраляющих ссылок -->
                <div class="row">
                    <div class="col s12 m12 l12 lx12" id="name<?=$idQuestion;?>">
                        <div class="card grey darken-2">
                            <div class="card-content white-text">
                                <span class="card-title"><?=$item['question']?></span>
                                <p> Дата создания: <?=$item['date_create']?> Статус: <?=($item['status'] == 1) ? 'Опубликован' : (($item['status'] == 2) ? 'Скрыт' : 'Ждет публикации')?></p>
                            </div>
                            <div class="card-action">
                                <a href="admin.php?controller=answers&action=editNewAnswer&idQuestion=<?=$idQuestion?>&prevPos=name<?=$idQuestion?>">Добавить ответ</a>
                                <a href="admin.php?controller=Questions&action=delete&idQuestion=<?=$idQuestion?>">Удалить вопрос</a>
                            </div>
                        </div>
                    </div>
                </div>
                    <?php endforeach;?>
            <?php else: ?>
            <div class="row">
                <div class="col s12 m12 l12 lx12"><p>В системе не найдены новые вопросы.</p></div>
            </div>

            <?php endif;?>
        </div>
    </main>

    <footer class="page-footer">
        <div class="footer-copyright">
            <div class="container">
                © 2018 Copyright Text
                <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
            </div>
        </div>
    </footer>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems, {});});
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems, {});
    });
    </script>

    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>