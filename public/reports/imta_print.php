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
require_once INCLUDES_PATH.DS."tcpdf/examples/tcpdf_include.php";
session_start();

	//$noreg=$_SESSION["PRINT_KEY"];
	$noreg=$_GET["PRINT_KEY"];
	
	$db = new DbConnect();
	
	$stmt = $db->connect()->query("select imta.NoReg, imta.Nomor, imta.Tgl, imta.Nama, imta.Alamat, imta.NoSuratPerusahaan, imta.TglSuratPerusahaan,
		imta.NoRekProv,imta.TglRekProv, imta.NamaPerusahaan, imta.AlmtPerusahaan, imta.JenisUsaha, imta.NamaTA,imta.ImtaLama,imta.NamaTA,imta.TglImtaLama,
		imta.TglLahirTA, imta.KwnTA, imta.AlmtTA, imta.NoPasporTA, imta.JabatanTA, imta.LokasiKerjaTA, imta.BerlakuMulai, imta.BerlakuSelesai,
		imta.Tembusan
		from imta
		inner join register on imta.NoReg=register.AI  
		where imta.NoReg={$noreg}");
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$noreg = $result['NoReg']; 
	$nomor = $result['Nomor'];
	$tgl = InputSelect::parseDate($result['Tgl']);
	$nama = $result['Nama']; 
	$alamat = $result['Alamat'];
	$nosurperusahaan = $result['NoSuratPerusahaan']; 
	$tglsurperusahaan = InputSelect::parseDate($result['TglSuratPerusahaan']);
	$norekprov = $result ['NoRekProv'];
	$tglrekprov = InputSelect::parseDate($result['NoReg']); 
	$namaperusahaan = $result['NamaPerusahaan'];
	$alamatperusahaan = $result['AlmtPerusahaan'];
	$jenisusaha = $result['JenisUsaha']; 
	$imtalama = $result ['ImtaLama'];
	$tglimtalama = InputSelect::parseDate($result ['TglImtaLama']);
	$namata = $result['NamaTA'];
	$tgllahirta = InputSelect::parseDate($result['TglLahirTA']);
	$kwnta = $result['KwnTA']; 
	$almtta = $result['AlmtTA'];
	$nopasporta = $result['NoPasporTA'];
	$jbtnta = $result['JabatanTA']; 
	$lokasikerjata = $result['LokasiKerjaTA'];
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
$pdf->SetMargins(20,30,20);
$pdf->AddPage('P', $resolution);

// convert TTF font to TCPDF format and store it on the fonts folder
//$fontname = TCPDF_FONTS::addTTFfont('font/Tahoma.ttf', 'TrueTypeUnicode', '', 96);

// use the font
$pdf->SetFont('helvetica', 'B',11 );

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
       <td style="text-align:center;"><strong> PEMBERIAN IZIN PERPANJANGAN MEMPEKERJAKAN TENAGA KERJA ASING </strong></td>
    </tr>
	
	<tr>
       <td style="text-align:center;">PENDATANG LINTAS KABUPATEN / KOTA</td>
    </tr>
	
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------
// convert TTF font to TCPDF format and store it on the fonts folder
//$fontname = TCPDF_FONTS::addTTFfont('font/Tahoma.ttf', 'TrueTypeUnicode', '', 96);

// use the font
//$pdf->SetFont($fontname, '', 9, '', false);
$pdf->SetFont('helvetica', '',10 );
$tbl = <<<EOD
<table cellspacing="0" cellpadding="2" border="0">

    <tr>
		<td width="22%" align="Left">MEMPERHATIKAN</td>
		<td width="2%" align="Center">:</td>
		<td width="76%" align="Justify">
			<p>Permohonan dari Direktur {$namaperusahaan} Nomor : {$nosurperusahaan} tanggal {$tglsurperusahaan}, perihal Permohonan Perpanjangan Izin Tenaga Kerja Asing (IMTA)  dan Rekomendasi Kepala Dinas Tenaga Kerja dan Transmigrasi Provinsi Nusa Tenggara Timur Nomor: {$norekprov} tanggal {$tglrekprov};</p>
		</td>
    </tr>
	
	<tr>
		<td width="22%" align="Left">MENIMBANG</td>
		<td width="2%" align="Center">:</td>
		<td width="4%" align="Center">a.</td>
		<td width="72%" align="Justify">
			<p>Bahwa penggunaan Tenaga  Kerja Asing (TKA) tersebut telah mendapatkan surat pengesahan RPTKA Nomor : {$imtalama} tanggal {$tglimtalama};</p>
		</td>
    </tr>
	
	<tr>
		<td width="22%" align="Left"></td>
		<td width="2%" align="Center"></td>
		<td width="4%" align="Center">b.</td>
		<td width="72%" align="Justify">
			<p>Bahwa dalam rangka peningkatan kualitas di bidang Perdagangan Besar, maka masih dibutuhkan Tenaga Kerja Asing (TKA).</p>
		</td>
    </tr>
	
	<tr>
		<td width="22%" align="Left">MENGINGAT</td>
		<td width="2%" align="Center">:</td>
		<td width="4%" align="Center">1.</td>
		<td width="72%" align="Justify">
			<p>Undang-undang No. 13 Tahun 2003 tentang Ketenagakerjaan Bab VII mengenai Penggunaan Tenaga Kerja Asing;</p>
		</td>
    </tr>
	
	<tr>
		<td width="22%" align="Left"></td>
		<td width="2%" align="Center"></td>
		<td width="4%" align="Center">2.</td>
		<td width="72%" align="Justify">
			<p>Peraturan Menteri Ketenagakerjaan RI Nomor 16 Tahun 2015, tentang Tata Cara Penggunaan Tenaga Kerja Asing;</p>
		</td>
    </tr>
	
	<tr>
		<td width="22%" align="Left"></td>
		<td width="2%" align="Center"></td>
		<td width="4%" align="Center">3.</td>
		<td width="72%" align="Justify">
			<p>Peraturan Gubernur Nusa Tenggara Timur Nomor 5 Tahun 2016 tanggal 14 Januari 2016 tentang Pendelegasian Wewenang dari Gubernur kepada Kepala KPPTSP untuk Menandatangani Perizinan dan Non Perizinan di Lingkungan Pemerintah Provinsi Nusa Tenggara Timur.</p>
		</td>
    </tr>
	
	<tr>
		<td width="22%" align="Left"></td>
		<td width="2%" align="Center"></td>
		<td width="4%" align="Center">4.</td>
		<td width="72%" align="Justify">
			<p>Peraturan Daerah Provinsi Nusa Tenggara Timur Nomor 6 Tahun 2011 Tanggal 30 Desember 2011 Tentang Sumbangan Pihak Ketiga Kepada Daerah;</p>
		</td>
    </tr>
	
	<tr>
		<td width="100%" align="Center">MEMUTUSKAN</td>
    </tr>
	
       <tr>
		<td width="22%" align="Left">MENETAPKAN</td>
		<td width="2%" align="Center">:</td>
		<td width="76%" align="Justify">
		</td>
    </tr>
	
	<tr>
		<td width="22%" align="Left">PERTAMA</td>
		<td width="2%" align="Center">:</td>
		<td width="27%" align="Left">
		Memberikan  Izin kepada
		</td>
		<td width="2%" align="Center">:</td>
		<td width="47%" align="Left">{$namaperusahaan}</td>
    </tr>
	
	<tr>
		<td width="24%" align="Left"></td>
		<td width="27%" align="Left">
		Alamat perusahaan
		</td>
		<td width="2%" align="Center">:</td>
		<td width="47%" align="Left">{$alamatperusahaan}</td>
    </tr>
	
	<tr>
		<td width="24%" align="Left"></td>
		<td width="27%" align="Left">
		Jenis Usaha 
		</td>
		<td width="2%" align="Center">:</td>
		<td width="47%" align="Left">{$jenisusaha}</td>
    </tr>
	
	<tr>
		<td width="24%" align="Left"></td>
		<td width="27%" align="Left">
		Untuk memperkerjakan
		</td>
		<td width="2%" align="Center"></td>
		<td width="47%" align="Left"></td>
    </tr>
	
	<tr>
		<td width="24%" align="Left"></td>
		<td width="27%" align="Left">
		Nama tenaga asing
		</td>
		<td width="2%" align="Center">:</td>
		<td width="47%" align="Left">{$namata}</td>
    </tr>
	
	<tr>
		<td width="24%" align="Left"></td>
		<td width="27%" align="Left">
		Tanggal Lahir
		</td>
		<td width="2%" align="Center">:</td>
		<td width="47%" align="Left">{$tgllahirta}</td>
    </tr>
	
	<tr>
		<td width="24%" align="Left"></td>
		<td width="27%" align="Left">
		Kewarganegaraan
		</td>
		<td width="2%" align="Center">:</td>
		<td width="47%" align="Left">{$kwnta}</td>
    </tr>
	
	<tr>
		<td width="24%" align="Left"></td>
		<td width="27%" align="Left">
		Alamat tempat tinggal
		</td>
		<td width="2%" align="Center">:</td>
		<td width="47%" align="Left">{$almtta}</td>
    </tr>
	
	<tr>
		<td width="24%" align="Left"></td>
		<td width="27%" align="Left">
		Nomor Paspor
		</td>
		<td width="2%" align="Center">:</td>
		<td width="47%" align="Left">{$nopasporta}</td>
    </tr>
	
	<tr>
		<td width="24%" align="Left"></td>
		<td width="27%" align="Left">
		Untuk menjadi jabatan
		</td>
		<td width="2%" align="Center">:</td>
		<td width="47%" align="Left">{$jbtnta}</td>
    </tr>
	
	<tr>
		<td width="24%" align="Left"></td>
		<td width="27%" align="Left">
		Lokasi Kerja
		</td>
		<td width="2%" align="Center">:</td>
		<td width="47%" align="Left">{$lokasikerjata}</td>
    </tr>
	
	<tr>
		<td width="22%" align="Left">KEDUA</td>
		<td width="2%" align="Center">:</td>
		<td width="76%" align="Justify">
		Perpanjangan Izin ini berlaku sejak tanggal	: {$berlakumulai}  s/d {$berlakusampai}
		</td>
    </tr>
	
	<tr>
		<td width="22%" align="Left">KETIGA</td>
		<td width="2%" align="Center">:</td>
		<td width="76%" align="Justify">
		Menetapkan Syarat-syarat sebagai berikut :
		</td>
    </tr>
	<tr>
		<td width="22%" align="Left"></td>
		<td width="2%" align="Center"></td>
		<td width="4%" align="Center">1.</td>
		<td width="72%" align="Justify">
			<p>Memberikan pendidikan/latihan kepada tenaga-tenaga warga negara Indonesia sehingga mereka dapat menduduki jabatan yang membutuhkan tanggung jawab dan keahlian/ketrampilan tertentu dalam perusahaan tersebut dengan melaporkan hasilnya kepada Kementerian Tenaga Kerja dan Transmigrasi Republik Indonesia.</p>
		</td>
    </tr>
	
	<tr>
		<td width="22%" align="Left"></td>
		<td width="2%" align="Center"></td>
		<td width="4%" align="Center">2.</td>
		<td width="72%" align="Justify">
			<p>Tidak akan memindahkan jabatan atau memperkerjakan dalam jabatan lain tanpa izin Menteri Tenaga Kerja dan Transmigrasi Republik Indonesia.</p>
		</td>
    </tr>
	
	<tr>
		<td width="22%" align="Left"></td>
		<td width="2%" align="Center"></td>
		<td width="4%" align="Center">3.</td>
		<td width="72%" align="Justify">
			<p>Jika dikemudian hari ternyata bahwa keterangan-keterangan yang diberikan / disebut dalam daftar permohonan oleh bersangkutan tidak benar atau pun syarat-syarat yang kami tentukan ini tidak terpenuhi, maka surat keputusan ini dapat dicabut.</p>
		</td>
    </tr>
	
	<tr>
		<td width="22%" align="Left"></td>
		<td width="2%" align="Center"></td>
		<td width="4%" align="Center">4.</td>
		<td width="72%" align="Justify">
			<p>Setelah menerima IMTA, pemohon wajib melaporkan keberadaan TKA kepada dinas yang bertanggungjawab di bidang Ketenagakerjaan, Dinas Pendapatan Daerah dan Kantor Kependudukan dimana TKA dipekerjakan.</p>
		</td>
    </tr>
	
	<tr>
		<td width="22%" align="Left"></td>
		<td width="2%" align="Center"></td>
		<td width="4%" align="Center">5.</td>
		<td width="72%" align="Justify">
			<p>IMTA perpanjangan ini sekaligus sebagai dasar untuk perpanjangan KITAS pada Kantor Imigrasi.</p>
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
$pdf->SetFont('helvetica', '',10 );
$tbl = <<<EOD
<table cellspacing="0" cellpadding="0" border="0">

    <tr>
	
		<td width="46%" align="Right"></td>
		
		<td width="20%" align="Left">
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
		<td width="46%" align="Right"></td>
		
		<td width="20%" align="Left">
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
		<td width="25%" align="Right"></td>
		<td width="20%" align="Center">Pemohon</td>
		<td width="55%" align="center"></td>

    </tr>
	
	<tr>
		<td width="45%" align="Right"></td>
		<td width="45%" align="center">
			a.n. GUBERNUR NUSA TENGGARA TIMUR
		</td>
		<td width="10%" align="Right"></td>
    </tr>
	
	<tr>
		<td width="45%" align="Right">

		</td>
		<td width="45%" align="center">
			KEPALA KPPTSP PROVINSI NTT,
		</td>
		<td width="10%" align="center"></td>
    </tr>
	
	<tr>	
		<td width="25%" align="Right"></td>
		<td width="20%" align="Center">
			<img style="margin-top:5px;" src="../images/pasfoto.png" height="50">
		</td>
		<td width="55%" align="center"></td>
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

$pdf->SetFont('helvetica', '',8 );
$tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="0">

    <tr>
		<td width="100%" align="Left">Tembusan :</td>
    </tr>
	
	<tr>
		<td width="100%" align="Left">{$tembusan}</td>
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
