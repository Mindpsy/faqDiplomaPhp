<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Темы</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
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
                    <li><a href="admin.php?controller=Questions&action=showNewQuestions">Новые вопросы</a></li>
                    <li><a href="admin.php?controller=admins&action=exitAcc">Выход</a></li>
                </ul>
            </div>
        </nav>

        <ul class="sidenav" id="mobile-demo">
            <li><a href="admin.php?controller=admins&action=showList">Администраторы</a></li>
            <li><a href="admin.php?controller=themes&action=showList">Темы</a></li>
            <li><a href="admin.php?controller=Questions&action=showNewQuestions">Новые вопросы</a></li>
            <li><a href="admin.php?controller=admins&action=exitAcc">Выход</a></li>
        </ul>
    <!-- </div> -->

    <main> <!-- Выводим циклом вопросы -->
        <div class="container">
            <?php if($listQuestions): ?>
                <?php foreach($listQuestions as $item): ?>
                    <?php $idQuestion = $item['id']; ?>
                    <?php if ($item['status'] == 0): ?>
                    <!-- если не опубликован то выдаем один набор упраляющих ссылок -->
            <div class="row">
                <div class="col s12 m12 l12 lx12" id="name<?=$idQuestion;?>">
                    <div class="card grey darken-2">
                        <div class="card-content white-text">
                            <span class="card-title"><?=$item['question']?></span>
                            <p> Дата создания: <?=$item['date_create']?> Статус: <?=($item['status'] == 1) ? 'Опубликован' : (($item['status'] == 2) ? 'Скрыт' : 'Ждет публикации')?></p>
                        </div>
                        <div class="card-action">
                            <a href="admin.php?controller=answers&action=editNewAnswer&idQuestion=<?=$idQuestion?>&prevPos=name<?=$idQuestion?>&idTheme=<?=$idTheme;?>">Добавить ответ</a>
                            <a href="admin.php?controller=Questions&action=delete&idQuestion=<?=$idQuestion?>&idTheme=<?=$idTheme;?>">Удалить вопрос</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- если статус другой то более расширенный набор управляющих ссылок -->
                    <?php else: ?>
                        <?php $status = $item['status'];?>
            <div class="row">
                <div class="col s12 m12 l12 lx12" id="name<?=$item['id']?>">
                    <div class="card grey darken-2">
                        <div class="card-content white-text">
                            <span class="card-title"><?=$item['question']?></span>
                            <p> Дата создания: <?=$item['date_create']?> Статус: <?=($item['status'] == 1) ? 'Опубликован' : (($item['status'] == 2) ? 'Скрыт' : 'Ждет публикации')?></p>
                        </div>
                        <div class="card-action">
                            <a href="admin.php?controller=Questions&action=edit&idQuestion=<?=$idQuestion?>&prevPos=name<?=$idQuestion?>&idTheme=<?=$idTheme;?>&status=<?=$status?>">Редактировать</a>
                        <?php if ($item['status'] == 1): ?>
                            <a href="admin.php?controller=Questions&action=toHideQuestion&idQuestion=<?=$idQuestion?>&idTheme=<?=$idTheme;?>&prevPos=name<?=$item['id']?>">Скрыть</a>
                        <?php elseif ($item['status'] == 2): ?>
                            <a href="admin.php?controller=Questions&action=toPublQuestion&idQuestion=<?=$idQuestion?>&idTheme=<?=$idTheme;?>&prevPos=name<?=$item['id']?>">Опубликовать</a>
                        <?php endif; ?>
                            <a href="admin.php?controller=Questions&action=delete&idQuestion=<?=$idQuestion?>&idTheme=<?=$idTheme;?>">Удалить вопрос</a>
                        </div>
                    </div>
                </div>
            </div>  <?php endif; ?>
                <?php endforeach; ?>

            <?php else: ?>
                <div class="row">
                    <div class="col s12 m12 l12 lx12"><p>В теме не найдены вопросы.</p></div>
                </div>
            <?php endif; ?>
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