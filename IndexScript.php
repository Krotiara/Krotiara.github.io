<?php
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
	
}

?>