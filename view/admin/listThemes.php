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
    <link rel="icon" type="image/png" href="favicon.png" />
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
                    <li class="active"><a href="admin.php?controller=themes&action=showList">Темы</a></li>
                    <li><a href="admin.php?controller=Questions&action=showNewQuestions">Новые вопросы</a></li>
                    <li><a href="admin.php?controller=admins&action=exitAcc">Выход</a></li>
                </ul>
            </div>
        </nav>

        <ul class="sidenav" id="mobile-demo">
            <li><a href="admin.php?controller=admins&action=showList">Администраторы</a></li>
            <li class="active"><a href="admin.php?controller=themes&action=showList">Темы</a></li>
            <li><a href="admin.php?controller=Questions&action=showNewQuestions">Новые вопросы</a></li>
            <li><a href="admin.php?controller=admins&action=exitAcc">Выход</a></li>
        </ul>
    <!--</div> -->

    <main>
        <div class="container">
            <?php if($list): ?>
                <?php foreach($list as $item): $id = $item['id'];?>
            <div class="row">
                <div class="col s12 m12 l12 lx12">
                    <div class="card blue-grey darken-1">
                        <div class="card-content white-text">
                            <span class="card-title"><?=$item['name'];?></span>
                            <p>всего вопросов: (<?=$questionModel->getCountQuestion($id);?>) ||
                            опубликованных: (<?=$questionModel->getCountPublQuestion($id);?>) ||
                            без ответа: (<?=$questionModel->getCountDontPublQuestion($id);?>)</p>
                        </div>
                        <div class="card-action">
                            <a href="admin.php?controller=Questions&action=showList&idTheme=<?=$id;?>">Перейти в тему</a>
                            <a href="admin.php?controller=themes&action=delete&idTheme=<?=$id;?>">Удалить тему</a>
                        </div>
                    </div>
                </div>
            </div>
                <?php endforeach;?>
            <?php else: ?>
            <div class="row">
                <div class="col s12 m12 l12 lx12">В системе не найдены существующие темы.</div>
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
    
    <!-- плавающая кнопка -->
    <div class="fixed-action-btn">
        <a class="btn-floating btn-large red">
            <i class="large material-icons">mode_edit</i>
        </a>
        <ul>
            <li><a class="btn-floating blue" href="admin.php?controller=themes&action=editNew"><i class="material-icons">add</i></a></li>
        </ul>
    </div>
    <!-- конец плавающей кнопки -->

    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/materialize.min.js"></script>

    <!--Float button inicialize-->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.fixed-action-btn');
    var instances = M.FloatingActionButton.init(elems, {});
    });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems, {});});
    </script>
</body>
</html>