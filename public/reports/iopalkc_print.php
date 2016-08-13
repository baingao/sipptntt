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
	
	$stmt = $db->connect()->query("select iopalkc.NoReg, iopalkc.Nomor, iopalkc.Tgl, iopalkc.RekNakertransKabNo, iopalkc.RekNakertransKabTgl, 
		iopalkc.RekNakertransProvNo, iopalkc.RekNakertransProvTgl, iopalkc.SKPerusahaanNo, iopalkc.SKPerusahaanTgl,iopalkc.SKPerusahaanHal,
		iopalkc.SurPerusahaanNo,iopalkc.SurPerusahaanTgl,iopalkc.SurPerusahaanHal, iopalkc.NamaPerusahaan, iopalkc.NamaKaCab, 
		iopalkc.AlamatCabLama, iopalkc.AlamatCabBaru,iopalkc.AlamatCabUtama,iopalkc.WilayahOperasional,iopalkc.BerlakuSampai, iopalkc.Tembusan
		from iopalkc inner join register on iopalkc.NoReg=register.AI 
		where iopalkc.NoReg={$noreg}");
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$noreg = $result['NoReg']; 
	$nomor = $result['Nomor'];
	$tgl = InputSelect::parseDate($result['Tgl']);
	$reknakertranskabno = $result['RekNakertransKabNo'];
	$reknakertranskabtgl = InputSelect::parseDate($result['RekNakertransKabTgl']);
	$reknakertransprovno = $result['RekNakertransProvNo'];
	$reknakertransprovtgl = InputSelect::parseDate($result['RekNakertransProvTgl']);
	$skperusahaanno = $result['SKPerusahaanNo'];
	$skperusahaantgl = InputSelect::parseDate($result['SKPerusahaanTgl']);
	$skperusahaanhal = $result['SKPerusahaanHal'];
	$surperusahaanno = $result['SurPerusahaanNo'];
	$surperusahaantgl = InputSelect::parseDate($result['SurPerusahaanTgl']);
	$surperusahaanhal = $result['SurPerusahaanHal'];
	$namaperusahaan = $result['NamaPerusahaan'];
	$namaperusahaan2 = strtoupper ($result['NamaPerusahaan']);
	$namakacab = $result['NamaKaCab'];
	$alamatcablama = $result['AlamatCabLama'];
	$alamatcabbaru = $result['AlamatCabBaru'];
	$alamatcabutama = $result['AlamatCabUtama'];
	$wilayahoperasional = $result['WilayahOperasional'];
	$berlakusampai = InputSelect::parseDate($result['BerlakuSampai']);
	$tembusan = $result['Tembusan'];
	
// create new PDF document//
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  
// add a page
$resolution= array(210, 340);
$pdf->setPrintHeader(false);
$pdf->SetMargins(20,30,20);
$pdf->AddPage('P', $resolution);

// convert TTF font to TCPDF format and store it on the fonts folder
//$fontname = TCPDF_FONTS::addTTFfont('font/Tahoma.ttf', 'TrueTypeUnicode', '', 96);

// use the font
$pdf->SetFont('helvetica', 'B',9 );

//$pdf->SetFont('Tahoma', '', 9);

// -----------------------------------------------------------------------------

$tbl = <<<EOD
<table  cellspacing="0" cellpadding="0" border="0">

    <tr>
       <td style="text-align:center;"><strong>KEPUTUSAN</strong> </td>
    </tr>
	
	<tr>
       <td style="text-align:center;"><strong>KEPALA KANTOR PELAYANAN PERIZINAN TERPADU SATU PINTU</strong> </td>
    </tr>
	
	<tr>
       <td style="text-align:center;"><strong>PROVINSI NUSA TENGGARA TIMUR</strong></td>
    </tr>
	
	<tr>
       <td style="text-align:center;">NOMOR : {$nomor}</td>
    </tr>
	
	<tr>
       <td style="text-align:center;"><strong>TENTANG</strong></td>
    </tr>
	
	<tr>
       <td style="text-align:center;"><strong> PERPANJANGAN  IZIN OPERASIONAL DAN PERPINDAHAN ALAMAT KANTOR CABANG PPTKIS : </strong></td>
    </tr>
	
	<tr>
       <td style="text-align:center;"><strong> {$namaperusahaan2}</strong></td>
    </tr>
	
	<tr>
       <td style="text-align:center;"><strong>DI KOTA KUPANG PROVINSI NUSA TENGGARA TIMUR</strong></td>
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------
// convert TTF font to TCPDF format and store it on the fonts folder
//$fontname = TCPDF_FONTS::addTTFfont('font/Tahoma.ttf', 'TrueTypeUnicode', '', 96);

// use the font
//$pdf->SetFont($fontname, '', 9, '', false);
$pdf->SetFont('helvetica', '',8 );
$tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="0">

    <tr>
		<td width="18%" align="Left">MENIMBANG</td>
		<td width="2%" align="Center">:</td>
		<td width="2%" align="Center">1.</td>
		<td width="78%" align="Justify">
			<p>Bahwa untuk kelancaran pelaksanaan tugas {$namaperusahaan} di Nusa Tenggara Timur, maka perlu di dirikan Kantor Cabang di Kota Kupang Nusa Tenggara Timur;</p>
		</td>
    </tr>
	
	<tr>
		<td width="18%" align="Left"></td>
		<td width="2%" align="Center">:</td>
		<td width="2%" align="Center">2.</td>
		<td width="78%" align="Justify">
			<p >Bahwa untuk kelancaran pelaksanaan tugas di Kantor Cabang Kota Kupang perlu diangkat Kepala Kantor Cabang {$namaperusahaan} yang berkedudukan di Kota Kupang dan bertugas melaksanakan kegiatan atas perintah Kantor Pusat.</p>
		</td>
    </tr>
	
	<tr>
		<td width="18%" align="Left">MENGINGAT</td>
		<td width="2%" align="Center">:</td>
		<td width="2%" align="Center">1.</td>
		<td width="78%" align="Justify">
			<p >Undang-undang Nomor 39 Tahun 2004 tentang Penempatan dan Perlindungan Tenaga Kerja Indonesia di Luar Negeri;</p>
		</td>
    </tr>
	
	<tr>
		<td width="18%" align="Left"></td>
		<td width="2%" align="Center"></td>
		<td width="2%" align="Center">2.</td>
		<td width="78%" align="Justify">
			<p >Peraturan Menteri Tenaga Kerja dan Transmigrasi Republik Indonesia Nomor : PER. 09/MEN/V/2009 tanggal 07 Mei 2009 tentang Tata Cara Pembentukan Kantor Cabang Pelaksana Penempatan Tenaga Kerja Indonesia Swasta (PPTKIS);</p>
		</td>
    </tr>
	<tr>
		<td width="18%" align="Left"></td>
		<td width="2%" align="Center"></td>
		<td width="2%" align="Center">3.</td>
		<td width="78%" align="Justify">
			<p >Keputusan Menteri Tenaga  Kerja dan Transmigrasi RI Nomor : 163 Tahun 2013 tanggal 1 Mei 2013 tentang Perpanjangan Surat Izin Pelaksanaan Penempatan Tenaga Kerja Indonesia {$namaperusahaan};</p>
		</td>
    </tr>
	
	<tr>
		<td width="18%" align="Left"></td>
		<td width="2%" align="Center"></td>
		<td width="2%" align="Center">4.</td>
		<td width="78%" align="Justify">
			<p >Peraturan Gubernur Nusa Tenggara Timur Nomor : 5 Tahun 2016 Tanggal 14 Januari 2016 tentang Pendelegasian Wewenang dari Gubernur kepada Kepala KPPTSP untuk Menandatangani Perizinan dan Non Perizinan di Lingkungan Pemerintah Provinsi Nusa Tenggara Timur;</p>
		</td>
    </tr>
	
	<tr>
		<td width="18%" align="Left"></td>
		<td width="2%" align="Center">:</td>
		<td width="2%" align="Center">5.</td>
		<td width="78%" align="Justify">
			<p >Peraturan Daerah Provinsi Nusa Tenggara Timur Nomor : 6 Tahun 2011 Tentang Sumbangan Pihak Ketiga Kepada Daerah;</p>
		</td>
    </tr>
	
	<tr>
		<td width="18%" align="Left"></td>
		<td width="2%" align="Center"></td>
		<td width="2%" align="Center">6.</td>
		<td width="78%" align="Justify">
			<p >Surat Keputusan Direktur  {$namaperusahaan} tentang {$surperusahaanhal} Nomor : {$surperusahaanno} tanggal {$surperusahaantgl};</p>
		</td>
    </tr>
	
	<tr>
		<td width="18%" align="Left"></td>
		<td width="2%" align="Center"></td>
		<td width="2%" align="Center">7.</td>
		<td width="78%" align="Justify">
			<p >	Surat Rekomendasi dari Kepala Dinas Tenaga Kerja dan Transmigrasi Kota Kupang Nomor : {$reknakertranskabno}  tanggal {$reknakertranskabtgl} dan Rekomendasi Kepala Dinas Tenaga Kerja dan Transmigrasi Provinsi Nusa Tenggara Timur Nomor : {$reknakertransprovno}  tanggal {$reknakertransprovtgl}.</p>
		</td>
    </tr>
	
	<tr>
		<td width="18%" align="Left">MEMPERHATIKAN</td>
		<td width="2%" align="Center">:</td>
		<td width="2%" align="Center"></td>
		<td width="78%" align="Justify">
			<p >Surat Direktur Utama Pelaksana Penempatan Tenaga Kerja Indonesia  {$namaperusahaan}   Nomor :  {$surperusahaanno} tanggal {$surperusahaantgl}, Perihal {$surperusahaanhal}.</p>
		</td>
    </tr>
	
	<tr>
		<td width="100%" align="Center">MEMUTUSKAN</td>
    </tr>
	
    <tr>
		<td width="13%" align="Left">MENETAPKAN</td>
		<td width="4%" align="Center">:</td>
		<td width="83%" align="Justify">
		</td>
    </tr>
	
	<tr>
		<td width="13%" align="Left">PERTAMA</td>
		<td width="4%" align="Center">:</td>
		<td width="83%" align="Justify">
		Memberikan Persetujuan Permohonan Perpanjangan Izin Operasional dan Perpindahan Alamat Kantor  Cabang Pelaksana Penempatan Tenaga Kerja Indonesia Swasta :
		</td>
    </tr>
	
	<tr>
		<td width="17%" align="Left">PERTAMA</td>
		<td width="28%" align="Justify">
			Nama PPTKIS
		</td>
		
		<td width="2%" align="Center">:</td>
		
		<td width="53%" align="Justify"><strong>{$namaperusahaan2}</strong></td>
    </tr>
	
	<tr>
		<td width="17%" align="Left"></td>
		<td width="28%" align="Justify">
			Nama Kepala Cabang
		</td>
		
		<td width="2%" align="Center">:</td>
		<td width="53%" align="Justify"><strong>{$namakacab}</strong></td>
    </tr>
	
	<tr>
		<td width="17%" align="Left"></td>
		<td width="28%" align="Justify">
			Alamat Kantor Cabang Lama
		</td>
		
		<td width="2%" align="Center">:</td>
		<td width="53%" align="Justify">{$alamatcablama}</td>
    </tr>
	
	
	<tr>
		<td width="17%" align="Left"></td>
		<td width="28%" align="Justify">
			Alamat Kantor Cabang Baru
		</td>
		
		<td width="2%" align="Center">:</td>
		<td width="53%" align="Justify">{$alamatcabbaru}</td>
    </tr>
	
	<tr>
		<td width="17%" align="Left"></td>
		<td width="28%" align="Justify">
			Wilayah Operasional
		</td>
		
		<td width="2%" align="Center">:</td>
		<td width="53%" align="Justify">{$wilayahoperasional}</td>
    </tr>
	

	<tr>
		<td width="13%" align="Left">KEDUA</td>
		<td width="4%" align="Center">:</td>
		<td width="83%" align="Justify">
		Seluruh Kegiatan Kantor Cabang tetap menjadi tanggung jawab {$namaperusahaan}  dengan alamat {$alamatcabutama}
		</td>
    </tr>
	
	<tr>
		<td width="13%" align="Left">KETIGA</td>
		<td width="4%" align="Center">:</td>
		<td width="83%" align="Justify">
		Izin Operasional ini berlaku sejak tanggal ditetapkan sampai dengan tanggal  {$berlakusampai} dan sewaktu-waktu dapat dicabut sebelum masa berlakunya berakhir apabila ternyata ada penyimpangan dari ketentuan yang berlaku;
		</td>
    </tr>
	
	<tr>
		<td width="13%" align="Left">KEEMPAT</td>
		<td width="4%" align="Center">:</td>
		<td width="83%" align="Justify">
		Keputusan ini mulai berlaku sejak tanggal ditetapkan dengan ketentuan apabila dikemudian hari terdapat kekeliruan dalam Keputusan ini akan diperbaiki/diubah sebagaimana mestinya.
		</td>
    </tr>
	
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------
$stmt = $db->connect()->query("select config.NamaTTD1, config.NIPTTD1, config.PangkatTTD1 from config where config.AI=1");
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	$namakepala = $result['NamaTTD1'];
	$nipkepala = $result['NIPTTD1'];
	$pangkatkepala = $result['PangkatTTD1'];
	
// convert TTF font to TCPDF format and store it on the fonts folder
//$fontname = TCPDF_FONTS::addTTFfont('font/Tahoma.ttf', 'TrueTypeUnicode', '', 96);

// use the font
//$pdf->SetFont($fontname, '', 8, '', false);
$pdf->SetFont('helvetica', '',8 );
$tbl = <<<EOD
<table cellspacing="0" cellpadding="0" border="0">

    <tr>
	
		<td width="53%" align="Right"></td>
		
		<td width="13%" align="Left">
			Ditetapkan di
		</td>
		
		<td width="2%" align="Center">
			:
		</td>
		
		<td width="32%" align="Left">
			Kupang
		</td>
    </tr>
	
	<tr>
		<td width="53%" align="Right"></td>
		
		<td width="13%" align="Left">
			Pada Tanggal
		</td>
		
		<td width="2%" align="Center">
			:
		</td>
		
		<td width="32%" align="Left">
			{$tgl}
		</td>
    </tr>
	
	<tr>
		<td width="100%" align="center"></td>
    </tr>
	
	<tr>
		<td width="45%" align="Right">
		</td>
		<td width="40%" align="center">
			a.n. GUBERNUR NUSA TENGGARA TIMUR
		</td>
		<td width="15%" align="center"></td>
    </tr>
	
	<tr>
		<td width="45%" align="Right">

		</td>
		<td width="40%" align="center">
			KEPALA KPPTSP PROVINSI NTT,
		</td>
		<td width="15%" align="center"></td>
    </tr>
	
	<tr>
		<td width="85%" align="Center">

			<img style="margin-top:5px;" src="../images/pasfoto.png" height="40">
		</td>
		<td width="15%" align="center"></td>
    </tr>
	
	<tr>
		<td width="45%" align="Right">

		</td>
		<td width="40%" align="center">
			<strong><u>{$namakepala}</u></strong>
		</td>
		<td width="15%" align="center"></td>
    </tr>
	
	<tr>
		<td width="45%" align="Right">

		</td>
		<td width="40%" align="center">
			{$pangkatkepala}
		</td>
		<td width="15%" align="center"></td>
    </tr>
	
	<tr>
		<td width="45%" align="Right">

		</td>
		<td width="40%" align="center">
			NIP. {$nipkepala}
		</td>
		<td width="15%" align="center"></td>
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
// -----------------------------------------------------------------------------
// convert TTF font to TCPDF format and store it on the fonts folder
//$fontname = TCPDF_FONTS::addTTFfont('font/Tahoma.ttf', 'TrueTypeUnicode', '', 96);

// use the font
//$pdf->SetFont($fontname, '', 7, '', false);

$pdf->SetFont('helvetica', '',7 );
$tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="0">

    <tr>
		<td width="55%" align="Left">Tembusan :</td>
		<td width="45%" align="Left"></td>
    </tr>
	
	<tr>
		<td width="55%" align="Left">{$tembusan}</td>
		<td width="45%" align="Left"></td>
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
// -----------------------------------------------------------------------------

//Close and output PDF document
$pdf->Output('ppklpa.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
