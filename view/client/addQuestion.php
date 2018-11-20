<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Добавить свой вопрос</title>
	<!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
	<div class="container">
		<form>
			<div class="row">
				<div class="input-field col s6 m6 l6 lx6 offset-s3 offset-m3 offset-l3 offset-lx3">
					<input id="nameAuthor" name="nameAuthor" type="text" class="validate">
					<input name="controller" type="hidden" value="users">
					<input name="action" type="hidden" value="addNewQuestion">
					<label for="nameAuthor">Имя</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s6 m6 l6 lx6 offset-s3 offset-m3 offset-l3 offset-lx3">
					<input id="email" type="email" name="email" class="validate">
					<label for="email">Email</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s6 m6 l6 lx6 offset-s3 offset-m3 offset-l3 offset-lx3">
					<select name="idTheme">		
				<?php if($listThemes):?>
					<option value="" disabled selected>Выберите тему вопроса</option>
					<?php foreach($listThemes as $theme): ?>
						<option value="<?=$theme['id'];?>"><?=$theme['name'];?></option>
					<?php endforeach;?>
				<?php else: ?>
					<option value="" disabled selected>Темы еще не созданы</option>
				<?php endif;?>
					</select>
					<label>Тема вопроса</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s6 m6 l6 lx6 offset-s3 offset-m3 offset-l3 offset-lx3">
					<input id="question" name="question" type="text" class="validate">
					<label for="question">Вопрос</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s6 m6 l6 lx6 offset-s3 offset-m3 offset-l3 offset-lx3">
					<button class="btn waves-effect waves-light col s6 m6 l6" type="submit">
						Отправить
						<i class="material-icons right">send</i>
					</button>
					<a href="/" class="btn red col s6 m6 l6">
						Назад
						<i class="material-icons right">stop</i>
					</a>
				</div>
			</div>
		</form>
	</div>
	<script>
        document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems, {});
        });
	</script>
	<!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/materialize.min.js"></script>



	
</body>
</html>