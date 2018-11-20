<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Администраторы</title>
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
                <div class="row s12 m12 l12 lx12">
                    <table class="highlight">
                        <thead>
                            <tr>
                                <th>Имя</th>
                                <th>Email</th>
                                <th>Login</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                    <?php if($list): ?>
                        <?php foreach($list as $admin): ?>
                            <tr>
                                <td><?=$admin['name']?></td>
                                <td><?=$admin['email']?></td>
                                <td><?=$admin['login']?></td>
                                <td><a href="admin.php?controller=admins&action=edit&idAdmin=<?=$admin['id']?>">Редактировать</a></td>
                            <?php if(count($list)!= 1):?>
                                <td><a href="admin.php?controller=admins&action=delete&idAdmin=<?=$admin['id']?>">Удалить</a></td>
                            <?php endif; ?>
                            </tr>
                        <?php endforeach;?>
                    <?php else: ?>
                            <tr>
                                <th>Администраторы не найдены!</th>
                            </tr>
                    <?php endif; ?>
                        </tbody>
                    </table>
                </div>
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
        <!--JavaScript at end of body for optimized loading-->
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <!-- плавающая кнопка -->
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large red">
                <i class="large material-icons">mode_edit</i>
            </a>
            <ul>
                <li><a class="btn-floating blue" href="admin.php?controller=admins&action=editNew"><i class="material-icons">add</i></a></li>
            </ul>
        </div>
        <!-- конец плавающей кнопки -->
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
        var instances = M.Sidenav.init(elems, {});
        });
        </script>
    </body>
</html>