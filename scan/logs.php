<?php

	$db = mysqli_connect('localhost','root','','samplescan');


date_default_timezone_set("Asia/Manila");

$date = date("Y-m-d");
$time = date("h:i:s");

$student_no = $_POST['student_no_post'];


$mysql_qry = "SELECT *  FROM user WHERE  student_no = '$student_no'  and status = 1";
$result = mysqli_query($db,$mysql_qry ); 

if(mysqli_num_rows($result) > 0)
{
	while($rowvalue=mysqli_fetch_array($result))
	{
		$student_no2 = $rowvalue[1];
		$student_name = $rowvalue[2];

		$checkin = "SELECT * FROM logs WHERE student_no = '$student_no2' and logs_status = 0 ";
		$checkinres = mysqli_query($db,$checkin);


		if(mysqli_num_rows($checkinres))
		{
				echo "Logout"." ".$student_name." ?";
		}
		else
		{

			$in = "INSERT INTO logs(student_no, logs_datein, logs_timein) VALUES('$student_no', '$date', '$time')";
			$inres = mysqli_query($db,$in);

			if($inres)
			{
				echo "Welcome to library".' '.$student_name.' :)';
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
