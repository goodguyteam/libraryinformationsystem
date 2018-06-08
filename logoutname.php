<?php

	
	$db = mysqli_connect('localhost','root','','libraryinformationsystem');


	date_default_timezone_set("Asia/Manila");

	$date = date("Y-m-d");
	$time = date("H:i:s");


	$student_no = $_POST['student_no_post1'];

	

	$out = "UPDATE library_logs set time_out = '$time', log_status = 1 WHERE student_number = '$student_no'";
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