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
	
	$stmt = $db->connect()->query("select rkb.NoReg, rkb.Nomor, rkb.Tgl, rkb.Tgl, rkb.Nama, rkb.Alamat, rkb.NoSurat, rkb.TglSurat, rkb.NamaPerusahaan,
		rkb.PimpinanPerusahaan, rkb.AlmtPerusahaan, rkb.RekDishubNo, rkb.RekDishubTgl, rkb.Merk, rkb.Jenis, rkb.Model,
		rkb.`Type`, rkb.PlatNomor, rkb.TahunBuat, rkb.NoMesin, rkb.NoMesin, rkb.NoRangka, rkb.JBB, rkb.KonfSumbu,
		rkb.Keperluan, rkb.PjgTotal, rkb.LebarTotal, rkb.DomisiliAsal, rkb.Tembusan, kabupaten.NamaKabupaten
		from rkb
		inner join register on rkb.NoReg=register.AI inner join kabupaten on register.idKab=kabupaten.AI 
		where rkb.NoReg={$noreg}");
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$noreg = $result['NoReg']; 
	$nomor = $result['Nomor'];
	$tgl = InputSelect::parseDate($result['Tgl']);
	$nama = $result['Nama']; 
	$alamat = $result['Alamat']; 
	$nosurat = $result['NoSurat'];
	$tglsurat = InputSelect::parseDate($result['TglSurat']); 
	$namaperusahaan = $result['NamaPerusahaan']; 
	$pimpinan = $result['PimpinanPerusahaan'];
	$almtperusahaan = $result['AlmtPerusahaan']; 
	$rekdishubno = $result['RekDishubNo']; 
	$rekdishubtgl = InputSelect::parseDate($result['RekDishubTgl']);
	$merk = $result['Merk']; 
	$jenis = $result['Jenis']; 
	$model = $result['Model'];
	$type = $result['Type']; 
	$platnomor = $result['PlatNomor']; 
	$tahunbuat = $result['TahunBuat'];
	$nomesin = $result['NoMesin']; 
	$norangka = $result['NoRangka']; 
	$jbb = $result['JBB'];
	$konfsumbu = $result['KonfSumbu']; 
	$keperluan = $result['Keperluan']; 
	$pjgtotal = $result['PjgTotal'];
	$lebartotal = $result['LebarTotal']; 
	$domisili = $result['DomisiliAsal']; 
	$kabupaten= $result['NamaKabupaten'];
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

$pdf->SetFont('helvetica', '',8 );
$tbl = <<<EOD
<table cellspacing="0" cellpadding="0" border="0">

    <tr>
		<td width="10%" align="Left">Nomor</td>
		<td width="2%" align="Center">:</td>
		<td width="38%" align="Left">{$nomor}</td>
		<td width="4%" align="Center"></td>
		<td width="46%" align="Justify">
			Kepada
		</td>
    </tr>
	
	 <tr>
		<td width="10%" align="Left">Lampiran</td>
		<td width="2%" align="Center">:</td>
		<td width="38%" align="Left">1 (satu) Berkas</td>
		<td width="4%" align="Center">yth.</td>
		<td width="46%" align="Justify">
			<strong>Sdr. {$pimpinan}</strong>
		</td>
    </tr>
	
	 <tr>
		<td width="10%" align="Left">Hal</td>
		<td width="2%" align="Center">:</td>
		<td width="38%" align="Left"><strong>REKOMENDASI</strong></td>
		<td width="4%" align="Center"></td>
		<td width="46%" align="Justify">
		<strong>PIMPINAN {$namaperusahaan}</strong>
		</td>
    </tr>
	
	 <tr>
		<td width="54%" align="Left"></td>
		<td width="46%" align="Justify">
			d/a. {$almtperusahaan}
		</td>
    </tr>
	
	 <tr>
		<td width="54%" align="Left"></td>
		<td width="46%" align="Justify">
			di-
		</td>
    </tr>
	
	<tr>
		<td width="58%" align="Left"></td>
		<td width="42%" align="Left">
			{$kabupaten}
		</td>
    </tr>
	
	<tr>
		<td width="100%" align="Left"></td>
    </tr>
	
	<tr>
		<td width="12%" align="Left"></td>
		<td width="88%" align="Justify">Memperhatikan surat Permohonan Pimpinan {$namaperusahaan}  Nomor : {$nosurat}  tanggal {$tglsurat} perihal Rekomendasi Pengoperasian Kendaraan Muatan Berat dan sesuai dengan surat Kepala Dinas Perhubungan Provinsi Nusa Tenggara Timur Nomor: {$rekdishubno} Tanggal {$rekdishubtgl}  perihal Pertimbangan Teknis dalam rangka dukungan Gubernur Nusa Tengga Timur terhadap Pemasukan dan Pengoperasian Kendaraan Mobil Barang Dengan Jumlah Berat yang diperbolehkan (JBB) di atas 14.000 kg., maka bersama ini disampaikan bahwa, Pemerintah Provinsi Nusa Tenggara Timur memberikan Rekomendasi kepada Saudara untuk mengoperasikan 1 (satu) unit Kendaraan Barang (spesifikasi terlampir) dengan kapasitas angkut disesuaikan dengan Muatan Sumbu Terberat (MST), maka untuk Pengoperasian Kendaraan di maksud tetap memperhatikan hal-hal sebagai berikut :</td>
    </tr>
	
	<tr>
		<td width="12%" align="Left"></td>
		<td width="3%" align="Center">1.</td>
		<td width="85%" align="Justify">Mentaati Peraturan Perundangan – undangan yang berlaku di bidang lalu lintas dan angkutan jalan serta dibidang jalan dimana untuk setiap kendaraan bermotor yang dioperasikan di jalan harus sesuai peruntukkannya, memenuhi persyaratan teknis dan laik jalan serta sesuai dengan jalan yang dilalui;</td>
    </tr>
	
	<tr>
		<td width="12%" align="Left"></td>
		<td width="3%" align="Center">2.</td>
		<td width="85%" align="Justify">Mematuhi Keputusan Menteri Perhubungan Nomor : KM 20 Tahun 2004 tentang Penetapan Kelas Jalan di Provinsi Bali, NTB, NTT, Maluku, Maluku Utara, dan Papua serta Rambu-Rambu Kelas Jalan yang diijinkan sesuai Keputusan Gubernur Nusa Tenggara Timur Nomor : 77.Kep/HK/2008 tentang Penetapan Jaringan Lintas Angkutan Barang di  Wilayah Daratan Timor;</td>
    </tr>
	
	<tr>
		<td width="12%" align="Left"></td>
		<td width="3%" align="Center">3.</td>
		<td width="85%" align="Justify">Kendaraan dimaksud dalam operasionalisasinya sesuai dengan hasil kajian teknis Muatan Maksimum 21.000 Kg, sehingga Muatan Sumbu Terberat (MST)nya sesuai dengan kelas jalan menjadi 8.000 Kg dan dapat di operasikan setelah memperoleh laik ker / laik jalan dari Dinas Perhubungan Kabupaten / kota setempat.</td>
    </tr>
	
	<tr>
		<td width="12%" align="Left"></td>
		<td width="3%" align="Center">4.</td>
		<td width="85%" align="Justify">Pengoperasian Kendaraan di maksud tidak di perkenankan memasuki  Jalan Kabupaten,  namun wajib memasuki Jalan Provinsi dan wajib dikawal oleh petugas Kepolisian Republik Indonesia atau pihak yang berwenang di dalam melakukan pengawalan jalan;</td>
    </tr>
	
	<tr>
		<td width="12%" align="Left"></td>
		<td width="3%" align="Center">5.</td>
		<td width="85%" align="Justify">Untuk menghindari terjadi kemacetan dan mengakibatkan kecelakaan maka pengoperasian kendaraan tersebut tidak    di perkenankan beroperasi pada jam – jam sibuk / padat lalu lintas, sehingga di jadwalkan di operasionalkan pada jam 21.00 sampai dengan 05.30 Wita.</td>
    </tr>
	
	<tr>
		<td width="12%" align="Left"></td>
		<td width="3%" align="Center">6.</td>
		<td width="85%" align="Justify">Rekomendasi pengoperasian kendaraan ini diperuntukan sebagai angkutan kendaraan alat berat guna mendukung percepatan pembangunan  di Provinsi Nusa Tenggara Timur, maka Saudara diwajibkan melaporkan kepada Gubernur Nusa Tenggara Timur Cq. Kepala Kantor Pelayanan Perizinan Terpadu Satu Pintu (KPPTSP) Provinsi Nusa Tenggara Timur setiap tiga bulan pelaksanaan pengoperasian kendaraan tersebut dan tembusannya disampaikan kepada Dinas Perhubungan Provinsi Nusa Tenggara Timur;</td>
    </tr>
	
	<tr>
		<td width="12%" align="Left"></td>
		<td width="3%" align="Center">7.</td>
		<td width="85%" align="Justify">Perpanjangan Rekomendasi ini berlaku selama 1 (Satu) Tahun  dan dapat diperpanjang setiap tahun dengan ketentuan mengajukan pemohonan kepada Gubernur Nusa Tenggara Timur Cq. Kepala Kantor Pelayanan Perizinan Terpadu Satu Pintu Provinsi Nusa Tenggara Timur, paling lambat 1 (satu) bulan sebelum berakhirnya masa berlaku rekomendasi ini dengan melampirkan foto copy surat Rekomendasi ini;</td>
    </tr>
	
	<tr>
		<td width="12%" align="Left"></td>
		<td width="3%" align="Center">8.</td>
		<td width="85%" align="Justify">Kendaraan dengan nomor rangka {$norangka}, adalah milik {$namaperusahaan}, masih terdaftar dan berdomisili di {$domisili}, sehingga sebelum dioperasikan di wilayah Provinsi Nusa Tenggara Timur kendaraan tersebut Wajib Mutasi sesuai domisili dan lokasi operasi kendaraan.</td>
    </tr>
	
	<tr>
		<td width="12%" align="Left"></td>
		<td width="3%" align="Center">9.</td>
		<td width="85%" align="Justify">Perpanjangan Rekomendasi ini berlaku sejak tanggal ditetapkan dan akan ditinjau kembali apabila terdapat kekeliruan dan penetapannya.</td>
    </tr>
	
	<tr>
		<td width="100%" align="Left"></td>
    </tr>
	
	<tr>
		<td width="15%" align="Left"></td>
		<td width="85%" align="Justify">Demikian untuk diketahui dan dipergunakan sebagaimana mestinya.</td>
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
		<td width="100%" align="Center"></td>
    </tr>
	
	<tr>
		<td width="100%" align="Center"></td>
    </tr>
	
	<tr>
		<td width="100%" align="Center"></td>
    </tr>
	
	
	<tr>
		<td width="100%" align="Center"></td>
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
		<td width="65%" align="Left">Tembusan :</td>
		<td width="45%" align="Left"></td>
    </tr>
	
	<tr>
		<td width="65%" align="Left">{$tembusan}</td>
		<td width="45%" align="Left"></td>
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
// -----------------------------------------------------------------------------

$pdf->SetMargins(20,25,20);
$pdf->AddPage('P', $resolution);
$pdf->SetFont('helvetica', '',9 );
$tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="0">

    <tr>
		<td width="100%" align="Center"><strong><u>LAMPIRAN SURAT REKOMENDASI</u></strong></td>
    </tr>
	
	<tr>
		<td width="100%" align="Center">Nomor : {$nomor}</td>
    </tr>
	
	<tr>
		<td width="100%" align="Center">Tanggal : {$tgl}</td>
    </tr>
	
	<tr>
		<td width="100%" align="Center"></td>
    </tr>
	
	<tr>
		<td width="100%" align="Center"></td>
    </tr>
	
	<tr>
		<td width="100%" align="Left">SPESIFIKASI KENDARAAN</td>
    </tr>
	
	<tr>
		<td width="100%" align="Center"></td>
    </tr>
	
	<tr>
		<td width="5%" align="Center"></td>
		<td width="95%" align="Left">Kendaraan Penarik</td>
    </tr>
	
	<tr>
		<td width="5%" align="Center"></td>
		<td width="4%" align="Center">1. </td>
		<td width="24%" align="Left">Merk/Jenis</td>
		<td width="2%" align="Center">:</td>
		<td width="65%" align="Left">{$merk} / {$jenis} </td>
    </tr>
	
	<tr>
		<td width="5%" align="Center"></td>
		<td width="4%" align="Center">2. </td>
		<td width="24%" align="Left">Model/Type</td>
		<td width="2%" align="Center">:</td>
		<td width="65%" align="Left">{$model} / {$type}</td>
    </tr>
	
	<tr>
		<td width="5%" align="Center"></td>
		<td width="4%" align="Center">3. </td>
		<td width="24%" align="Left">Plat Nomor</td>
		<td width="2%" align="Center">:</td>
		<td width="65%" align="Left">{$platnomor}</td>
    </tr>
	
	<tr>
		<td width="5%" align="Center"></td>
		<td width="4%" align="Center">4. </td>
		<td width="24%" align="Left">Tahun Pembuatan</td>
		<td width="2%" align="Center">:</td>
		<td width="65%" align="Left">{$tahunbuat}</td>
    </tr>
	
	<tr>
		<td width="5%" align="Center"></td>
		<td width="4%" align="Center">5. </td>
		<td width="24%" align="Left">No. Mesin</td>
		<td width="2%" align="Center">:</td>
		<td width="65%" align="Left">{$nomesin}</td>
    </tr>
	
	<tr>
		<td width="5%" align="Center"></td>
		<td width="4%" align="Center">6. </td>
		<td width="24%" align="Left">No. Rangka</td>
		<td width="2%" align="Center">:</td>
		<td width="65%" align="Left">{$norangka}</td>
    </tr>
	
	<tr>
		<td width="5%" align="Center"></td>
		<td width="4%" align="Center">7. </td>
		<td width="24%" align="Left">JBB</td>
		<td width="2%" align="Center">:</td>
		<td width="65%" align="Left">{$jbb}</td>
    </tr>
	
	
	<tr>
		<td width="5%" align="Center"></td>
		<td width="4%" align="Center">8. </td>
		<td width="24%" align="Left">Konfigurasi Sumbu</td>
		<td width="2%" align="Center">:</td>
		<td width="65%" align="Left">{$konfsumbu}</td>
    </tr>
	
	
	<tr>
		<td width="5%" align="Center"></td>
		<td width="4%" align="Center">9. </td>
		<td width="24%" align="Left">Keperluan</td>
		<td width="2%" align="Center">:</td>
		<td width="65%" align="Left">{$keperluan}</td>
    </tr>
	
	
	<tr>
		<td width="5%" align="Center"></td>
		<td width="4%" align="Center">10. </td>
		<td width="24%" align="Left">Panjang Total</td>
		<td width="2%" align="Center">:</td>
		<td width="65%" align="Left">{$pjgtotal}</td>
    </tr>
	
	<tr>
		<td width="5%" align="Center"></td>
		<td width="4%" align="Center">11. </td>
		<td width="24%" align="Left">Lebar Total</td>
		<td width="2%" align="Center">:</td>
		<td width="65%" align="Left">{$lebartotal}</td>
    </tr>
	

	
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
// -----------------------------------------------------------------------------

$pdf->SetFont('helvetica', '',8 );
$tbl = <<<EOD
<table cellspacing="0" cellpadding="0" border="0">
	
	<tr>
		<td width="100%" align="Center"></td>
    </tr>
	
	<tr>
		<td width="100%" align="Center"></td>
    </tr>
	
	<tr>
		<td width="100%" align="Center"></td>
    </tr>
	
	<tr>
		<td width="100%" align="Center"></td>
    </tr>
	
	
	<tr>
		<td width="100%" align="Center"></td>
    </tr>
	
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
		<td width="100%" align="Center"></td>
    </tr>
	
	<tr>
		<td width="100%" align="Center"></td>
    </tr>
	
	<tr>
		<td width="100%" align="Center"></td>
    </tr>
	<tr>
		<td width="100%" align="Center"></td>
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
//Close and output PDF document
$pdf->Output('ppklpa.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
