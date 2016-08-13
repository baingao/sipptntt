<?php
//============================================================+
// File name   : example_048.php
// Begin       : 2009-03-20
// Last Update : 2013-05-14
//
// Description : Example 048 for TCPDF class
//               HTML tables and table headers
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: HTML tables and table headers
 * @author Nicola Asuni
 * @since 2009-03-20
 */

// Include the main TCPDF library (search for installation path).
require_once "../includes.php";
require_once INCLUDES_PATH . DS . "tcpdf/examples/tcpdf_include.php";
session_start();

$noreg=$_GET["PRINT_KEY"];
	$db = new DbConnect();
	
	$stmt = $db->connect()->query("select siup.NoReg, siup.Nomor, siup.Tgl, siup.Alamat, siup.NoTelp, siup.eMail, siup.NPWP, siup.NoAkte, siup.NamaPenanggungJawab,
		siup.NoKTP, siup.NoPermohonan, siup.TglPermohonan, siup.NoRekProv, siup.TglRekProv, siup.JenisKegiatan, siup.JenisKomoditi,
		siup.JumlahKapal, siup.DaerahUsaha, siup.BerlakuMulai, siup.BerlakuSelesai, siup.Tembusan
		from siup 
		inner join register on siup.NoReg=register.AI  
		where siup.NoReg={$noreg}");
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$noreg = $result['NoReg']; 
	$nomor = $result['Nomor'];
	$tgl = InputSelect::parseDate($result['Tgl']);
	$alamat = $result['Alamat'];
	$telepon = $result['NoTelp'];
	$email = $result['eMail'];
	$npwp = $result['NPWP'];
	$noakte = $result['NoAkte'];
	$penanggungjawab = $result['NamaPenanggungJawab'];
	$noktp = $result['NoKTP'];
	$nopermohonan = $result['NoPermohonan'];
	$tglpermohonan = InputSelect::parseDate($result['TglPermohonan']);
	$norekprov = $result['NoRekProv'];
	$tglrekprov = InputSelect::parseDate($result['TglRekProv']);
	$jeniskegiatan = $result['JenisKegiatan'];
	$jeniskomoditi = $result['JenisKomoditi'];
	$jumlahkapal = $result['JumlahKapal'];
	$daerahusaha = $result['DaerahUsaha'];
	$berlakumulai = InputSelect::parseDate($result['BerlakuMulai']);
	$berlakusampai = InputSelect::parseDate($result['BerlakuSelesai']);
	$tembusan = $result['Tembusan'];
	
// create new PDF document//
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  
// add a page
$resolution= array(210, 335);
$pdf->setPrintHeader(false);
$pdf->SetMargins(20,30,15);
$pdf->AddPage('P', $resolution);

// convert TTF font to TCPDF format and store it on the fonts folder
//$fontname = TCPDF_FONTS::addTTFfont('font/Tahoma.ttf', 'TrueTypeUnicode', '', 96);

//-----------------------------------------------------------------------------

// use the font
$pdf->SetFont('helvetica', '',14 );
$tbl = <<<EOD
<table  cellspacing="0" cellpadding="0" border="0">

    <tr>
       <td style="text-align:center;"><strong>SURAT IZIN USAHA PERIKANAN</strong> </td>
    </tr>
	
	<tr>
       <td style="font-size:12px; text-align:center;">NOMOR : {$nomor}</td>
    </tr>
	
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------

// use the font
$pdf->SetFont('helvetica', '',8 );
$tbl = <<<EOD
<table  cellspacing="0" cellpadding="1" border="0">

    <tr>
		<td width="60%" align="Left"> </td>
		<td width="40%" align="Left">Peraturan Daerah Provinsi Nusa Tenggara Timur</td>
    </tr>
	
	<tr>
		<td width="60%" align="Left"> </td>
		<td width="40%" align="Left">Nomor  :  06 Tahun 2011</td>
    </tr>
	
	<tr>
		<td width="60%" align="Left"> </td>
		<td width="40%" align="Left">Tentang Sumbangan Pihak Ketiga</td>
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------
// convert TTF font to TCPDF format and store it on the fonts folder
//$fontname = TCPDF_FONTS::addTTFfont('font/Tahoma.ttf', 'TrueTypeUnicode', '', 96);
$stmt = $db->connect()->query("select config.NamaTTD1, config.NIPTTD1, config.PangkatTTD1 from config where config.AI=1");
				$stmt->execute();
				$result = $stmt->fetch(PDO::FETCH_ASSOC);
				$namakepala = $result['NamaTTD1'];
				$nipkepala = $result['NIPTTD1'];
				$pangkatkepala = $result['PangkatTTD1'];
// use the font
//$pdf->SetFont($fontname, '', 9, '', false);
$pdf->SetFont('helvetica', '',8 );
$tbl = <<<EOD
<table cellspacing="0" cellpadding="0" border="1">

	<tr>
		<td width="55%">
			<table cellspacing="0" cellpadding="1" border="0">
				<tr>
					<td width="100%" align="Center"></td>
				</tr>
				
				<tr>
					<td width="100%" align="Center"><strong>PERUSAHAAN</strong></td>
				</tr>
				
				<tr>
					<td width="100%" align="Center"></td>
				</tr>	
				
				<tr>
					<td style="border-top: 1px solid black;" width="100%" align="Left"><strong>NAMA PERUSAHAAN/PERORANGAN INDONESIA : </strong></td>
				</tr>
				
				<tr>
					<td style="font-size:14px;" width="100%" align="Center"><strong>{$penanggungjawab}</strong></td>
				</tr>
				
				<tr>
					<td width="16%" align="Left"><strong>ALAMAT </strong></td>
					<td width="4%" align="Center"><strong>:</strong></td>
					<td style="line-height:1.5;" width="80%" align="Left"><strong> {$alamat}  </strong></td>
				</tr>
				
				<tr>
					<td width="52%" align="Left"><strong>NOMOR TELEPON</strong></td>
					<td width="3%" align="Center"><strong>:</strong></td>
					<td width="45%" align="Left"><strong> {$telepon} </strong></td>
				</tr>
				
				<tr>
					<td width="52%" align="Left"><strong>E-MAIL</strong></td>
					<td width="3%" align="Center"><strong>:</strong></td>
					<td width="45%" align="Left"><strong> {$email} </strong></td>
				</tr>
				
				<tr>
					<td width="52%" align="Left"><strong>NPWP</strong></td>
					<td width="3%" align="Center"><strong>:</strong></td>
					<td width="45%" align="Left"><strong> {$npwp} </strong></td>
				</tr>
				
				<tr>
					<td width="52%" align="Left"><strong>NO. AKTE PENDIRIAN/PERUBAHAN</strong></td>
					<td width="3%" align="Center"><strong>:</strong></td>
					<td width="45%" align="Left"><strong> {$noakte} </strong></td>
				</tr>
				
				<tr>
					<td width="52%" align="Left"><strong>NAMA PENANGGUNG JAWAB</strong></td>
					<td width="3%" align="Center"><strong>:</strong></td>
					<td width="45%" align="Left"><strong> {$penanggungjawab} </strong></td>
				</tr>
				
				<tr>
					<td width="52%" align="Left"><strong>NO. KTP</strong></td>
					<td width="3%" align="Center"><strong>:</strong></td>
					<td width="45%" align="Left"><strong> {$noktp} </strong></td>
				</tr>
				
				<tr>
					<td style="font-size:5px;" width="100%" align="center"></td>
				</tr>
				
				<tr>	
					<td width="30%" align="Right"></td>
					<td  style="border: 1px solid black; font-size:70px;" width="25%" align="Center">
					</td>
					<td width="45%" align="center"></td>
				</tr>
				
				<tr>
					<td style="font-size:5px;" width="100%" align="center"></td>
				</tr>
				
				<tr>
					<td style="border: 1px solid black;" width="100%" align="center"><strong>CATATAN</strong></td>
				</tr>
				
				<tr>
					<td style="font-size:7px;" width="6%" align="center"> 1.</td>
					<td style="font-size:7px;" width="94%" align="justify">Surat  permohonan izin ditujukan kepada  Gubernur  Nusa Tenggara  Timur   cq. Kepala  Kantor  Pelayanan  Perizinan  Terpadu  Satu  Pintu Provinsi   Nusa  Tenggara Timur.</td>
				</tr>
				
				<tr>
					<td style="font-size:7px;" width="6%" align="center"> 2.</td>
					<td style="font-size:7px;" width="94%" align="justify">Izin tidak dapat dialihkan ke pihak lain.</td>
				</tr>
				
				<tr>
					<td style="font-size:7px;" width="6%" align="center"> 3.</td>
					<td style="font-size:7px;" width="94%" align="justify">Hasil perikanan yang akan dikirim ke luar  wilayah Nusa Tenggara   Timur harus dilengkapi dengan :</td>
				</tr>
				
				<tr>
					<td style="font-size:7px;" width="6%" align="center"> 4.</td>
					<td style="font-size:7px;" width="94%" align="justify">Dilarang mengangkut dan menampung hasil tangkapan yang menggunakan bahan peledak/bahan berbahaya lainnya yang apabila dikonsumsi dapat mengganggu kesehatan manusia.</td>
				</tr>
				
				<tr>
					<td style="font-size:7px;" width="6%" align="center"> 5.</td>
					<td style="font-size:7px;" width="94%" align="justify">Pemegang izin diwajibkan melaporkan hasil kegiatan usaha setiap tahun kepada Kepala Kantor Pelayanan Perizinan Terpadu Satu Pintu Provinsi Nusa Tenggara Timur dengan tembusan ke Dinas Kelautan dan Perikanan Provinsi Nusa Tenggara Timur.</td>
				</tr>
				
				<tr>
					<td style="font-size:7px;" width="6%" align="center"> 6.</td>
					<td style="font-size:7px;" width="94%" align="justify">Apabila selama tiga tahun berturut-turut  tidak melaporkan hasil kegiatan usaha (sebagaimana pada point 5) maka SIUPnya akan dicabut.</td>
				</tr>
				
				<tr>
					<td style="font-size:7px;" width="6%" align="center"> 7.</td>
					<td style="font-size:7px;" width="94%" align="justify">Bagi perpanjangan SIUP, dengan dikeluarkannya SIUP yang baru maka SIUP yang lama akan dicabut dan dianggap tidak berlaku lagi.</td>
				</tr>
				
				<tr>
					<td style="border: 1px solid black;" width="100%" align="center"><strong>TEMBUSAN :</strong></td>
				</tr>
				
				<tr>
					<td style="font-size:7px; line-height:1.5;" width="100%" align="Left">{$tembusan}</td>
				</tr>
				
			</table>
		</td>
		
		<td width="45%">
			<table cellspacing="0" cellpadding="1" border="0">
				<tr>
					<td width="100%" align="Center"></td>
				</tr>
				
				<tr>
					<td width="100%" align="Center"><strong>REFERENSI</strong></td>
				</tr>
				
				<tr>
					<td width="100%" align="Center"></td>
				</tr>	
				
				<tr>
					<td style="border-top: 1px solid black;" width="100%" align="Left">SURAT PERMOHONAN SIUP : </td>
				</tr>
				
				<tr>
					<td width="30%" align="Left">NOMOR</td>
					<td width="4%" align="Center">:</td>
					<td width="66%" align="Left">{$nopermohonan}</td>
				</tr>
				
				<tr>
					<td width="30%" align="Left">TANGGAL</td>
					<td width="4%" align="Center">:</td>
					<td width="66%" align="Left">{$tglpermohonan}</td>
				</tr>
				
				<tr>
					<td style="border-top: 1px solid black;" width="100%" align="Left">Surat Rekomendasi Kepala Dinas Kelautan dan Perikanan PROV. NTT</td>
				</tr>
				
				<tr>
					<td width="30%" align="Left">NOMOR</td>
					<td width="4%" align="Center">:</td>
					<td width="66%" align="Left">{$norekprov}</td>
				</tr>
				
				<tr>
					<td width="30%" align="Left">TANGGAL</td>
					<td width="4%" align="Center">:</td>
					<td width="66%" align="Left">{$tglrekprov}</td>
				</tr>
				
				<tr>
					<td style="border: 1px solid black; "width="100%" align="Center"><strong>JENIS KEGIATAN</strong></td>
				</tr>
				
				<tr>
					<td style="font-size:3px;" width="100%" align="Center"></td>
				</tr>
				
				<tr>
					<td  style="font-size:11px;" width="100%" align="Center"><strong>{$jeniskegiatan}</strong></td>
				</tr>
				
				<tr>
					<td style="font-size:3px;" width="100%" align="Center"></td>
				</tr>
				
				<tr>
					<td style="font-size:5px;" width="100%" align="Center"></td>
				</tr>
				
				<tr>
					<td style="border: 1px solid black;" width="100%" align="Center"><strong>JENIS KOMODITI</strong></td>
				</tr>
				
				<tr>
					<td style="font-size:5px;" width="100%" align="Center"></td>
				</tr>
				
				<tr>
					<td style="font-size:10px;" width="100%" align="Center"><strong>{$jeniskomoditi}</strong></td>
				</tr>
				
				<tr>
					<td style="font-size:5px;" width="100%" align="Center"></td>
				</tr>
				
				<tr>
					<td style="border: 1px solid black;" width="100%" align="Center"><strong>KAPAL dan DAERAH USAHA</strong></td>
				</tr>
				
				<tr>
					<td width="100%" align="Center"></td>
				</tr>
				
				<tr>
					<td width="13%" align="Center"></td>
					<td width="25%" align="Left">Jumlah Kapal</td>
					<td width="2%" align="Center">:</td>
					<td width="55%" align="Left">{$jumlahkapal}</td>
				</tr>
				
				<tr>
					<td width="13%" align="Center"></td>
					<td width="25%" align="Left">Daerah Usaha</td>
					<td width="2%" align="Center">:</td>
					<td width="55%" align="Left">{$daerahusaha}</td>
					
				</tr>
				
				<tr>
					<td style="font-size:15px;" width="100%" align="Center"></td>
				</tr>
				
				<tr>
					<td style="border: 1px solid black;" width="100%" align="Center"><strong>MASA BERLAKU</strong></td>
				</tr>
				
				<tr>
					<td style="font-size:30px;" width="100%" align="Center"></td>
				</tr>
				
				
				<tr>
					<td style="font-size:14px;" width="100%" align="Center"><strong>{$berlakumulai}</strong></td>
				</tr>
				
				<tr>
					<td style="font-size:10px;" width="100%" align="Center"></td>
				</tr>
				
				<tr>
					<td style="font-size:14px;" width="100%" align="Center"><strong>S/D</strong></td>
				</tr>
				
				<tr>
					<td style="font-size:10px;" width="100%" align="Center"></td>
				</tr>
				
				<tr>
					<td style="font-size:14px;" width="100%" align="Center"><strong>{$berlakusampai}</strong></td>
				</tr>
				
				<tr>
					<td style="font-size:30px;" width="100%" align="Center"></td>
				</tr>
				
				<tr>
					<td style="border-top: 1px solid black;" width="100%" align="Center">Kupang, {$tgl}</td>
				</tr>
				
				<tr>
				<td width="100%" align="center">
					a.n. GUBERNUR NUSA TENGGARA TIMUR
				</td>
				</tr>
				
				<tr>
					<td width="100%" align="center">
						KEPALA KPPTSP PROVINSI NTT,
					</td>
				</tr>
				
				<tr>	
					<td style="font-size:30px;" width="100%" align="Center">
					</td>
				</tr>
				
				<tr>
					<td width="100%" align="center">
						<strong><u>{$namakepala}</u></strong>
					</td>
				</tr>
				
				<tr>
					<td width="100%" align="center">
						{$pangkatkepala}
					</td>
				</tr>
				
				<tr>
					<td width="100%" align="center">
						NIP. {$nipkepala}
					</td>
				</tr>
				
			</table>
		</td>
	</tr>
	<tr >
		<td width="100%">
			<table border="0">
			<tr>
			<td style="font-size:7px;" width="1%" align="Center"></td>
			<td style="font-size:7px;" width="98%" align="left">Apabila ada data atau informasi dan atau dokumen pendukung penerbitan izin ini ternyata dikemudian hari  tidak benar dan atau absah yang dinyatakan oleh instansi yang berwenang menerbitkan dokumen tersebut maka izin ini akan dicabut.</td>
			<td style="font-size:7px;" width="1%" align="Center"></td>
			</tr>
			</table>
		</td>
	</tr>

</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
//-----------------------------------------------------------------------------

// use the font
$pdf->SetFont('helvetica', '',7 );
$tbl = <<<EOD
<table  cellspacing="0" cellpadding="0" border="0">

    <tr>
       <td style="text-align:left;">KODE  DAN  NO. SERI : API 16</td>
    </tr>
	
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------

$fontname = TCPDF_FONTS::addTTFfont('../fonts/fre3of9x.ttf', 'TrueTypeUnicode', '', 96);

// use the font
$pdf->SetFont($fontname, '', 20, '', false);

// $pdf->SetFont('helvetica', '',7 );
$tbl = <<<EOD
<table cellspacing="0" cellpadding="-1" border="0">

    <tr>
		<td width="100%" align="Right">SIPPTNTT</td>
    </tr>
	
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
// 
//Close and output PDF document
$pdf->Output('ppklpa.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
