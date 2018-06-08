<?php

	$db = mysqli_connect('localhost','root','','libraryinformationsystem');


date_default_timezone_set("Asia/Manila");

$date = date("Y-m-d");
$time = date("H:i:s");

$student_no = $_GET['student_no_post'];

	$mysql_qry = "SELECT * FROM student_infos WHERE student_number = '$student_no'";
	$result = mysqli_query($db, $mysql_qry);

if(mysqli_num_rows($result) > 0)
{
	while($rowvalue=mysqli_fetch_array($result))
	{
		$student_no2 = $rowvalue[1];
		$student_name = $rowvalue[2];

		$checkin = "SELECT * FROM library_logs WHERE student_number = '$student_no2' and log_status = 0 ";
		$checkinres = mysqli_query($db,$checkin);


		if(mysqli_num_rows($checkinres))
		{
				echo "Do you want to leave the library"." ".$student_name." ?";
		}
		else
		{

			$in = "INSERT INTO library_logs(student_number, log_date, time_in) VALUES('$student_no', '$date', '$time')";
			$inres = mysqli_query($db,$in);

			if($inres)
			{
				echo "Welcome to library".' '.$student_name;
			}
			else
			{
				echo "error occurred!";
			}

	
		}

	}

}	
else
{
	echo "Account doesn't exist!"; 
}  



?>
