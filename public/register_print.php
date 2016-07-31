<?php

/*
 * Licensed to Bill Radja Pono <baingao@gmail.com>
 * Unauthorized use is prohibited
 */

require_once "../includes/classes/class_pdf.php";
//$string = "Licensed to Bill Radja Pono";
//$pdf=new PDF();
//$pdf->AddPage();
//$pdf->SetFont('Arial','U',10);
//$pdf->SetFillColor(250,180,200);
////Set the interior cell margin to 1cm
//$pdf->Margin=10;
////Print 2 Cells
//$pdf->Cell(190,8,'a short text which is left aligned',1,1,'L',1);
//$pdf->Ln();
//$pdf->Cell(190,8,'a short text which is forced justified',1,1,'FJ',1);
//$pdf->Ln();
////Print 2 MultiCells
//$y=$pdf->GetY();
//$pdf->MultiCell(90,8,"It is a long text\nwhich is left aligned",1,'L',1);
//$pdf->SetXY(110,$y);
//$pdf->MultiCell(90,8,"It is a long text\nwhich is forced justified and\n{$string}",1,'FJ',0);
//$pdf->Output();

function GenerateWord()
{
    //Get a random word
    $nb=rand(3,10);
    $w='';
    for($i=1;$i<=$nb;$i++)
        $w.=chr(rand(ord('a'),ord('z')));
    return $w;
}

function GenerateSentence()
{
    //Get a random sentence
    $nb=rand(1,10);
    $s='';
    for($i=1;$i<=$nb;$i++)
        $s.=GenerateWord().' ';
    return substr($s,0,-1);
}

$pdf=new PDF_MC_Table();
$pdf->AddPage();
$pdf->SetFont('Arial','',14);
//Table with 20 rows and 4 columns
$pdf->SetWidths(array(30,50,30,40));
srand(microtime()*1000000);
for($i=0;$i<20;$i++)
    $pdf->Row(array(GenerateSentence(),GenerateSentence(),GenerateSentence(),GenerateSentence()));
$pdf->Output();

?>