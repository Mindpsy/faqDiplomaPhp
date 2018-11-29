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
            <input type="hidden" name="controller" value="Questions">
            <input type="hidden" name="action" value="fixEdit">
            <input type="hidden" name="prevPos" value="<?=$prevPos?>">
            <input type="hidden" name="idAuthor" value="<?=$idAuthor?>">
            <input type="hidden" name="idQuestion" value="<?=$idQuestion?>">
            <input type="hidden" name="idTheme" value="<?=$idTheme?>">

            <div class="input-field col s12 m12 l12">
                <input id="nameAuthor" type="text" class="validate" name="nameAuthor" value="<?=$nameAuthor?>">
                <label for="nameAuthor">Автор</label>
            </div>

            <div class="input-field col s12 m12 l12">
                <input id="question" type="text" class="validate" name="question" value="<?=$question;?>">
                <label for="question">Вопрос</label>
            </div>

            <div class="input-field col s12 m12 l12">
                <textarea id="answer" class="materialize-textarea" name="answer"><?=$answer?></textarea>
                <label for="answer">Ответ</label>
            </div>

            <div class="input-field col s12 m12 l12">
                <select name="newIdTheme">
                <?php foreach($listThemes as $theme): ?>
                    <option value="<?=$theme['id'];?>" 
                        <?php if($theme['id'] == $idTheme): ?> 
                            selected <?php endif;?> > <?=$theme['name'];?> </option>
                <?php endforeach;?>
                </select>
                <label>Тема вопроса</label>
            </div>

            <div class="input-field col s12 m12 l12">
                <p>
                    <label>
                        <input type="checkbox" name="hidePubl" <?php if($_GET['status'] == 2): ?>checked="checked"<?php endif;?>/>
                        <span>Скрыть опубликованный вопрос</span>
                    </label>
                </p>
            </div>

            <div class="col s6 m6 l6">
                <button class="btn waves-effect waves-light col s6 m6 l6" type="submit">
                    Сохранить
                    <i class="material-icons right">send</i>
                </button>
                
                <a href="admin.php?controller=Questions&action=showList&idTheme=<?=$idTheme?>#<?=$prevPos?>" class="btn red accent-3 col s6 m6 l6">
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

    <!-- Скрипт для selecta -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems, {});
        });
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