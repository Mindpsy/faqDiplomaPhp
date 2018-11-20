<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <title>Авторизация</title>
</head>
<body>
<div class="container center">
    <div class="row">
        <div class="col">
            <h1>Войдите в учетную запись для работы с системой</h1>
        </div>
    </div>
    <div class="row s12 m12 l12 lx12">
        <div class="col s6 m6 l6 lx6 offset-s3 offset-m3 offset-l3 offset-lx3">
            <form>
            <?php if(isset($wrong)): ?>
                <div class="row">
                    <ul>
                        <li class="red-text"><?=$wrong?></li>
                    </ul>
                </div>
            <?php endif;?>
                <div class="row">
                    <div class="input-field col s12">
                        <input type="hidden" name="controller" value="base">
                        <input id="login" type="text" class="validate" name="login"> 
                        <label for="login">Логин</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input type="hidden" name="action" value="login">
                        <input id="password" type="password" class="validate" name="pass">
                        <label for="password">Пароль</label>
                    </div>
                </div>
                <button class="btn waves-effect waves-light" type="submit">Войти
                    <i class="material-icons right">отправить</i>
                </button>
            </form>
        </div>
    </div>
</div>
    
</body>
</html>