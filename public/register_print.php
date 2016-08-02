<?php

/*
 * Licensed to Bill Radja Pono <baingao@gmail.com>
 * Unauthorized use is prohibited
 */

require_once "includes.php";
require_once INCLUDES_PATH.DS."tcpdf/tcpdf.php";


session_start();

$string = "Licensed to Bill Radja Pono";
	
	$noreg=$_SESSION["PRINT_KEY"];
//	$noreg=238;
	$db = new DbConnect();
	
	$stmt = $db->connect()->query("select register.AI, register.TglDaftar, register.NamaPemohon, register.AlamatPemohon, register.TelpPemohon, register.User, 
			jenisizin.NamaIzin, jenisizin.LamaPengurusan 
			from register inner join jenisizin on register.idJenisIzin=jenisizin.AI
			where register.AI={$noreg}");
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	$noreg = $result['AI']; 
	$tgl = $result['TglDaftar'];
	$nama = $result['NamaPemohon']; 
	$almt = $result['AlamatPemohon']; 
	$tlp = $result ['TelpPemohon'];
	$user = $result['User']; 
	$namaizin = $result['NamaIzin'];
	$lama = $result['LamaPengurusan'];
	
	$pdf=new TCPDF();
	$pdf->AddPage();
//        $pdf->setPrintHeader(false);
//        $pdf->setPrintFooter(false);

	$pdf->Image('images/ntt.jpg',17,5,29,29,'JPG');

	$pdf->SetFont('helvetica','B',14);
	$pdf->SetXY(35,7);
	$pdf->MultiCell(150,6,"PEMERINTAH PROVINSI NUSA TENGGARA TIMUR",0,'C',0);

	$pdf->SetFont('helvetica','',12);
	$pdf->SetXY(35,14);
	$pdf->MultiCell(150,6,"KANTOR PELAYANAN PERIZINAN TERPADU SATU PINTU",0,'C',0);

	$pdf->SetFont('helvetica','',10);
	$pdf->SetXY(35,19);
	$pdf->MultiCell(150,6,"Jalan Teratai No. 10 - Telp/Fax (0380) 833213",0,'C',0);

	$pdf->SetFont('helvetica','',10);
	$pdf->SetXY(35,24);
	$pdf->MultiCell(150,6,"Email : kpptspprovntt@yahoo.com, Website : www.kpptsp-provntt.org",0,'C',0);

	$pdf->Image('images/bottom.png',19,32,150,2,'PNG');

	$x=34;
	$y=10;
	$pdf->SetFont('helvetica','B',12);
	$pdf->SetXY($x,38);
	$pdf->MultiCell(100,$y,"No. Pendaftaran : {$noreg}",0,'L',0);

	$pdf->SetXY($x,38);
	$pdf->MultiCell(125,$y,"Tanggal  : {$tgl} ",1,'R',0);

	$pdf->SetFont('helvetica','',10);
	$pdf->SetXY($x,48);
	$pdf->MultiCell(125,8,"Nama Pemohon    : {$nama} ",'Left Right','L',0);

	$pdf->SetXY($x,56);
	$pdf->MultiCell(125,8,"Alamat Pemohon  : {$almt}",'Left Right','L',0);

	$pdf->SetXY($x,64);
	$pdf->MultiCell(125,8,"Telepon Pemohon : {$tlp}",'Left Right','L',0);


	$pdf->SetFont('helvetica','B',10);
	$pdf->SetXY($x,72);
	$pdf->MultiCell(125,$y,"Jenis Izin  : {$namaizin}",'Left Right Top','L',0);

	$pdf->SetFont('helvetica','',10);
	$pdf->SetXY($x,82);
	$pdf->MultiCell(125,8,"Perkiraan Waktu : {$lama} Hari ",'Left Right Bottom','L',0);

	$pdf->SetXY($x,82);
	$pdf->MultiCell(125,8,"User : {$user} ",'Left Right Bottom','R',0);


	$pdf->SetXY($x,95);
	$pdf->MultiCell(125,6,"1. Ketik PROSES#No. Pendaftaran, kirim ke 08113864955 untuk mengetahui",0,'L',0);
	$pdf->SetXY($x,101);
	$pdf->MultiCell(125,6,"   proses pembuatan izin. ",0,'L',0);
	$pdf->SetXY($x,107);
	$pdf->MultiCell(125,6,"2. Izin dapat diambil ketika berstatus: SELESAI",0,'L',0);

	$pdf->Output();



// function GenerateWord()
// {
    // //Get a random word
    // $nb=rand(3,10);
    // $w='';
    // for($i=1;$i<=$nb;$i++)
        // $w.=chr(rand(ord('a'),ord('z')));
    // return $w;
// }

// function GenerateSentence()
// {
    // //Get a random sentence
    // $nb=rand(1,10);
    // $s='';
    // for($i=1;$i<=$nb;$i++)
        // $s.=GenerateWord().' ';
    // return substr($s,0,-1);
// }

// $pdf=new PDF_MC_Table();
// $pdf->AddPage();
// $pdf->SetFont('helvetica','',14);
// //Table with 20 rows and 4 columns
// $pdf->SetWidths(array(30,50,30,40));
// srand(microtime()*1000000);
// for($i=0;$i<20;$i++)
    // $pdf->Row(array(GenerateSentence(),GenerateSentence(),GenerateSentence(),GenerateSentence()));
// $pdf->Output();

?>