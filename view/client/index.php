<!doctype html>
<html lang="ru" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
	<link rel="icon" type="image/png" href="favicon.png" />
	<title>FAQ</title>
</head>
<body>
	<header>
		<h1>FAQ</h1>
	</header>
	

	<div class="row">
		<div class="col">
			<a class="button" href="?controller=users&action=showAddForm">Добавить свой вопрос</a>
			<a class="button-two" href="admin.php">Войти как админ</a>
		</div>
	</div>

	<section class="cd-faq">
	<?php if($themeList): ?>
	<!-- cd-faq-categories -->
		<ul class="cd-faq-categories">
		<?php foreach($themeList as $theme): ?>
			<li><a class="selected" href="#<?=$theme['id'];?>"><?=$theme['name']?></a></li>
		<?php endforeach; ?>
		</ul>
		
		
		<div class="cd-faq-items">
		<?php foreach($themeList as $theme): ?>
			<ul id="<?=$theme['id'];?>" class="cd-faq-group">

				<li class="cd-faq-title"><h2><?=$theme['name']?></h2></li>
				
				<?php $questionModel = new QuestionModel($config); 
					$questionList = $questionModel->getListPublQuestions($theme['id']); ?>
				<?php if($questionList): ?>
					<?php foreach($questionList as $question): ?>
						<?php $answerModel = new AnswerModel($config);
						$answer = $answerModel->getAnswerForIdQuestion($question['id']) ?>

					<li>
						<a class="cd-faq-trigger" href="#0"><?=$question['question'];?></a>
						<!-- cd-faq-content -->
						<div class="cd-faq-content">
							<p><?=$answer;?></p>
						</div> 
					</li>

					<?php endforeach; ?>
				<?php else: ?>
					<li>
						<a class="cd-faq-trigger" href="#0">В этой теме пока не поубликовано ни одного вопроса.</a>
						<!-- cd-faq-content -->
						<div class="cd-faq-content">
							<p>Соответсвенно ответов тоже нет.</p>
						</div> 
					</li>

				<?php endif;?>
			</ul> 
		<?php endforeach; ?>
			<!-- cd-faq-group -->
		</div> 
		<!-- cd-faq-items -->
	<?php else: ?>
		<ul class="cd-faq-categories">
			<li><a class="selected" href="#basics">Темы не созданы</a></li>
		</ul>

		<div class="cd-faq-items">
			<ul id="basics" class="cd-faq-group">
				<li class="cd-faq-title"><h2>Темы не созданы. Соответсвенно вопросов тоже нет.</h2></li>
				<li>
					<a class="cd-faq-trigger" href="#0">Как отобразить вопросы?</a>
					<div class="cd-faq-content">
						<p>Нужно для начала создать темы, чтобы создавать и публиковать вопросы с ответами.</p>
					</div> 
				</li>
			</ul> 
		</div> 
	<?php endif;?>
		<a href="#0" class="cd-close-panel">Close</a>
	</section> 
	
	<!-- cd-faq -->
	<script src="js/jquery-2.1.1.js"></script>
	<script src="js/jquery.mobile.custom.min.js"></script>
	<script src="js/main.js"></script> 
	<!-- Resource jQuery -->
	</body>
</html>