<?php

/* 
 * Licensed to Bill Radja Pono <baingao@gmail.com>
 * Unauthorized use is prohibited
 */
session_start();
require_once "includes.php";
if (isset($_SESSION['ID_USER'])) {
    User::isLoggedIn($_SESSION['ID_USER'], $_SESSION['API_KEY'], $_SESSION['LOGIN_TIME']);
} else {
    header('location: index.php');
}

$register_data = $_SESSION["REGISTER_DATA"];
$nama_izin = strtolower($register_data['JenisIzin']);
$nama_izin_panjang = $register_data['NamaIzin'];
$js_nama_izin_panjang = str_replace(" ", "-", $nama_izin_panjang);
$terbit_key = $register_data["AI"];
$db = new DbConnect();
$stmt = $db->connect()->query("SELECT AI FROM {$nama_izin} WHERE NoReg={$terbit_key}");
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = null;
//print_r($result);
if ($result != null) {
    $update_key = $result["AI"];
} else {
    $dba = new DbConnect();
    $stmta = $dba->connect()->prepare("INSERT INTO ".$nama_izin." (NoReg, Tgl) VALUES (?, (SELECT CURDATE()))");
    $stmta->execute(array($terbit_key));
    $update_key = $dba->getLastInsertId();
}
//$_SESSION["UPDATE_KEY"] = $key_baru;
//$_SESSION["NAMA_IZIN"] = $jenis_izin;
header("location: izin_edit.php?NAMA_IZIN={$nama_izin}&NAMA_IZIN_PANJANG={$js_nama_izin_panjang}&UPDATE_KEY={$update_key}");

// Varian untuk pakai file untuk masing-masing izin
// header("location: {$jenis_izin}_edit.php");

