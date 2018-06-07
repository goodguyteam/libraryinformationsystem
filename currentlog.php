<?php

	$conn = mysqli_connect('localhost','root','','libraryinformationsystem');

	date_default_timezone_set("Asia/Manila");
	$date = date("Y-m-d");

        $stmt =  $conn->prepare("SELECT U.student_number, U.first_name, U.middle_name, U.	last_name, U.course_section_id, 'temp', U.image_path, L.log_date, L.time_in, L.time_out FROM student_infos AS U INNER JOIN library_logs AS L ON U.student_number = L.student_number WHERE L.log_date = '$date'");
	$stmt->execute();
	$stmt->bind_result( $u_student_no,  $u_firstname,  $u_middlename,  $u_lastname ,  $u_course, $u_YearSection, $u_imageurl, $l_logs_datein, $l_logs_timein, $l_logs_timeout);
	
	$recipes = array();
	
	while($stmt -> fetch())
	{
		if($l_logs_timeout == null)
		{
			$temp = array();
			$temp['u_student_no'] = 'Student number:  '.$u_student_no;
			$temp['u_name'] = 'Name:  '.$u_lastname.' '.$u_firstname.' '.$u_middlename.'.';
			$temp['u_course_ys'] = 'Year & Section:  '.$u_course.'  '.$u_YearSection;
			$temp['u_imageurl'] = $u_imageurl;
			$temp['l_logs_datein'] = 'Date: '.$l_logs_datein;
			$temp['l_logs_timein'] = 'Time in:  '.$l_logs_timein;
			$temp['l_logs_timeout'] = 'Time out:  '.'Currently inside';
		
		
		}
		else
		{
			$temp = array();
			$temp['u_student_no'] = 'Student number:  '.$u_student_no;
			$temp['u_name'] = 'Name:  '.$u_lastname.' '.$u_firstname.' '.$u_middlename.'.';
			$temp['u_course_ys'] = 'Year & Section:  '.$u_course.'  '.$u_YearSection;
			$temp['u_imageurl'] = $u_imageurl;
			$temp['l_logs_datein'] = 'Date: '.$l_logs_datein;
			$temp['l_logs_timein'] = 'Time in:  '.$l_logs_timein;
			$temp['l_logs_timeout'] = 'Time out:  '.$l_logs_timeout;
		
		
		}
		
		array_push($recipes, $temp);
	}
	
	echo json_encode($recipes)



?>