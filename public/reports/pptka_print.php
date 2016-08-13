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
	
	$stmt = $db->connect()->query("select pptka.* , kabupaten.NamaKabupaten
		from pptka inner join register on pptka.NoReg=register.AI 
		inner join kabupaten on register.idKab=kabupaten.AI
		where pptka.NoReg={$noreg}");
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	
        $no_pptka = $result['AI'];
	$noreg = $result['NoReg']; 
	$nomor = $result['Nomor'];
	$tgl = InputSelect::parseDate($result['Tgl']);
        $tgl_terbit = $result['Tgl'];
	$nama = $result['Nama']; 
	$alamat = $result['Alamat'];
	$nosurat = $result['NoSurat']; 
	$tglsurat = InputSelect::parseDate($result['TglSurat']);
	$fulldate = date_parse($result['TglSurat']);
	$tahunselesai = $fulldate["year"] + 2;
	$halsurat = $result['HalSurat']; 
	$namaperusahaan = $result['NamaPerusahaan'];
	$alamatperusahaan = $result['AlmtPerusahaan']; 
	$telepon = $result['Telepon'];
	$jenisusaha = $result['JenisUsaha'];
	$jenisjabatan = $result['JenisJabatan'];
	$lokasi = $result['Lokasi'];
	$tembusan = $result['Tembusan'];
	$kabupaten = $result['NamaKabupaten'];
	
// create new PDF document//
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  
// add a page
$resolution= array(210, 350);
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
<table  cellspacing="0" cellpadding="2" border="0">

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
       <td style="text-align:center;"><strong> PENGESAHAN PERPANJANGAN RENCANA PENGGUNAAN TENAGA KERJA ASING</strong></td>
    </tr>
	
	<tr>
       <td style="text-align:center;"><strong> PADA</strong></td>
    </tr>
	
	<tr>
       <td style="text-align:center;"><strong> {$namaperusahaan}</strong></td>
    </tr>
	
	<tr>
       <td style="text-align:center;"><strong>KEPALA KANTOR PELAYANAN PERIZINAN TERPADU SATU PINTU</strong></td>
    </tr>
	
	<tr>
       <td style="text-align:center;"><strong>PROVINSI NUSA TENGGARA TIMUR</strong></td>
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------
// convert TTF font to TCPDF format and store it on the fonts folder
//$fontname = TCPDF_FONTS::addTTFfont('font/Tahoma.ttf', 'TrueTypeUnicode', '', 96);

// use the font
//$pdf->SetFont($fontname, '', 9, '', false);
$pdf->SetFont('helvetica', '',11 );
$tbl = <<<EOD
<table cellspacing="0" cellpadding="0" border="0">

    <tr>
		<td width="20%" align="Left">MENIMBANG</td>
		<td width="2%" align="Center">:</td>
		<td width="5%" align="Center">a.</td>
		<td width="73%" align="Justify">
			<p>bahwa dalam rangka meningkatkan kualitas usaha, Perusahaan mengajukan Permohonan Perpanjangan Rencana Perpanjangan Tenaga Kerja Asing.</p>
		</td>
    </tr>
	
	<tr>
		<td width="20%" align="Left"></td>
		<td width="2%" align="Center"></td>
		<td width="5%" align="Center">b.</td>
		<td width="73%" align="Justify">
			<p>bahwa setelah diadakan penelitian dan penilaian terhadap Permohonan Perusahaan dan Kelengkapan Persyaratan untuk Pengesahaan Perpanjangan Rencana Perpanjangan Tenaga Kerja Asing, maka Permohonan tersebut dapat dipertimbangkan untuk disahkan.</p>
		</td>
    </tr>
	
	<tr>
		<td width="20%" align="Left"></td>
		<td width="2%" align="Center"></td>
		<td width="5%" align="Center">c.</td>
		<td width="73%" align="Justify">
			<p>bahwa untuk itu, perlu ditetapkan dengan Keputusan Kepala Kantor Pelayanan Perizinan Terpadu Satu Pintu Provinsi Nusa Tenggara Timur.</p>
		</td>
    </tr>
	<tr>
		<td width="100%" align="Center"></td>
    </tr>
	<tr>
		<td width="20%" align="Left">MENGINGAT</td>
		<td width="2%" align="Center">:</td>
		<td width="5%" align="Center">1.</td>
		<td width="73%" align="Justify">
			<p>Undang – undang Nomor 13 Tahun 2003 tentang Ketenagakerjaan Bab VIII mengenai penggunaan Tenaga Kerja Asing;</p>
		</td>
    </tr>
	
	<tr>
		<td width="20%" align="Left"></td>
		<td width="2%" align="Center"></td>
		<td width="5%" align="Center">2.</td>
		<td width="73%" align="Justify">
			<p >Keputusan Menteri Tenaga Kerja No. KEP-337/MEN/1976, tentang pelaksanaan pembatasan Tenaga Kerja Warga Negara Asing Pendatang (TKWNAP) di Sektor Pariwisata;</p>
		</td>
    </tr>
	<tr>
		<td width="20%" align="Left"></td>
		<td width="2%" align="Center"></td>
		<td width="5%" align="Center">3.</td>
		<td width="73%" align="Justify">
			<p >Peraturan Menteri Tenaga Kerja dan Transmigrasi RI Nomor : PER – 02/MEN/III/2008 tentang Tata Cara Penggunaan Tenaga Kerja Asing;</p>
		</td>
    </tr>
	
	<tr>
		<td width="20%" align="Left"></td>
		<td width="2%" align="Center"></td>
		<td width="5%" align="Center">4.</td>
		<td width="73%" align="Justify">
			<p >Peraturan Daerah Provinsi Nusa Tenggara Timur Nomor 5 Tahun 2009 tentang Organisasi dan Tata Kerja Kantor Pelayanan Perizinan Terpadu Satu Pintu Provinsi Nusa Tenggara Timur;</p>
		</td>
    </tr>
	
	<tr>
		<td width="20%" align="Left"></td>
		<td width="2%" align="Center">:</td>
		<td width="5%" align="Center">5.</td>
		<td width="73%" align="Justify">
			<p >Peraturan Gubernur Nusa Tenggara Timur Nomor 6 Tahun 2013 tentang Pendelegasian Wewenang dari Gubernur kepada Kepala KPPTSP untuk menandatangani Perizinan dan Non Perizinan di lingkungan Pemerintah Provinsi Nusa Tenggara Timur;</p>
		</td>
    </tr>
	
	<tr>
		<td width="20%" align="Left"></td>
		<td width="2%" align="Center"></td>
		<td width="5%" align="Center">6.</td>
		<td width="73%" align="Justify">
			<p >Peraturan Daerah Provinsi Nusa Tenggara Timur Nomor 6 Tahun 2011 Tanggal 30 Desember 2011 Tentang Sumbangan Pihak Ketiga Kepada Daerah.</p>
		</td>
    </tr>
	
	<tr>
		<td width="100%" align="Center"></td>
    </tr>
	
	<tr>
		<td width="20%" align="Left">MEMPERHATIKAN</td>
		<td width="2%" align="Center">:</td>
		<td width="2%" align="Center"></td>
		<td width="76%" align="Justify">
			<p >Surat Permohonan dari Penanggung Jawab {$namaperusahaan} Nomor : {$nosurat} tanggal {$tglsurat}, perihal {$halsurat};</p>
		</td>
    </tr>
	
	<tr>
		<td width="100%" align="Center"></td>
    </tr>
	
	<tr>
		<td width="100%" align="Center"><strong>MEMUTUSKAN</strong></td>
    </tr>
	
	<tr>
		<td width="100%" align="Center"></td>
    </tr>
	
    <tr>
		<td width="20%" align="Left">MENETAPKAN</td>
		<td width="2%" align="Center">:</td>
		<td width="2%" align="Center"></td>
		<td width="76%" align="Justify">
		</td>
    </tr>
	
	<tr>
		<td width="20%" align="Left">PERTAMA</td>
		<td width="2%" align="Center">:</td>
		<td width="2%" align="Center"></td>
		<td width="76%" align="Justify">
		Mengesahkan Perpanjangan Rencana Penggunaan Tenaga Kerja Asing {$namaperusahaan} selama 2 (dua) tahun sesuai permohonan dari Tahun 2015  s/d 31 Desember {$tahunselesai} sebanyak 1 (satu) jabatan dengan jumlah tenaga kerja asing 1 (satu) orang dengan lokasi {$kabupaten}, sebagaimana terlampir dalam Keputusan ini, yang selanjutnya dapat dipergunakan sebagai dasar pengajuan permohonan Izin Mempekerjakan Tenaga Kerja Asing;
		</td>
    </tr>
	
	<tr>
		<td width="100%" align="Center"></td>
    </tr>
	
	<tr>
		<td width="20%" align="Left">KEDUA</td>
		<td width="2%" align="Center">:</td>
		<td width="2%" align="Center"></td>
		<td width="76%" align="Justify">
		Perusahaan wajib menunjuk Tenaga Kerja Indonesia sebagai pendamping Tenaga Kerja Asing, pada jabatan yang ditetapkan dalam Rencana Penggunaan Tenaga Kerja Asing;
		</td>
    </tr>
	
	<tr>
		<td width="100%" align="Center"></td>
    </tr>
	
	<tr>
		<td width="20%" align="Left">KETIGA</td>
		<td width="2%" align="Center">:</td>
		<td width="2%" align="Center"></td>
		<td width="76%" align="Justify">
		{$result['Ketiga']}
		</td>
    </tr>
	
	<tr>
		<td width="100%" align="Center"></td>
    </tr>
	
	<tr>
		<td width="20%" align="Left">KEEMPAT</td>
		<td width="2%" align="Center">:</td>
		<td width="2%" align="Center"></td>
		<td width="76%" align="Justify">
		Keputusan ini mulai berlaku sejak tanggal ditetapkan, dengan ketentuan apabila dikemudian hari terdapat kekeliruan dalam penetapan, akan di perbaiki sebagaimana mestinya.
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
$pdf->SetFont('helvetica', '',9 );
$tbl = <<<EOD
<table cellspacing="0" cellpadding="0" border="0">

    <tr>
	
		<td width="53%" align="Right"></td>
		
		<td width="20%" align="Left">
			Ditetapkan di
		</td>
		
		<td width="2%" align="Center">
			:
		</td>
		
		<td width="25%" align="Left">
			Kupang
		</td>
    </tr>
	
	<tr>
		<td width="53%" align="Right"></td>
		
		<td width="20%" align="Left">
			Pada Tanggal
		</td>
		
		<td width="2%" align="Center">
			:
		</td>
		
		<td width="25%" align="Left">
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

$pdf->SetFont('helvetica', '',9 );
$tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="0">

    <tr>
		<td width="55%" align="Left">Tembusan :</td>
		<td width="45%" align="Left"></td>
    </tr>
	
	<tr>
		<td width="100%" align="Left">{$tembusan}</td>
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
// -----------------------------------------------------------------------------


// add a page
$resolution= array(210, 335);
$pdf->setPrintHeader(false);
$pdf->SetMargins(25,20,25);
$pdf->AddPage('L', $resolution);

// convert TTF font to TCPDF format and store it on the fonts folder
//$fontname = TCPDF_FONTS::addTTFfont('font/Tahoma.ttf', 'TrueTypeUnicode', '', 96);

// use the font
$pdf->SetFont('helvetica', '',11 );

//$pdf->SetFont('Tahoma', '', 9);

// -----------------------------------------------------------------------------

$tbl = <<<EOD
<table  cellspacing="0" cellpadding="2" border="0">

    <tr>
       <td style="text-align:center;">LAMPIRAN : KEPUTUSAN KEPALA KANTOR PELAYANAN PERIZINAN TERPADU SATU PINTU PROVINSI NTT</td>
    </tr>
	

	<tr>
	   <td width="45%" align="Left" ></td>
       <td width="18%" align="Left" >TANGGAL </td>
	   <td width="2%" align="center" > : </td>
	   <td width="35%" align="Left" >{$tgl}</td>
    </tr>
	
	<tr>
	   <td width="45%" align="Left" ></td>
       <td width="18%" align="Left" >NOMOR </td>
	   <td width="2%" align="center" > : </td>
	   <td width="35%" align="Left" >{$nomor}</td>
    </tr>
	
	<tr>
       <td  width="100%" style="text-align:center;">TENTANG PENGESAHAAN RENCANA PENGGUNAAN TENAGA KERJA ASING MENURUT JABATAN JUMLAH DAN JANGKA WAKTU</td>
    </tr>
	
	<tr>
	   <td width="45%" align="Left" ></td>
       <td width="18%" align="Left" >PERUSAHAAN </td>
	   <td width="2%" align="center" > : </td>
	   <td width="35%" align="Left" >{$namaperusahaan}</td>
    </tr>
	
	<tr>
	   <td width="45%" align="Left" ></td>
       <td width="18%" align="Left" >ALAMAT </td>
	   <td width="2%" align="center" > : </td>
	   <td width="35%" align="Left" >{$alamatperusahaan}</td>
    </tr>
	
	<tr>
	   <td width="45%" align="Left" ></td>
       <td width="18%" align="Left" >TELEPON </td>
	   <td width="2%" align="center" > : </td>
	   <td width="35%" align="Left" >{$telepon}</td>
    </tr>
	
	<tr>
	   <td width="45%" align="Left" ></td>
       <td width="18%" align="Left" >JENIS USAHA / KOMODITI </td>
	   <td width="2%" align="center" > : </td>
	   <td width="35%" align="Left" >{$jenisusaha}</td>
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------
$stmt = null;
$result = null;
$stmt = $db->connect()->query("SELECT * FROM pptkadtl WHERE NoPPTKA={$no_pptka} AND Tag>=0");
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
$fulldate = date_parse($tgl_terbit);
$year1 = $fulldate["year"];
$year2 = $year1 + 1;
$year3 = $year2 + 1;

$tbl = "<table cellspacing=\"0\" cellpadding=\"3\" border=\"1\">"
    . "<tr>"
    . "<td width=\"5%\" align=\"Center\" rowspan=\"2\">No. </td>"
    . "<td width=\"25%\" align=\"Center\" rowspan=\"2\">NAMA / JENIS JABATAN </td>"
    . "<td width=\"21%\" align=\"Center\" colspan=\"3\"> TAHUN PENGGUNAAN</td>"
    . "<td width=\"49%\" align=\"Center\" rowspan=\"2\">KETERANGAN</td>"
    . "</tr>"
    . "<tr>"
    . "<td width=\"7%\" align=\"Center\" > {$year1}</td>"
    . "<td width=\"7%\" align=\"Center\" > {$year2}</td>"
    . "<td width=\"7%\" align=\"Center\" > {$year3}</td>"
    . "</tr>";
$i=1;
$row_count = count($result);
foreach($result as $row) {
    $tbl .= "<tr>";
    $tbl .= "<td width=\"5%\" align=\"Center\">{$i}</td>";
    $tbl .= "<td width=\"25%\">{$row['JenisJabatan']}</td>";
    $tbl .= "<td width=\"7%\" align=\"Center\">1</td>";
    $tbl .= "<td width=\"7%\" align=\"Center\">1</td>";
    $tbl .= "<td width=\"7%\" align=\"Center\">1</td>";
    if ($i==1) {
        $tbl .= "<td width=\"49%\" rowspan=\"{$row_count}\">{$row['Keterangan']}</td>";
    }
    $tbl .= "</tr>";
    $i++;
}
$tbl .= "</table>";

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
	
		<td width="53%" align="Right"></td>
		
		<td width="20%" align="Left">
			Ditetapkan di
		</td>
		
		<td width="2%" align="Center">
			:
		</td>
		
		<td width="25%" align="Left">
			Kupang
		</td>
    </tr>
	
	<tr>
		<td width="53%" align="Right"></td>
		
		<td width="20%" align="Left">
			Pada Tanggal
		</td>
		
		<td width="2%" align="Center">
			:
		</td>
		
		<td width="25%" align="Left">
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
$pdf->Output('pptka.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
