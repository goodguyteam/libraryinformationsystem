<?php
require (app_path() .'\Http\Controllers\fpdf.php');
$db = new PDO('mysql:host=localhost;dbname=libraryinformationsystem','root','');

class myPDF extends FPDF{
	function header(){
		$this->Image(asset('img/logo/logoreport.png'),10,6);
		$this->SetFont('Arial','B',14);
		$this->Cell(276,5,'RESOURCE LEARNING CENTER',0,0,'C');
		$this->Ln();
		$this->SetFont('Times','',12);
		$this->Cell(276,10,'Polytechnic University of the Philippines',0,0,'C');
		$this->Ln(10);
		$this->SetFont('Times','B',12);
		$this->Cell(276,10,'Circulation List',0,0,'C');
		$this->Ln(15);
	}
	function footer(){
		$this->SetY(-15);
		$this->SetFont('Arial','',8);
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
	function headerTable(){
		$this->SetFont('Times','B',12);
		$this->Cell(67,10,'Borrower',1,0,'C');
		$this->Cell(70,10,'Book Title',1,0,'C');
		$this->Cell(70,10,'Date Borrowed',1,0,'C');
		$this->Cell(70,10,'Date Returned',1,0,'C');
		$this->Ln();
	}
	function viewTable($db){
		$this->SetFont('Times','',12);
		$stmt = $db->query("SELECT
    IFNULL(
        CONCAT(
            SI.first_name,
            ' ',
            SI.middle_name,
            ' ',
            SI.last_name
        ),
        CONCAT(
            PI.first_name,
            ' ',
            PI.middle_name,
            ' ',
            PI.last_name
        )
    ) AS Borrower,
    BI.title AS Book,
    date_borrowed AS Borrowed,
    date_returned AS Returned
FROM
    transactions T
LEFT JOIN student_infos SI ON
    SI.id = T.student_borrower_id
LEFT JOIN personnel_infos PI ON
    PI.id = T.personnel_borrower_id
INNER JOIN book_infos BI ON
    BI.id = t.book_copy_id");
		while ($data = $stmt->fetch(PDO::FETCH_OBJ)){
			$this->Cell(67,10,$data->Borrower,1,0,'C');
			$this->Cell(70,10,$data->Book,1,0,'C');
			$this->Cell(70,10,$data->Borrowed,1,0,'C');
			$this->Cell(70,10,$data->Returned,1,0,'C');
			$this->Ln();
		}
	}
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Output('I','CiculationList.pdf');
?>