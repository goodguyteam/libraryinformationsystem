<?php  
$connect = mysqli_connect("localhost", "root", "", "libraryinformationsystem"); 

 $query = "SELECT
    C.name as course,
	count(*) as number
FROM
    library_logs L
RIGHT JOIN student_infos I ON
    L.student_number = I.student_number
INNER JOIN student_sections SS ON
    SS.id = I.course_section_id
INNER JOIN courses C ON
    C.id = SS.course_id 
    GROUP BY course";  
 $result = mysqli_query($connect, $query);  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Visitor's Log Report</title>  
           <script type="text/javascript" src="loader.js"></script>
           <script type="text/javascript" src="jspdf.min.js"></script>
           <script type="text/javascript" src="logoreport.js"></script>
           <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['course', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["course"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var container = document.getElementById('chart_div');
                var chart = new google.visualization.PieChart(container);  
                var options = {
                	legend: {'alignment':'center'},
                	height: 800,
                	width: 800,
					chartArea: {top:0,'width': '100%', 'height': '40%'},
                };
                chart.draw(data,options);
                var doc = new jsPDF();
				doc.addImage(logoreport,'PNG',60,10,90,30);
                doc.text(70,50,"PERCENTAGE OF VISIT");
				doc.text(57,57,"Polytechnic University of the Philippines");
    			doc.addImage(chart.getImageURI(), 0, 120);
    			doc.save('visitors_log.pdf');
           }  
           </script>
      		<div id="chart_div" style="visibility: hidden;"></div>
      </head>  
      <body>  
      </body>  
 </html>  