<?php 
	
	$db = mysqli_connect('localhost','root','','libraryinformationsystem');


	date_default_timezone_set("Asia/Manila");

	$date = date("Y-m-d");
	$time = date("h:i:s");

	$student_no = '2015-00216-CM-0';



	$in = "INSERT INTO logs(student_no, logs_datein, logs_timein) VALUES('$student_no', '$date', '$time')";
			$inres = mysqli_query($db,$in);

			if($inres)
			{
				echo "Login successfully!";
			}
			else
			{
				echo "error occurred!";
			}


?>