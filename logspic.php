<?php

	$db = mysqli_connect('localhost','root','','libraryinformationsystem');


date_default_timezone_set("Asia/Manila");

$date = date("Y-m-d");
$time = date("H:i:s");

$student_no = $_POST['student_no_post2'];


$mysql_qry = "SELECT * FROM student_infos WHERE  student_number = '$student_no'";
$result = mysqli_query($db,$mysql_qry ); 

if(mysqli_num_rows($result) > 0)
{
	while($rowvalue=mysqli_fetch_array($result))
	{
		$student_pic = $rowvalue[5];
		echo $student_pic;



	}

}	
else
{
	echo "Account doesn't exist!"; 
}  



?>
