<?php
include_once '../database.php';
require('fpdf.php');

if (isset($_GET["exam_id"])) {
	$exam_id=$_GET["exam_id"];
}

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    //$this->Image('logo.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,10,'Result',1,0,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',20);


$sql="SELECT * FROM result WHERE exam_id=$exam_id";
$result=executeQuery($sql);
if($result->num_rows>0)
{
    while($row=$result->fetch_assoc())
    {
    	$data=$row["exam_id"];
        $pdf->Cell(0,10,"Exam Id: ".$data,0,1);
		$data=$row["reg_no"];
        $pdf->Cell(0,10,"Reg no: ".$data,0,1);
        $data=$row["marks"];
        $pdf->Cell(0,10,"Marks: ".$data,0,1);        


    }

}


$pdf->Output();



?>