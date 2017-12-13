<!DOCTYPE html>

<?php
include_once "mysql_connect.php";

$currentDate = mysqli_query($con,"SELECT CURTIME() as timeNow");

$test = mysqli_fetch_array($currentDate);
$sqlOne = "SELECT HOUR('". $test['timeNow'] . "') as h";
$sqlTwo = "SELECT MINUTE('". $test['timeNow'] . "') as m";
$sqlThree = "SELECT SECOND('". $test['timeNow'] . "') as s";
$currenthour = mysqli_query($con,$sqlOne);
$currentminute = mysqli_query($con,$sqlTwo);
$currentsecond = mysqli_query($con,$sqlThree);

$ch = mysqli_fetch_array($currenthour);
$cm = mysqli_fetch_array($currentminute);
$cs = mysqli_fetch_array($currentsecond);

$currentTime = 3600 * $ch['h'] + 60 * $cm['m'] + $cs['s'];
$lasttime = mysqli_query($con,"SELECT lastupdate as lud FROM hitcounter WHERE id='1'");
$lt = mysqli_fetch_array($lasttime);
$delta = $currentTime - $lt['lud'];
if($delta > 10 || $delta < 0)
{
	mysqli_query($con,"UPDATE hitcounter SET `views` = `views`+1 WHERE id='1'");
	$cTime = mysqli_real_escape_string($con,$currentTime);
	mysqli_query($con,"UPDATE hitcounter SET `lastupdate` = '$cTime' WHERE id='1'");
}
$result = mysqli_query($con,"SELECT * FROM hitcounter WHERE id='1'");
$numResult = mysqli_num_rows($result);

if(isset($_POST['SetReview']))
{
	$name = $_POST['Person'];
	$review = $_POST['Review'];
	$sql = "INSERT INTO reviews values('$review','$name')";
	mysqli_query($con,$sql);
}

?>

<html>
	<head>
		<link rel="shortcut icon" href="images/icon.png" type="image/png">
		<meta charset="utf-8">
		<meta name='viewport' content='width=device-width,initial-scale=1.0'>
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media='all' />
		<link rel="stylesheet" type="text/css" href="css/mainStyle.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<title>Моё портфолио</title>
	</head>
	<body>
	<div id='review' class ='review'>
			<div class='overlay'></div>
			<div class='title'>
				<h4>Оставить отзыв</h4>
				<div class='content'>
					<form action='index.php'>
					<p>Ваше имя:</p><br>
					<input type='text' name='Person'><br>
					<p>Ваш отзыв:</p><br>
					<input type='text' name='Review'><br><br>

					<input type="submit" value="Отправить" name='SetReview'>
					</form>
				</div>
				<span class='close' onclick='closeReviewWindow()'>&#10008;</span>
			</div>
			
	</div>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class='container-fluid'>
			<div class='navbar-header'>
				<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar-main'>
					<span class="icon-bar"></span>
	        		<span class="icon-bar"></span>
	        		<span class="icon-bar"></span>
				</button>
			</div>
			<div class='collapse navbar-collapse' id='navbar-main'>
				<ul class='nav navbar-nav navbar-left'>
					<li><a href="index.php">Обо мне</a></li>
					<li><a href="gallery.php">Галерея</a></li>
					<li><a href="https://vk.com/math_mech">Страница МатМеха</a></li>
					<li><a href="https://urfu.ru/ru/">Сайт УрФу</a></li>
					<li><a class="reviewNav">Оставить отзыв</a></li>
					<li class = 'counter'><p>Количество посещений:<?php
						for($i=0;$i < $numResult;$i++)
							{
								$row = mysqli_fetch_array($result);
								echo htmlspecialchars(stripslashes($row["views"]));
							}
							mysqli_free_result($result);
							mysqli_close($con);
						?>
					</p></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		<div class="row " style='min-height:400px'> 
			<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 ">
	  			<ul class='nav nav-tabs navbar-nav tabs-left'>
					<li class='active'><a href="#tab1" data-toggle='tab'>Общая информация</a></li>
					<li><a href="#tab2" data-toggle='tab'>Достижения в учебе</a></li>
					<li><a href="#tab3" data-toggle='tab'>Достижения в спорте</a></li>
					<li><a href="#tab4" data-toggle='tab'>Мои Увлечения</a></li>
					<li><a href="#tab5" data-toggle='tab'>Моё Мировоззрение</a></li>
					
		  		</ul>
	  		</div>
	  		<div class='col-sm-4 col-md-4 col-lg-4 col-xs-12'>
		  		<div class='tab-content'>
		  				<div class='tab-pane active' id='tab1'>
		  					<ul>
		  						<li><p>ФИО:Лисовенко Антон Сергеевич.</p></li>
		  						<li><p>Родной город: Снежинск.</p></li>
		  						<li><p>Образование: Среднее общее (г.Снежинск, школа №125 с углубленным изучением математики) </p></li>
		  						<li><p>Место учебы: г.Екатеринбург, УрФу, МатМех.</p></li>
		  						<li><p>Курс: 3.</p></li>
		  						<li><p>Группа: КН-302.</p></li>
		  						<li><p>Кафедра: математическая физика.</p></li>
		  					</ul>
		  				</div>
		  				<div class='tab-pane' id='tab2'>
		  					<ul>
		  						<li><p>3 место в Всеросийской олимпиаде по Авиастроению.</p></li>
		  						<li><p>Участие в полуфинале олимпиады по программированию среди студентов(2015 г.)</p></li>
		  						<li><p>Участие в всероссийской олимпиаде по программированию(2016г.)</p></li>
		  						<li><p>Волонтер олимпиад по математике среди школьников.</p></li>
		  						<li><p>Сдал питон Самуню</p></li>
		  					</ul>
		  				</div>
		  				<div class='tab-pane' id='tab3'>
		  					<ul>
		  						<li><p>Призер соревнований по стрельбе(2013г.)</p></li>
		  						<li><p>2 место в соревновании по волейболу среди юношенских команд г.Снежинск</p></li>
		  						<li><p>3 место в соревновании по баскетболу среди общежитий УрФу</p></li>
		  						<li><p>3 место в соревновании по баскетболу на турнире г.Снежинска</p></li>
		  						<li><p>1 место в соревновании АСБ по баскетболу среди студентов</p></li>
		  					</ul>
		  				</div>
		  				<div class='tab-pane' id='tab4'>
		  					<ul>
		  						<li><p>Баскетбол, около 4 лет, до этого волейбол и стрельба</p></li>
		  						<li><p>Чтение книг. Любимые авторы: Анджей Сапковский, Чак Паланик, Александр Дюма</p></li>
		  						<li><p>Кино. Любимые фильмы: "Бойцовский клуб"; "Семь"; "Обитель проклятых"; "Остров проклятых"; Все фильмы Квентина Тарантино; "Пролетая над гнездом Кукушки"; "7 Самураев"; "Последний самурай" и т.д.</p></li>
		  					</ul>
		  				</div>
		  				<div class='tab-pane' id='tab5'>	
	  						<ul>
		  						<li><p>Предпочитаю работать в хорошо организованной команде</p></li>
		  						<li><p>Негативное отношение к необязательности и неорганизованности</p></li>
		  						<li><p>Руководствуюсь принципом: Если начал, то надо делать качественно </p></li>
		  						<li><p>Не страшусь нести ответственность за свои слова и действия</p></li>
	  						</ul>
		  				</div>
			  	</div>
			</div>
			<div class='col-sm-5 col-md-5 col-lg-5 col-xs-12 thumb' style='min-width:300px' >
				<img src="images/MainPhoto.jpg" class="img-responsive img-rounded img-thumbnail" alt="Моё фото">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-md-6 col-lg-6 col-xs-12">
				<div class='panel panel-default'>
					<div class='panel-heading'>Мои контакты</div>
					<div class='panel-body'>
						<ul>
							<li><p>Сотовый телефон(МТС): 89822752560</p></li>
							<li><p>Сотовый телефон(Мегафон): 89227944198</p></li>
							<li><a href="https://vk.com/id229474315">Вконтакте</a></li>
							<li><a href="mailto:70dog@mail.ru">Почта</a></li>
						</ul>
					</div>
				</div>
			</div>		
		</div>
	</div>
	<script type="text/javascript" src='js/mainScript.js'></script>
	</body>
</html>