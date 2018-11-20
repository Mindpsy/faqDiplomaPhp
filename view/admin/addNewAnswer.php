<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Добавить ответ</title>
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

    <main>
    <div class="row">
        <form class="col s12 m12 l12">
            <input type="hidden" name="controller" value="answers">
            <input type="hidden" name="action" value="addNew">
            <input type="hidden" name="prevPos" value="<?=$prevPos?>">
            <input type="hidden" name="idQuestion" value="<?=$idQuestion?>">
        <?php if($idTheme): ?>
            <input type="hidden" name="idTheme" value="<?=$idTheme?>">
        <?php endif; ?>

            <div class="input-field col s12 m12 l12">
                <textarea id="answer" class="materialize-textarea" name="answer"></textarea>
                <label for="answer">Ответ</label>
            </div>

            <div class="input-field col s12 m12 l12">
                <p>
                    <label>
                        <input type="checkbox" name="hidePubl" />
                        <span>Скрыть опубликованный вопрос</span>
                    </label>
                </p>
            </div>

            <div class="col s6 m6 l6">
                <button class="btn waves-effect waves-light col s6 m6 l6" type="submit">
                    Сохранить
                    <i class="material-icons right">send</i>
                </button>
                
                <a href="admin.php?controller=Questions&action=<?=$action;?><?=$strIdTheme?>#<?=$prevPos?>" class="btn red accent-3 col s6 m6 l6">
                    Отмена
                    <i class="material-icons right">clear</i>
                </a>
            </div>
        </form>
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
    var instances = M.Sidenav.init(elems, {});
    });
    </script>

    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>