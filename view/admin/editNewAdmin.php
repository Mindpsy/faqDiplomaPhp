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
                    <li class="active"><a href="admin.php?controller=admins&action=showList">Администраторы</a></li>
                    <li><a href="admin.php?controller=themes&action=showList">Темы</a></li>
                    <li><a href="admin.php?controller=Questions&action=showNewQuestions">Новые вопросы</a></li>
                    <li><a href="admin.php?controller=admins&action=exitAcc">Выход</a></li>
                </ul>
            </div>
        </nav>

        <ul class="sidenav" id="mobile-demo">
            <li class="active"><a href="admin.php?controller=admins&action=showList">Администраторы</a></li>
            <li><a href="admin.php?controller=themes&action=showList">Темы</a></li>
            <li><a href="admin.php?controller=Questions&action=showNewQuestions">Новые вопросы</a></li>
            <li><a href="admin.php?controller=admins&action=exitAcc">Выход</a></li>
        </ul>
    <!-- </div> -->

    <main>
        <div class="container">
            
            <div class="row">
                <div class="col s10 m10 l10 lx10 offset-s1 offset-m1 offset-l1 offset-lx1">
                    <ul>
                    <?php if($true == 'true'):?>
                        <li>Такой логин уже существует, попробуйте другой</li>
                    <?php endif; ?>
                    </ul>
                </div>
                <form class="col s10 m10 l10 lx10 offset-s1 offset-m1 offset-l1 offset-lx1">
                    <input type="hidden" name="controller" value="admins">
                    <input type="hidden" name="action" value="fixNewEdit">

                    <div class="input-field col s12 m12 l12">
                        <input id="nameAdmin" type="text" class="validate" name="nameAdmin" value="<?=$name?>">
                        <label for="nameAdmin">Имя</label>
                    </div>

                    <div class="input-field col s12 m12 l12">
                        <input id="email" type="email" class="validate" name="email" value="<?=$email?>">
                        <label for="email">Email</label>
                    </div>

                    <div class="input-field col s12 m12 l12">
                        <input id="login" type="text" class="validate" name="login" value="<?=$login?>">
                        <label for="login">Login</label>
                    </div>
                    
                    <div class="input-field col s12 m12 l12">
                        <input id="password" type="password" class="validate" name="password" value="<?=$password?>">
                        <label for="password">Пароль</label>
                    </div>

                    <div class="col s6 m6 l6 offset-s3 offset-m3 offset-l3 offset-lx3">
                        <button class="btn waves-effect waves-light col s6 m6 l6" type="submit">
                            Добавить
                            <i class="material-icons right">send</i>
                        </button>
                        
                        <a href="admin.php?controller=admins&action=showList" class="btn red accent-3 col s6 m6 l6">
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