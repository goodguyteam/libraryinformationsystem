<?php

	
	$db = mysqli_connect('localhost','root','','samplescan');


	date_default_timezone_set("Asia/Manila");

	$date = date("Y-m-d");
	$time = date("h:i:s");


	$student_no = $_POST['student_no_post1'];

	

	$out = "UPDATE logs set logs_dateout = '$date', logs_timeout = '$time', logs_status = 1 WHERE student_no = '$student_no'";
	$outres = mysqli_query($db,$out);

	if($outres)
	{
		echo "Thank you for using the library! Come again :)";
	}
	else
	{
		echo "error occurred!";
	}


?>