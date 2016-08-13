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
	$noreg=240;
	$db = new DbConnect();
	
	$stmt = $db->connect()->query("select ppklpa.NoReg,ppklpa.Nomor, ppklpa.Tgl, ppklpa.Alamat, ppklpa.NoSurat,ppklpa.TglSurat,ppklpa.HalSurat,
		ppklpa.RekDishubProvNo, ppklpa.RekDishubProvTgl, ppklpa.NamaPerusahaan, ppklpa.AlmtPerusahaan, ppklpa.NamaPemilik,ppklpa.NPWP,
		ppklpa.NomorSIUAP, ppklpa.NamaKapal, ppklpa.BerlakuMulai, ppklpa.BerlakuSelesai, ppklpa.PadaLintas, ppklpa.Tembusan,
		register.NamaPemohon
		from ppklpa inner join register on ppklpa.NoReg=register.AI 
		where ppklpa.NoReg={$noreg}");
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$noreg = $result['NoReg']; 
	$nomor = $result['Nomor'];
	$nama = $result['NamaPemohon'];
	$tgl = InputSelect::parseDate($result['Tgl']);
	$alamat = $result['Alamat'];
	$nosurat = $result['NoSurat']; 
	$tglsurat = InputSelect::parseDate($result['TglSurat']);
	$halsurat = $result['HalSurat'];
	$rekdishubno = $result['RekDishubProvNo'];
	$rekdishubtgl = InputSelect::parseDate($result['RekDishubProvTgl']);
	$namaperusahaan=$result['NamaPerusahaan'];
	$namaperusahaan2=strtoupper($result['NamaPerusahaan']);
	$alamatperusahaan = $result['AlmtPerusahaan'];
	$namapemilik = $result['NamaPemilik'];
	$npwp = $result['NPWP'];
	$nosiuap = $result['NomorSIUAP'];
	$namakapal = $result['NamaKapal'];
	$padalintas = $result ['PadaLintas'];
	$berlakumulai =  InputSelect::parseDate($result['BerlakuMulai']);
	$berlakuselesai = InputSelect:: parseDate($result['BerlakuSelesai']);
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

// convert TTF font to TCPDF format and store it on the fonts folder
$fontname = TCPDF_FONTS::addTTFfont('font/Tahoma.ttf', 'TrueTypeUnicode', '', 96);

// use the font
$pdf->SetFont($fontname, '', 9, '2', false);

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
       <td style="text-align:center;"><strong>PERSETUJUAN PENGOPERASIAN KAPAL UNTUK LINTAS PENYEBERANGAN ANTAR KABUPATEN / KOTA DALAM PROVINSI </strong></td>
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------
// convert TTF font to TCPDF format and store it on the fonts folder
$fontname = TCPDF_FONTS::addTTFfont('font/Tahoma.ttf', 'TrueTypeUnicode', '', 96);

// use the font
$pdf->SetFont($fontname, '', 9, '', false);
$tbl = <<<EOD
<table cellspacing="0" cellpadding="0" border="0">

    <tr>

		<td width="100%" align="Justify">
			<p style="line-height:1.5">Berdasarkan surat Direktur Utama {$namaperusahaan} Nomor : {$nosurat} Tanggal  {$tglsurat} tentang {$halsurat} dan Rekomendasi Kepala Dinas Perhubungan Provinsi Nusa Tenggara Timur Nomor: {$rekdishubno} tanggal {$rekdishubtgl}, maka diberikan Persetujuan Pengoperasian Kapal Angkutan Penyeberangan kepada :</p>
		</td>
    </tr>

    <tr>
		<td width="5%" align="center"></td>
		<td width="34%" align="Left">
			NAMA KAPAL
		</td>
		<td width="2%" align="center">:</td>
		<td width="59%" align="Left">
			<strong>{$namakapal}</strong>
		</td>
		
    </tr>
	
	<tr>
		<td width="5%" align="center"></td>
		<td width="34%" align="Left">
			PADA LINTAS
		</td>
		<td width="2%" align="center">:</td>
		<td width="59%" align="Left">
			{$padalintas}
		</td>
    </tr>
	
	<tr>
		<td width="5%" align="center"></td>
		<td width="34%" align="Left">
			NAMA PERUSAHAAN
		</td>
		<td width="2%" align="center">:</td>
		<td width="59%" align="Left">
			<strong>{$namaperusahaan}</strong>
		</td>
    </tr>
	
	<tr>
		<td width="5%" align="center"></td>
		<td width="34%" align="Left">
			ALAMAT KANTOR PERUSAHAAN
		</td>
		<td width="2%" align="center">:</td>
		<td width="59%" align="Left">
			{$alamatperusahaan}
		</td>
    </tr>
	
	<tr>
		<td width="5%" align="center"></td>
		<td width="34%" align="Left">
			NAMA PEMILIK / PENANGGUNG JAWAB
		</td>
		<td width="2%" align="center">:</td>
		<td width="59%" align="Left">
			<strong>{$namaperusahaan2} / {$namapemilik}</strong>
		</td>
    </tr>

	
	<tr>
		<td width="5%" align="center"></td>
		<td width="34%" align="Left">
			NOMOR POKOK WAJIB PAJAK (NPWP)
		</td>
		<td width="2%" align="center">:</td>
		<td width="59%" align="Left">
			{$npwp}
		</td>
    </tr>
	
	<tr>
		<td width="5%" align="center"></td>
		<td width="34%" align="Left">
			NOMOR SURAT IZIN USAHA ANGKUTAN	PENYEBERANGAN (SIUAP)
		</td>
		<td width="2%" align="center">:</td>
		<td width="59%" align="Left">
			{$nosiuap}
		</td>
    </tr>
	
	
    <tr>
		<td width="100%" align="Justify">
			KEWAJIBAN PEMEGANG SURAT PERSETUJUAN PENGOPERASIAN KAPAL ANGKUTAN PENYEBERANGAN :
		</td>
    </tr>
	
	<tr>
		<td width="3%" align="Justify">1.</td>
		<td width="97%" align="Justify">
		Memiliki Izin Usaha yang sah.</td>
	</tr>
	
	<tr>
		<td width="3%" align="Justify">2.</td>
		<td width="97%" align="Justify">
			Menyelenggarakan pelayaran penyeberangan menurut jadwal pelayaran, mengumumkan dan melaksanakan ketentuan tarif angkutan penyeberangan yang ditetapkan.</td>
	</tr>
	
	<tr>
		<td width="3%" align="Justify">3.</td>
		<td width="97%" align="Justify">
		Selambat – lambatnya dalam waktu 1 (satu) bulan melakukan kegiatan secara nyata.</td>
	</tr>
	
	<tr>
		<td width="3%" align="Justify">4.</td>
		<td width="97%" align="Justify">
		Mengoperasikan kapal motor penyeberangan yang bersangkutan.</td>
	</tr>
	
	<tr>
		<td width="3%" align="Justify">5.</td>
		<td width="97%" align="Justify">
		Mematuhi penggunaan dermaga ataupun tempat pendaratan lain yang ditetapkan oleh pihak-pihak lain yang berwenang.</td>
	</tr>
	
	<tr>
		<td width="3%" align="Justify">6.</td>
		<td width="97%" align="Justify">
		Menjamin keselamatan dan kelancaran naik turunnya penumpang, barang, hewan, kendaraan dan muatan lainnya termasuk menyediakan ruangan untuk pos.</td>
	</tr>
	
	<tr>
		<td width="3%" align="Justify">7.</td>
		<td width="97%" align="Justify">
		Menghindarkan segala sesuatu yang dapat menimbulkan pencermaran lingkungan.</td>
	</tr>
	
	<tr>
		<td width="3%" align="Justify">8.</td>
		<td width="97%" align="Justify">
		Melaporkan kegiatan operasional kepada Direktur Jenderal Perhubungan Darat, Gubernur Nusa Tenggara Timur Cq. Kepala Dinas Perhubungan Prov. Nusa Tenggara Timur dan waktu yang telah ditentukan.</td>
	</tr>
	
	<tr>
		<td width="3%" align="Justify">9.</td>
		<td width="97%" align="Justify">
		Wajib melakukan Registrasi Ulang Setiap Tahun (12 bulan) pada tanggal jatuh tempo 27 November tahun berjalan Surat Persetujuan Pengoperasian Kapal Penyeberangan kepada Gubernur Cq. Kepala Kantor Pelayanan Perizinan Terpadu Satu Pintu Provinsi Nusa Tenggara Timur.</td>
	</tr>
	 <tr>
		<td width="100%" align="Justify">
			Surat Persetujuan Pengoperasian Kapal Angkutan Penyeberangan ini dapat ditinjau kembali atau dicabut, apabila pemegang persetujuan tidak mematuhi kewajiban dalam surat persetujuan pengoperasian kapal penyeberangan ini, dan / atau melakukan tindak pidana oleh yang bersangkutan dengan kegiatannya.<br>
			Surat Persetujuan Pengoperasian Kapal Penyeberangan ini berlaku sejak tanggal {$berlakumulai} sampai dengan tanggal {$berlakuselesai}.

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
	
// convert TTF font to TCPDF format and store it on the fonts folder
$fontname = TCPDF_FONTS::addTTFfont('font/Tahoma.ttf', 'TrueTypeUnicode', '', 96);

// use the font
$pdf->SetFont($fontname, '', 9, '', false);
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
		<td width="45%" align="Center">
			{$namaperusahaan2}
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
		<td width="45%" align="Center">
			<strong><u>{$namapemilik}</u></strong>
		</td>
		<td width="40%" align="center">
			<strong><u>{$namakepala}</u></strong>
		</td>
		<td width="15%" align="center"></td>
    </tr>
	
	<tr>
		<td width="45%" align="Center">
			DIREKTUR UTAMA 
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
$fontname = TCPDF_FONTS::addTTFfont('font/Tahoma.ttf', 'TrueTypeUnicode', '', 96);

// use the font
$pdf->SetFont($fontname, '', 7, '', false);
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
