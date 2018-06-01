<?php

	$db = mysqli_connect('localhost','root','','samplescan');


date_default_timezone_set("Asia/Manila");

$date = date("Y-m-d");
$time = date("h:i:s");

$student_no = $_POST['student_no_post2'];


$mysql_qry = "SELECT *  FROM user WHERE  student_no = '$student_no'  and status = 1";
$result = mysqli_query($db,$mysql_qry ); 

if(mysqli_num_rows($result) > 0)
{
	while($rowvalue=mysqli_fetch_array($result))
	{
		$student_pic = $rowvalue[6];
		echo $student_pic;



	}

}	
else
{
	echo "Account doesn't exist!"; 
}  



?>
