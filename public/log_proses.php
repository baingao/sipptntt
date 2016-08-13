<?php

/* 
 * Licensed to Bill Radja Pono <baingao@gmail.com>
 * Unauthorized use is prohibited
 */

$no_reg = $_GET['NO_REG'];
$id_transaksi = $_GET['ID_TRANSAKSI'];
$no_izin = $_GET['NO_IZIN'];
$proses = $_GET['PROSES'];
$keterangan = $_GET['KETERANGAN'];
$user = $_GET['USER'];
$transaksi = $_GET['TRANSAKSI'];
$db = new DbConnect();
$sql = "INSERT INTO log (NoReg, idTransaksi, NoIzin, Proses, Keterangan, User, Transaksi"
        . " VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $db->connect()->prepare($sql);
$stmt->execute(array());