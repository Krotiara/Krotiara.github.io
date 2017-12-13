<!DOCTYPE html>

<?php
include_once "mysql_connect.php";
#mysqli_query($con,"SElect * From hitcounter");
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
$lasttime = mysqli_query($con,"SELECT lastupdate as lud FROM hitcounter WHERE id='2'");
$lt = mysqli_fetch_array($lasttime);
$delta = $currentTime - $lt['lud'];
if($delta > 10 || $delta < 0)
{
	mysqli_query($con,"UPDATE hitcounter SET `views` = `views`+1 WHERE id='2'");
	$cTime = mysqli_real_escape_string($con,$currentTime);
	mysqli_query($con,"UPDATE hitcounter SET `lastupdate` = '$cTime' WHERE id='2'");
}
$result = mysqli_query($con,"SELECT * FROM hitcounter WHERE id='2'");
$numResult = mysqli_num_rows($result);


?>
<!--https://giphy.com/gifs/y1ZBcOGOOtlpC/html5-->
<html>
	<head>
		<link rel="shortcut icon" href="images/icon.png" type="image/png">
		<meta charset="utf-8">
		<meta name='viewport' content='width=device-width,initial-scale=1'>
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media='all' />
		<link rel="stylesheet" type="text/css" href="css/galleryStyle.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<title>Моё портфолио</title>
	</head>
	<body>
		<div id='help' class ='help'>
			<div class='overlay'></div>
			<div class='title'>
				<h4>Помощь</h4>
				<div class='content'>
					<p>1) При нажатии на картинку она откроется откроется в полном размере</p>
					<p>2)Вы можете пролистывать фотографии клавишами Ctrl+left или Ctrl+right</p>
					<p>3)Чтобы закрыть фотографию,нажмите крестик в верхнем правом углу фотографии или нажмите ESC</p>
					<p>4)Чтобы закрыть это окно, нажмите крестик в верхнем правом углу фотографии или нажмите ESC</p>
				</div>
				<span class='close' onclick='closeHelp()'>&#10008;</span>
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
						<li><a class='a' href="index.php">Обо мне</a></li>
						<li><a class='a' href="gallery.php">Галерея</a></li>
						<li><a class='a' href="https://vk.com/math_mech">Страница МатМеха</a></li>
						<li><a class='a' href="https://urfu.ru/ru/">Сайт УрФу</a></li>
						<li><a class='helpMe'>Помощь(F1)</a></li>
						<li class='counter'><p>Количество посещений:<?php
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
			<header><h3>Добро пожаловать в мою галерею</h3></header>
			<section>
				<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-6 col-xs-offset-3 col-md-offset-0 col-sm-offset-0 col-lg-3 thumb"   id="1">
						
						<img class='mini' src="images/Small/small1.jpg" onclick='openGalleryBlock();openSlide(1,true)'  alt=""></div>
					<div class="col-md-3 col-sm-3 col-xs-6 col-xs-offset-3 col-md-offset-0 col-sm-offset-0 col-lg-3 thumb"   id="2">
						
						<img class='mini' src="images/Small/small2.jpg" onclick='openGalleryBlock();openSlide(2,true)'  alt=""></div>
					<div class="col-md-3 col-sm-3 col-xs-6 col-xs-offset-3 col-md-offset-0 col-sm-offset-0 col-lg-3 thumb"   id="3">
						
						<img class='mini' src="images/Small/small3.jpg" onclick='openGalleryBlock();openSlide(3,true)'   alt=""></div>
					<div class="col-md-3 col-sm-3 col-xs-6 col-xs-offset-3 col-md-offset-0 col-sm-offset-0 col-lg-3 thumb"   id="4">
						
						<img class='mini' src="images/Small/small4.jpg" onclick='openGalleryBlock();openSlide(4,true)'  alt=""></div>
				</div>
				<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-6 col-xs-offset-3 col-md-offset-0 col-sm-offset-0 col-lg-3 thumb"   id="5">
						
						<img class='mini' src="images/Small/small5.jpg" onclick='openGalleryBlock();openSlide(5,true)'  alt=""></div>
					<div class="col-md-3 col-sm-3 col-xs-6 col-xs-offset-3 col-md-offset-0 col-sm-offset-0 col-lg-3 thumb"   id="6">
						
						<img class='mini' src="images/Small/small6.jpg" onclick='openGalleryBlock();openSlide(6,true)'  alt=""></div>
					<div class="col-md-3 col-sm-3 col-xs-6 col-xs-offset-3 col-md-offset-0 col-sm-offset-0 col-lg-3 thumb"   id="7">
						
						<img class='mini' src="images/Small/small7.jpg" onclick='openGalleryBlock();openSlide(7,true)'  alt=""></div>
					<div class="col-md-3 col-sm-3 col-xs-6 col-xs-offset-3 col-md-offset-0 col-sm-offset-0 col-lg-3 thumb"   id="8">
						
						<img class='mini' src="images/Small/small8.jpg" onclick='openGalleryBlock();openSlide(8,true)' alt=""></div>
				</div>
				<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-6 col-xs-offset-3 col-md-offset-0 col-sm-offset-0 col-lg-3 thumb"   id="9">
						
						<img class='mini' src="images/Small/small9.jpg" onclick='openGalleryBlock();openSlide(9,true)'  alt=""></div>
					<div class="col-md-3 col-sm-3 col-xs-6 col-xs-offset-3 col-md-offset-0 col-sm-offset-0 col-lg-3 thumb"   id="10">
						
						<img class='mini' src="images/Small/small10.jpg" onclick='openGalleryBlock();openSlide(10,true)'  alt=""></div>
					<div class="col-md-3 col-sm-3 col-xs-6 col-xs-offset-3 col-md-offset-0 col-sm-offset-0 col-lg-3 thumb"   id="11">
						
						<img class='mini' src="images/Small/small11.jpg" onclick='openGalleryBlock();openSlide(11,true)'  alt=""></div>
					<div class="col-md-3 col-sm-3 col-xs-6 col-xs-offset-3 col-md-offset-0 col-sm-offset-0 col-lg-3 thumb"   id="12">
						
						<img class='mini' src="images/Small/small12.jpg" onclick='openGalleryBlock();openSlide(12,true)'  alt=""></div>
				</div>
				<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-6 col-xs-offset-3 col-md-offset-0 col-sm-offset-0 col-lg-3 thumb"   id="13">
						
						<img class='mini' src="images/Small/small13.jpg" onclick='openGalleryBlock();openSlide(13,true)'  alt=""></div>
					<div class="col-md-3 col-sm-3 col-xs-6 col-xs-offset-3 col-md-offset-0 col-sm-offset-0 col-lg-3 thumb"   id="14">
						
						<img class='mini' src="images/Small/small14.jpg" onclick='openGalleryBlock();openSlide(14,true)'  alt=""></div>
					<div class="col-md-3 col-sm-3 col-xs-6 col-xs-offset-3 col-md-offset-0 col-sm-offset-0 col-lg-3 thumb"   id="15">
						
						<img class='mini' src="images/Small/small15.jpg" onclick='openGalleryBlock();openSlide(15,true)'  alt=""></div>
					<div class="col-md-3 col-sm-3 col-xs-6 col-xs-offset-3 col-md-offset-0 col-sm-offset-0 col-lg-3 thumb"   id="16">
						
						<img class='mini' src="images/Small/small16.jpg" onclick='openGalleryBlock();openSlide(16,true)'  alt=""></div>
				</div>
			</section>	
		</div>
		<div id='gBlock' class='galleryBlock'>
			<div class='galleryBlock-content'>
				
				<div id='1' class='slide'>
					<div class = 'photoNumber'>1 / 16</div>
					<img class="1" src="images/Big/1.jpg" style="width:100%" alt= "Это я" >
				</div>
				<div id='2' class='slide'>
					<div class = 'photoNumber'>2 / 16</div>
					<img class='1' src="images/Big/2.jpg"  style="width:100%" alt="Прага">
				</div>
				<div id='3' class='slide'>
					
					<div class = 'photoNumber'>3 / 16</div>
					<img class='1' src="images/Big/3.jpg"  style="width:100%" alt="Дом Джульетты в Вероне">
				</div>
				<div id='4' class='slide'>
					
					<div class = 'photoNumber'>4 / 16</div>
					<img class='1' src="images/Big/4.jpg"  style="width:100%" alt="Да,я на коне (С)">
				</div>
				<div id='5' class='slide'>
					
					<div class = 'photoNumber'>5 / 16</div>
					<img class='1' src="images/Big/5.jpg"  style="width:100%" alt="Канны">
				</div>
				<div id='6' class='slide'>
					
					<div class = 'photoNumber'>6 / 16</div>
					<img class='1' src="images/Big/6.jpg"  style="width:100%" alt="Венеция">
				</div>
				<div id='7' class='slide'>
					
					<div class = 'photoNumber'>7 / 16</div>
					<img class='1' src="images/Big/7.jpg"  style="width:100%" alt="Монако">
				</div>
				<div id='8' class='slide'>
					
					<div class = 'photoNumber'>8 / 16</div>
					<img class='1' src="images/Big/8.jpg"  style="width:100%" alt="Мой верный друг Макси">
				</div>
				<div id='9' class='slide'>
					
					<div class = 'photoNumber'>9 / 16</div>
					<img class='1' src="images/Big/9.jpg"  style="width:100%" alt="Лувр">
				</div>
				<div id='10' class='slide'>
					
					<div class = 'photoNumber'>10 / 16</div>
					<img class='1' src="images/Big/10.jpg"  style="width:100%" alt="Диснейлэнд">
				</div>
				<div id='11' class='slide'>
					
					<div class = 'photoNumber'>11 / 16</div>
					<img class='1' src="images/Big/11.jpg"  style="width:100%" alt="Ночной Париж">
				</div>
				<div id='12' class='slide'>
					
					<div class = 'photoNumber'>12 / 16</div>
					<img class='1' src="images/Big/12.jpg"  style="width:100%" alt="Польша">
				</div>
				<div id='13' class='slide'>
					
					<div class = 'photoNumber'>13 / 16</div>
					<img class='1' src="images/Big/13.jpg"  style="width:100%" alt="Мемориал памяти Советским солдатам в Берлине">
				</div>
				<div id='14' class='slide'>
					
					<div class = 'photoNumber'>14 / 16</div>
					<img class='1' src="images/Big/14.jpg"  style="width:100%" alt="Чехия">
				</div>
				<div id='15' class='slide'>
					
					<div class = 'photoNumber'>15 / 16</div>
					<img class='1' src="images/Big/15.jpg"  style="width:100%" alt="Ницца">
				</div>
				<div id='16' class='slide'>
					
					<div class = 'photoNumber'>16 / 16</div>
					<img class='1' src="images/Big/16.jpg"  style="width:100%" alt="Ницца,залив">
				</div>

			

				<div class='sliderNav'>
					<span class='next'><b> &larr; Ctrl</b><a  onclick='changeSlide(-1)'>назад</a></span>
					<span class='prev'><a  onclick='changeSlide(1)'>вперед</a><b>Ctrl &rarr; </b></span>
					<span class='close' onclick='closeGalleryBlock(true)'>&#10008;</span>
						<button class='StartImg' onclick='SetStartImg()';>Сделать стартовым</button>
						<button class='SetBackground' onclick='SetImgToBack();'>Сделать фоном</button>

				</div>			
			</div>

		</div>
		<script type="text/javascript" src='js/galleryScript.js'></script>
	</body>
</html>