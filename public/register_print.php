<?php

/*
 * Licensed to Bill Radja Pono <baingao@gmail.com>
 * Unauthorized use is prohibited
 */

require_once 'includes.php';
require_once INCLUDES_PATH . DS . "tcpdf/tcpdf.php";


session_start();

$noreg = $_GET["PRINT_KEY"];

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
$alamat = $result['AlamatPemohon'];
$telp = $result ['TelpPemohon'];
$user = $result['User'];
$namaizin = $result['NamaIzin'];
$lama = $result['LamaPengurusan'];

$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetMargins(15, 20, 15);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->AddPage();

$tbl = <<<EOD
<table cellspacing="0" cellpadding="0" border="0">
    <tr>
        <td width="18%" align="center">
            <img src="images/ntt.jpg" height="70px">
        </td>
        <td width="82%" align="center">
            <span style="font-size: '130%'; font-weight: bold;">PEMERINTAH PROVINSI NUSA TENGGARA TIMUR</span><br>
            <span style="font-size: '110%'; font-weight: bold;">KANTOR PELAYANAN PERIZINAN TERPADU SATU PINTU</span><br>
            Jalan Teratai No. 10 - Telp/Fax (0380) 833213<br>
            Email : kpptspprovntt@yahoo.com, Website : www.kpptsp-provntt.org
        
        </td>
    </tr>
    <tr>
        <td><hr style="background-color: red; height: 1px; border: 0;"></td>
        <td><hr style="background-color: red; height: 1px; border: 0;"></td>
    </tr>
</table>

<table cellpadding="0" border="0">
    <tr>
        <td width="10%"></td>
        <td width="80%" border="1"><table cellpadding="5" border="0">
                <tr>
                    <td width="50%" colspan="2" border="1"><strong> No. Pendaftaran : {$noreg}</strong></td>
                    <td width="50%" border="1"><strong> Tanggal : {$tgl}</strong></td>
                </tr>
                <tr>
                    <td width="30%"> Nama Pemohon</td>
                    <td width="5%">:</td>
                    <td width="65%">{$nama}</td>
                </tr>
                <tr>
                    <td width="30%"> Alamat Pemohon</td>
                    <td width="5%">:</td>
                    <td width="65%">{$alamat}</td>
                </tr>
                <tr>
                    <td width="30%"> No. Telp Pemohon</td>
                    <td width="5%">:</td>
                    <td width="65%">{$telp}</td>
                </tr>
                <tr>
                    <td colspan="3" border="1"><table cellpadding="3" border="0">
                            <tr> 
                                <td width="20%"><strong>Nama Izin :</strong></td>
                                <td width="80%"><strong>{$namaizin}</strong></td>
                            </tr>
                            <tr> 
                                <td width="60%">Perkiraan Waktu : {$lama} hari</td>
                                <td width="40%" align="right"> </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
        <td width="10%"></td>
    </tr>   
    <tr>
        <td width="10%"></td>
        <td width="80%"></td>
        <td width="10%"></td>
    </tr>
    <tr>
        <td width="10%"></td>
        <td width="80%"><table cellpadding="0" border="0">
                <tr>
                    <td width="5%">1.</td>
                    <td width="95%">Ketik PROSES#No.Pendaftaran, kirim ke 08113864955 untuk mengetahui proses pembuatan izin.</td>
                </tr>
                <tr>
                    <td width="5%">2.</td>
                    <td width="95%">Izin dapat diambil ketika berstatus: SELESAI.</td>
                </tr>
            </table>
        </td>
        <td width="10%"></td>
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
$pdf->Output();
//echo "<html><head><title>Cetak Bukti Registrasi</title></head></html>";
?>
