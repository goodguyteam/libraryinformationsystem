<?php
require (app_path() .'\Http\Controllers\fpdf.php');
$db = new PDO('mysql:host=localhost;dbname=libraryinformationsystem','root','');

class myPDF extends FPDF{
	function header(){
		$this->Image(asset('img/logo/1.png'),10,6);
		$this->SetFont('Arial','B',14);
		$this->Cell(276,5,'LIBRARY INFORMATION SYSTEM',0,0,'C');
		$this->Ln();
		$this->SetFont('Times','',12);
		$this->Cell(276,10,'Polytechnic University of the Philippines',0,0,'C');
		$this->Ln(10);
		$this->SetFont('Times','B',12);
		$this->Cell(276,10,'Weeding List',0,0,'C');
		$this->Ln(15);
	}
	function footer(){
		$this->SetY(-15);
		$this->SetFont('Arial','',8);
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
	function headerTable(){
		$this->SetFont('Times','B',12);
		$this->Cell(60,10,'Call Number',1,0,'C');
		$this->Cell(70,10,'Title',1,0,'C');
		$this->Cell(70,10,'Author',1,0,'C');
		$this->Cell(70,10,'Date Acquired',1,0,'C');
		$this->Ln();
	}
	function viewTable($db){
		$this->SetFont('Times','',12);
		$stmt = $db->query("SELECT
    BS.call_number as cn,
    BIN.title as title,
    A.name as author,
    AI.date_acquired as da
FROM
    book_inventories BI
INNER JOIN book_shelvings BS ON
    BI.shelving_id = BS.id
INNER JOIN book_infos BIN ON
    BI.book_info_id = BIN.id
INNER JOIN book_authors BA ON
    BIN.id = BA.book_id
INNER JOIN authors A ON
    BA.author_id = A.id
INNER JOIN acquisition_infos AI ON
    BI.acquisition_info_id = AI.id
INNER JOIN disposal_infos DI ON
    BI.disposal_info_id = DI.id
INNER JOIN disposal_types DT ON
    DI.disposal_type_id = DT.id
    WHERE DT.name='Weeded'");
		while ($data = $stmt->fetch(PDO::FETCH_OBJ)){
			$this->Cell(60,10,$data->cn,1,0,'C');
			$this->Cell(70,10,$data->title,1,0,'C');
			$this->Cell(70,10,$data->author,1,0,'C');
			$this->Cell(70,10,$data->da,1,0,'C');
			$this->Ln();
		}
	}
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Output('I','WeedingList.pdf');
?>