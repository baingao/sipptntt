<?php

require_once "../includes.php";
require_once INCLUDES_PATH . DS . "tcpdf/examples/tcpdf_include.php";
session_start();

$noreg=$_GET["PRINT_KEY"];
$db = new DbConnect();

$stmt = $db->connect()->query("select iopos.NoReg, iopos.NamaOrganisasi, iopos.AlamatOrganisasi, iopos.Nomor, iopos.Tgl, iopos.NoRekomendasi, 
		iopos.TglRekomendasi, iopos.NoAkteNotaris, iopos.TglAkteNotaris, iopos.TipeOrganisasi, iopos.JnsKegiatan, 
		iopos.BerlakuSampai, iopos.Tembusan, register.NamaPemohon,
		kelurahan.NamaKelurahan, kecamatan.NamaKecamatan, kabupaten.NamaKabupaten
		from iopos inner join register on iopos.NoReg=register.AI inner join kelurahan on register.idKel=kelurahan.AI
		inner join kecamatan on register.idKec=kecamatan.AI inner join kabupaten on register.idKab=kabupaten.AI
		where iopos.NoReg={$noreg}");
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$noreg = $result['NoReg'];
$nomor = $result['Nomor'];
$nama = $result['NamaPemohon'];
$namaorganisasi = $result['NamaOrganisasi'];
$almtorganisasi = $result['AlamatOrganisasi'];
$kelurahan = $result['NamaKelurahan'];
$kecamatan = $result['NamaKecamatan'];
$kabupaten = $result['NamaKabupaten'];
$tgl = InputSelect::parseDate($result['Tgl']);
$norekomendasi = $result['NoRekomendasi'];
$tglrekomendasi = InputSelect::parseDate($result ['TglRekomendasi']);
$noakte = $result['NoAkteNotaris'];
$tglakte = InputSelect::parseDate($result['TglAkteNotaris']);
$tipe = $result['TipeOrganisasi'];
$jns = $result['JnsKegiatan'];
$berlaku = InputSelect::parseDate($result['BerlakuSampai']);
$tembusan = $result['Tembusan'];



// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// add a page
$resolution = array(210, 330);
$pdf->setPrintHeader(false);
$pdf->SetMargins(20, 35, 20);

// add a page
$pdf->AddPage('P', $resolution);

$pdf->SetFont('helvetica', 'B', 11);

// -----------------------------------------------------------------------------

$tbl = <<<EOD
<table  cellspacing="0" cellpadding="1" border="0">

    <tr>
       <td style="text-align:center;">IZIN OPERASIONAL PENDIRIAN ORGANISASI SOSIAL</td>
    </tr>
	
	<tr>
       <td style="text-align:center;">NOMOR : {$nomor}</td>
    </tr>

</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------
$pdf->SetFont('helvetica', '', 10);
$tbl = <<<EOD
<table cellspacing="0" cellpadding="3" border="0">

    <tr>

		<td width="100%" align="Justify">
			<p style="line-height:2">Berdasarkan Undang-Undang Nomor : 11 Tahun 2009, Peraturan Menteri Sosial Republik Indonesia Nomor : 184 Tahun 2011 Dan Surat Rekomendasi Kepala Dinas Sosial Provinsi Nusa Tenggara Timur Nomor : {$norekomendasi} tanggal {$tglrekomendasi}, maka Kepala Kantor Pelayanan Perizinan Terpadu Satu Pintu (KPPTSP) Provinsi Nusa Tenggara Timur atas nama Gubernur Nusa Tenggara Timur memberikan Izin Operasional kepada :</p>
		</td>
    </tr>

    <tr>
		<td width="5%" align="center"></td>
		<td width="32%" align="Left">
			Nama Organisasi Sosial
		</td>
		<td width="2%" align="center">:</td>
		<td width="56%" align="Left">
			{$namaorganisasi}
		</td>
		<td width="5%" align="center"></td>
    </tr>
	
	<tr>
		<td width="5%" align="center"></td>
		<td width="32%" align="Left">
			Alamat Sekretariat
		</td>
		<td width="2%" align="center">:</td>
		<td width="56%" align="Left">
			{$almtorganisasi}
		</td>
		<td width="5%" align="center"></td>
    </tr>
	
	<tr>
		<td width="5%" align="center"></td>
		<td width="32%" align="Left">
			Kelurahan
		</td>
		<td width="2%" align="center">:</td>
		<td width="56%" align="Left">
			{$kelurahan}
		</td>
		<td width="5%" align="center"></td>
    </tr>
	
	<tr>
		<td width="5%" align="center"></td>
		<td width="32%" align="Left">
			Kecamatan
		</td>
		<td width="2%" align="center">:</td>
		<td width="56%" align="Left">
			{$kecamatan}
		</td>
		<td width="5%" align="center"></td>
    </tr>
	
	<tr>
		<td width="5%" align="center"></td>
		<td width="32%" align="Left">
			Kabupaten/Kota
		</td>
		<td width="2%" align="center">:</td>
		<td width="56%" align="Left">
			{$kabupaten}
		</td>
		<td width="5%" align="center"></td>
    </tr>

	
	<tr>
		<td width="5%" align="center"></td>
		<td width="32%" align="Left">
			Nama Ketua
		</td>
		<td width="2%" align="center">:</td>
		<td width="56%" align="Left">
			{$nama}
		</td>
		<td width="5%" align="center"></td>
    </tr>
	
	<tr>
		<td width="5%" align="center"></td>
		<td width="32%" align="Left">
			No. dan Tanggal Akte Notaris
		</td>
		<td width="2%" align="center">:</td>
		<td width="56%" align="Left">
			Nomor {$noakte} tanggal {$tglakte}
		</td>
		<td width="5%" align="center"></td>
    </tr>
	
	<tr>
		<td width="5%" align="center"></td>
		<td width="32%" align="Left">
			Tipe Organisasi Sosial
		</td>
		<td width="2%" align="center">:</td>
		<td width="56%" align="Left">
			{$tipe}
		</td>
		<td width="5%" align="center"></td>
    </tr>
	
	<tr>
		<td width="5%" align="center"></td>
		<td width="32%" align="Left">
			Jenis Kegiatan
		</td>
		<td width="2%" align="center">:</td>
		<td width="56%" align="Left">
			{$jns}
		</td>
		<td width="5%" align="center"></td>
    </tr>
	
	<tr>
		<td width="5%" align="center"></td>
		<td width="32%" align="Left">
			Berlaku Sampai Dengan Tanggal
		</td>
		<td width="2%" align="center">:</td>
		<td width="56%" align="Left">
			{$berlaku}
		</td>
		<td width="5%" align="center"></td>
    </tr>

    <tr>

		<td width="100%" align="Justify">
			<p style="line-height:2">Izin Operasional Organisasi Sosial ini dapat ditinjau kembali atau dicabut, apabila terjadi penyimpangan dalam pelaksanaan kegiatan.</p> 
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

$pdf->SetFont('helvetica', '', 9);
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
		<td width="45%" align="Right">

			<img style="margin-top:5px;" src="../images/pasfoto.png" height="50">
		</td>
		<td width="40%" align="center">

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
$pdf->SetFont('helvetica', '', 8);
$tbl = <<<EOD
<table cellspacing="0" cellpadding="0" border="0">

    <tr>
		<td width="55%" align="Left">Tembusan :</td>
		<td width="45%" align="Left"></td>
    </tr>
	
	<tr>
		<td width="100%" colspan="2" align="Left">{$tembusan}</td>
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
$pdf->Output('sipptntt_iopos.pdf', 'I');
