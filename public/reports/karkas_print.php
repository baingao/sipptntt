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
	
	$stmt = $db->connect()->query("select karkas.AI, karkas.NoReg, karkas.Nomor, karkas.Tgl, karkas.Nama, karkas.Alamat, karkas.SertAvianDari, karkas.SertAvianNo,
		karkas.SertAvianTgl, karkas.RekKabDari, karkas.RekKabNo, karkas.RekKabTgl,karkas.RekKabHal, karkas.RekProvDari, karkas.RekProvNo,
		karkas.RekProvTgl, karkas.RekProvHal, karkas.SurPerusahaanNo, karkas.SurPerusahaanTgl, karkas.SurPerusahaanHal,
		karkas.NamaPerusahaan, karkas.AlmtPerusahaan, karkas.Telepon, karkas.NamaPerusahaanAsal, karkas.ProvinsiAsal, karkas.AlatAngkut, 
		karkas.PelabuhanBongkar, karkas.BerlakuSelesai, karkas.Tembusan
		from karkas inner join register on karkas.NoReg=register.AI 
		where karkas.NoReg={$noreg}");
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$aikarkas = $result['AI']; 
	$noreg = $result['NoReg']; 
	$nomor = $result['Nomor'];
	$tgl = InputSelect::parseDate($result['Tgl']);
	$nama = $result['Nama']; 
	$alamat = $result['Alamat'];
	$sertaviandari = $result['SertAvianDari']; 
	$sertavianno = $result['SertAvianNo'];
	$sertaviantgl = InputSelect::parseDate($result['SertAvianTgl']); 
	$rekkabdari = $result['RekKabDari'];
	$rekkabno = $result['RekKabNo']; 
	$rekkabtgl = InputSelect::parseDate($result['RekKabTgl']);
	$rekkabhal = $result['RekKabHal']; 
	$rekprovdari = $result['RekProvDari'];
	$rekprovno = $result['RekProvNo']; 
	$rekprovtgl = InputSelect::parseDate($result['RekProvTgl']);
	$rekprovhal = $result['RekProvHal'];
	$perusahaanno = $result['SurPerusahaanNo']; 
	$perusahaantgl = InputSelect::parseDate($result['SurPerusahaanTgl']);
	$perusahaanhal = $result['SurPerusahaanHal'];
	$namaperusahaan = $result['NamaPerusahaan']; 
	$almtperusahaan = $result['AlmtPerusahaan'];
	$telepon = $result['Telepon'];
	$namaperusahaanasal = $result['NamaPerusahaanAsal']; 
	$provasal = $result['ProvinsiAsal'];
	$alatangkut = $result['AlatAngkut']; 
	$pelabuhanbongkar = $result['PelabuhanBongkar'];
	$berlakusampai = InputSelect::parseDate($result['BerlakuSelesai']);
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
$pdf->SetFont('helvetica', '',9 );

//$pdf->SetFont('Tahoma', '', 9);

// -----------------------------------------------------------------------------

$tbl = <<<EOD
<table  cellspacing="0" cellpadding="0" border="0">

    <tr>
       <td style="text-align:center;">KEPUTUSAN</td>
    </tr>
	
	<tr>
       <td style="text-align:center;">KEPALA KANTOR PELAYANAN PERIZINAN TERPADU SATU PINTU</td>
    </tr>
	
	<tr>
       <td style="text-align:center;">PROVINSI NUSA TENGGARA TIMUR</td>
    </tr>
	
	<tr>
       <td style="text-align:center;">NOMOR : {$nomor}</td>
    </tr>
	
	<tr>
       <td style="text-align:center;"><strong> IZIN PEMASUKAN DAN PENGELUARAN HASIL TERNAK DAN HASIL IKUTAN TERNAK SERTA MAKANAN TERNAK DARI DAN KE WILAYAH PROVINSI</strong></td>
    </tr>
	
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------
// convert TTF font to TCPDF format and store it on the fonts folder
//$fontname = TCPDF_FONTS::addTTFfont('font/Tahoma.ttf', 'TrueTypeUnicode', '', 96);

// use the font
//$pdf->SetFont($fontname, '', 9, '', false);
$pdf->SetFont('helvetica', '',9 );
$tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="0">

	<tr>
		<td width="100%" align="Justify">
			Kepala Kantor Pelayanan Perizinan Terpadu Satu Pintu, berdasar :
		</td>
    </tr>
	
    <tr>
		<td width="4%" align="Center">1.</td>
		<td width="96%" align="Justify">
			<p>Undang-undang Nomor 18 Tahun 2009 tentang Peternakan dan Kesehatan Hewan;</p>
		</td>
    </tr>
	
	 <tr>
		<td width="4%" align="Center">2.</td>
		<td width="96%" align="Justify">
			<p>Peraturan Pemerintah Nomor 15 Tahun 1977 tentang Penolakan, Pencegahan, Pemberantasan dan Pengobatan Penyakit Hewan;</p>
		</td>
    </tr>
	
	 <tr>
		<td width="4%" align="Center">3.</td>
		<td width="96%" align="Justify">
			<p>Peraturan Pemerintah Nomor 38 Tahun 2007 tentang Pembagian Urusan Pemerintahan antara Pemerintah, Pemerintahan Daerah Provinsi dan Pemerintahan Daerah Kabupaten / Kota;</p>
		</td>
    </tr>
	
	 <tr>
		<td width="4%" align="Center">4.</td>
		<td width="96%" align="Justify">
			<p>Keputusan Menteri Pertanian Nomor : 96/Kpts/PD.620/2/2004 tanggal 3 Februari 2004 tentang Pernyataan Terjangkitnya Wabah Penyakit Hewan Menular Influenza Pada Unggas (Avian Influenza) di Provinsi Nusa Tenggara Timur.</p>
		</td>
    </tr>
	
	 <tr>
		<td width="4%" align="Center">5.</td>
		<td width="96%" align="Justify">
			<p>Keputusan Menteri Pertanian Nomor 96/Kpts/PD.620/2/2004;</p>
		</td>
    </tr>
	
	 <tr>
		<td width="4%" align="Center">6.</td>
		<td width="96%" align="Justify">
			Peraturan Daerah Provinsi Nusa Tenggara Timur Nomor 6 Tahun 2011 Tanggal 30 Desember 2011 Tentang Sumbangan Pihak Ketiga Kepada Daerah;
		</td>
    </tr>
	
	 <tr>
		<td width="4%" align="Center">7.</td>
		<td width="96%" align="Justify">
			Peraturan Gubernur Nusa Tenggara Timur Nomor 5 Tahun 2016 tanggal 15 Januari 2016 tentang Pendelegasian Wewenang dari Gubernur kepada Kepala KPPTSP untuk Menandatangani Perizinan dan Non Perizinan di Lingkungan Pemerintah Provinsi Nusa Tenggara Timur.
		</td>
    </tr>
	
	 <tr>
		<td width="4%" align="Center">8.</td>
		<td width="96%" align="Justify">
			Sertifikat Bebas Penyakit Avial Influenza Dinas Peternakan Kabupaten Pasuruan Nomor : 524.13/341/424.063/2016 tanggal 04 April 2016;
		</td>
    </tr>
	
	 <tr>
		<td width="4%" align="Center">9.</td>
		<td width="96%" align="Justify">
			Rekomendasi Kepala {$rekprovdari} Nomor : {$rekprovno} tanggal {$rekprovtgl} tentang {$rekprovhal};
		</td>
    </tr>
	
	 <tr>
		<td width="4%" align="Center">10.</td>
		<td width="96%" align="Justify">
			Permohonan {$namaperusahaan} / {$nama} Nomor: {$perusahaanno} tanggal {$perusahaantgl} tentang {$perusahaanhal}.
		</td>
    </tr>
	
	<tr>
		<td width="100%" align="Justify">
			Dengan ini memberikan Izin Kepada :
		</td>
    </tr>
	
	<tr>
		<td width="21%" align="Left">Nama Pemohon</td>
		<td width="4%" align="Center">:</td>
		<td width="75%" align="Justify">
			<strong>{$nama}</strong>
		</td>
    </tr>
	
	<tr>
		<td width="21%" align="Left">Nama Perusahaan</td>
		<td width="4%" align="Center">:</td>
		<td width="75%" align="Justify">
			<strong>{$namaperusahaan}</strong>
		</td>
    </tr>
	
	<tr>
		<td width="21%" align="Left">Alamat / telp.</td>
		<td width="4%" align="Center">:</td>
		<td width="75%" align="Justify">
			{$almtperusahaan} / {$telepon}
		</td>
    </tr>

	<tr>
		<td width="21%" align="Left">Provinsi Asal</td>
		<td width="4%" align="Center">:</td>
		<td width="75%" align="Justify">
		{$provasal}
		</td>
    </tr>
	
	<tr>
		<td width="21%" align="Left">Nama Perusahaan Asal</td>
		<td width="4%" align="Center">:</td>
		<td width="75%" align="Justify">
		{$namaperusahaanasal}
		</td>
    </tr>
	
	<tr>
		<td width="21%" align="Left">Alat Angkut</td>
		<td width="4%" align="Center">:</td>
		<td width="75%" align="Justify">
		{$alatangkut}
		</td>
    </tr>
	
	<tr>
		<td width="21%" align="Left">Pelabuhan Bongkar</td>
		<td width="4%" align="Center">:</td>
		<td width="75%" align="Justify">
		{$pelabuhanbongkar}
		</td>
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------
$stmt = $db->connect()->query("select karkasdtl.* from karkasdtl 
		inner join karkas on karkasdtl.AIKarkas=karkas.AI 
		where karkasdtl.AIKarkas= {$aikarkas}");
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
	
$pdf->SetFont('helvetica', '',9 );
$tbl = <<<EOD
<table cellspacing="0" cellpadding="0" border="1">

    <tr>
		<td width="4%" align="Center">NO.</td>
		<td width="25%" align="Center">JENIS KOMODITI</td>
		<td width="8%" align="Center">SATUAN</td>
		<td width="12%" align="Center">JUMLAH</td>
		<td width="25%" align="Center">PENERIMA</td>
		<td width="25%" align="Center">KETERANGAN</td>
    </tr>
	
	<tr>
		<td width="4%" align="Center">1.</td>
		<td width="25%" align="Center">{$result['JenisKomoditi']}</td>
		<td width="8%" align="Center">{$result['Satuan']}</td>
		<td width="12%" align="Center">{$result['Jumlah']}</td>
		<td width="25%" align="Center"><strong>{$namaperusahaan} / {$nama}</strong></td>
		<td width="25%" align="Center">{$almtperusahaan}</td>
    </tr>
	
	
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
// -----------------------------------------------------------------------------

$pdf->SetFont('helvetica', '',9 );
$tbl = <<<EOD
<table cellspacing="0" cellpadding="0" border="0">

    <tr>
		<td width="100%" align="Justify">
			Dengan ini menyetujui memasukan sejumlah ternak/bahan hasil ikutan ternak unggas sebagaimana dalam perincian tersebut di atas dengan ketentuan sebagai berikut :
		</td>
    </tr>
	
	<tr>
		<td width="4%" align="Center">1.</td>
		<td width="96%" align="Justify">
			<p>Pemasukan Karkas Ayam Beku tersebut wajib disertai surat Kesehatan Hewan dari perusahaan asal.</p>
		</td>
    </tr>
	
	<tr>
		<td width="4%" align="Center">2.</td>
		<td width="96%" align="Justify">
			<p>Laporan dikirim selambat-lambatrnya 1 (satu) minggu setelah realisasi pemasukan disertai copy surat bukti tindakan karantina dan dokumen pemuatan.</p>
		</td>
    </tr>
	
	<tr>
		<td width="4%" align="Center">3.</td>
		<td width="96%" align="Justify">
			<p>Izin ini berlaku selama 14 (empat belas) hari terhitung sejak tanggal dikeluarkan s/d  {$berlakusampai}. Demikian Izin ini dibuat untuk dapat dipergunakan seperlunya.</p>
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
		<td width="100%" align="Center">
		</td>
    </tr>
	
	<tr>
		<td width="100%" align="Center">
		</td>
    </tr>
	
	<tr>
		<td width="100%" align="Center">
		</td>
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
		<td width="65%" align="Left">{$tembusan}</td>
		<td width="35%" align="Left"></td>
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------
//Close and output PDF document
$pdf->Output('karkas.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
