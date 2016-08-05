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
require_once "includes.php";
require_once INCLUDES_PATH.DS."tcpdf/examples/tcpdf_include.php";
session_start();
	
	//$noreg=$_SESSION["PRINT_KEY"];
	$noreg=239;
	$db = new DbConnect();
	
	$stmt = $db->connect()->query("select siupbm.NoReg,  siupbm.Tgl, siupbm.Nomor, siupbm.RekDishubProvNo, siupbm.RekDishubProvTgl, siupbm.SurPerusahaanNo,
		siupbm.SurPerusahaanTgl, siupbm.NamaPerusahaan, siupbm.AlmtPerusahaan, siupbm.PenJawabLama, siupbm.AlmtPenJawabLama,
		siupbm.PenJawabBaru, siupbm.AlmtPenJawabBaru, siupbm.NPWP, siupbm.Tembusan,
		register.NamaPemohon
		from siupbm inner join register on siupbm.NoReg=register.AI 
		where siupbm.NoReg={$noreg}");
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$noreg = $result['NoReg']; 
	$nomor = $result['Nomor'];
	$tgl = InputSelect::ParseDate($result['Tgl']);
	$namaperusahaan1 = $result['NamaPerusahaan'];
	$namaperusahaan2 = strtoupper($result['NamaPerusahaan']);
	$nosurperusahaan = $result['SurPerusahaanNo'];
	$tglsurperusahaan = InputSelect::ParseDate($result['SurPerusahaanTgl']);
	$rekdishubprovno = $result['RekDishubProvNo'];
	$rekdishubprovtgl = InputSelect::ParseDate($result['RekDishubProvTgl']);
	$almtperusahaan = $result['AlmtPerusahaan'];
	$penjawablama = $result['PenJawabLama'];
	$penjawabbaru = $result['PenJawabBaru'];
	$almtpenjawablama = $result['AlmtPenJawabLama'];
	$almtpenjawabbaru = $result['AlmtPenJawabBaru'];
	$npwp = $result['NPWP'];
	$tembusan = $result['Tembusan'];

// create new PDF document//
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  
// add a page
$resolution= array(210, 330);
$pdf->setPrintHeader(false);
$pdf->SetMargins(20,35,20);
$pdf->AddPage('P', $resolution);

$pdf->SetFont('helvetica', 'B', 11);

// -----------------------------------------------------------------------------

$tbl = <<<EOD
<table  cellspacing="0" cellpadding="1" border="0">

    <tr>
       <td style="text-align:center;">SURAT IZIN USAHA PERUSAHAAN BONGKAR MUAT (SIUPBM)</td>
    </tr>
	
	<tr>
       <td style="text-align:center;">NOMOR : {$nomor} </td>
    </tr>

</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------
$pdf->SetFont('helvetica', '',10 );
$tbl = <<<EOD
<table cellspacing="0" cellpadding="3" border="0">

    <tr>

		<td width="100%" align="Justify">
			<p style="line-height:1.5">Berdasarkan surat permohonan {$namaperusahaan2} Nomor : {$nosurperusahaan} tanggal {$tglsurperusahaan} dan Rekomendasi Kepala Dinas Perhubungan Propinsi NTT Nomor : {$rekdishubprovno} Tanggal {$rekdishubprovtgl}, maka diberikan Persetujuan untuk Penanggung jawab dalam Surat Izin Usaha Perusahaan Bongkar Muat (SIUPBM), kepada :</p>
		</td>
    </tr>

    <tr>
		<td width="5%" align="center"></td>
		<td width="32%" align="Left">
			Nama Perusahaan
		</td>
		<td width="2%" align="center">:</td>
		<td width="56%" align="Left">
			{$namaperusahaan1}
		</td>
		<td width="5%" align="center"></td>
    </tr>
	
	<tr>
		<td width="5%" align="center"></td>
		<td width="32%" align="Left">
			Alamat Perusahaan
		</td>
		<td width="2%" align="center">:</td>
		<td width="56%" align="Left">
			{$almtperusahaan}
		</td>
		<td width="5%" align="center"></td>
    </tr>
	
	<tr>
		<td width="5%" align="center"></td>
		<td width="32%" align="Left">
			Penanggung Jawab Lama
		</td>
		<td width="2%" align="center">:</td>
		<td width="56%" align="Left">
			{$penjawablama}
		</td>
		<td width="5%" align="center"></td>
    </tr>
	
	<tr>
		<td width="5%" align="center"></td>
		<td width="32%" align="Left">
			Alamat
		</td>
		<td width="2%" align="center">:</td>
		<td width="56%" align="Left">
			{$almtpenjawablama}
		</td>
		<td width="5%" align="center"></td>
    </tr>
	
	<tr>
		<td width="5%" align="center"></td>
		<td width="32%" align="Left">
			Penanggung Jawab Baru
		</td>
		<td width="2%" align="center">:</td>
		<td width="56%" align="Left">
			{$penjawabbaru}
		</td>
		<td width="5%" align="center"></td>
    </tr>

	
	<tr>
		<td width="5%" align="center"></td>
		<td width="32%" align="Left">
			Alamat
		</td>
		<td width="2%" align="center">:</td>
		<td width="56%" align="Left">
			{$almtpenjawabbaru}
		</td>
		<td width="5%" align="center"></td>
    </tr>
	
	<tr>
		<td width="5%" align="center"></td>
		<td width="32%" align="Left">
			Nomor Wajib Pajak
		</td>
		<td width="2%" align="center">:</td>
		<td width="56%" align="Left">
			{$npwp}
		</td>
		<td width="5%" align="center"></td>
    </tr>
	
	
    <tr>
		<td width="100%" align="Justify">
			<strong style="line-height:1.5">Kewajiban Pemegang SIUPBM :</strong>
		</td>
    </tr>
	
	<tr>
		<td width="3%" align="Justify">1.</td>
		<td width="97%" align="Justify">
		Mematuhi seluruh peraturan perundang-undangan yang berlaku di bidang angkutan di perairan, kepelabuhan dan lingkungan hidup. </td>
	</tr>
	
	<tr>
		<td width="3%" align="Justify">2.</td>
		<td width="97%" align="Justify">
			Bertanggung jawab atas kebenaran laporan kegiatan operasional perusahaan yang disampaikan kepada Gubernur NTT Cq. Kepala Dinas Perhubungan Provinsi Nusa Tenggara Timur.</td>
	</tr>
	
	<tr>
		<td width="3%" align="Justify">3.</td>
		<td width="97%" align="Justify">
		Melaporkan secara tertulis kepada Gubernur NTT, Setiap kali terjadi perubahan maksud dan tujuan perusahaan, Direksi / Komisaris, nama dan alamat perusahaan, Nomor Pokok Wajib Pajak (NPWP) perusahaan dan kepemilikan peralatan bongkar muat.</td>
	</tr>
	
	<tr>
		<td width="3%" align="Justify">4.</td>
		<td width="97%" align="Justify">
		Menyampaikan laporan bulanan dan tahunan kegiatan operasional Perusahaan kepada Gubernur NTT dengan tembusan kepada Kepala Dinas Perhubungan Provinsi NTT.</td>
	</tr>
	
	 <tr>
		<td width="100%" align="Justify">
			Surat Izin Usaha Perusahaan Bongkar Muat (SIUPBM) ini dapat dicabut apabila pemegang surat izin usaha tidak mematuhi kewajiban dalam surat izin usaha dan/atau melakukan tindak pidana yang bersangkutan dengan kegiatan usahanya dan perusahaan menyatakan membubarkan diri berdasarkan keputusan dari instansi yang berwenang.
		</td>
    </tr>
	
	<tr>
		<td width="100%" align="Justify">
			Surat Izin Usaha ini berlaku untuk Pelabuhan Waingapu, Pelabuhan Kalabahi dan Pelabuhan Ende di Provinsi Nusa Tenggara Timur selama perusahaan yang bersangkutan masih menjalankan kegiatan usahanya.
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
	
$pdf->SetFont('helvetica', '',9 );
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
		<td width="45%" align="Center">
		PENANGGUNG JAWAB,
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
		<td width="100%" align="Right">
		</td>
    </tr>
	<tr>
		<td width="100%" align="Right">
		</td>
    </tr>
	<tr>
		<td width="100%" align="Right">
		</td>
    </tr>
	<tr>
		<td width="100%" align="Right">
		</td>
    </tr>
	
	<tr>
		<td width="45%" align="Center">
			<strong><u></u></strong>
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
$pdf->SetFont('helvetica', '',8 );
$tbl = <<<EOD
<table cellspacing="0" cellpadding="0" border="0">

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
$pdf->Output('example_048.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
