
<?php
include_once "mysql_connect.php";
#mysqli_query($con,"SElect * From hitcounter");
mysqli_query($con,"UPDATE hitcounter SET `views` = `views`+1 WHERE id='1'");
$result = mysqli_query($con,"SELECT * FROM hitcounter");
$numResult = mysqli_num_rows($result);
for($i=0;$i < $numResult;$i++)
{
	$row = mysqli_fetch_array($result);
	echo htmlspecialchars(stripslashes($row["views"]));
}
	mysqli_free_result($result);
	mysqli_close($con);
}
else {
  echo mysqli_error($con);
}


?>

<!DOCTYPE html>
<html>
<head></head>
<body></body>
</html>