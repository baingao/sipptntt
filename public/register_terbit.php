<?php

/* 
 * Licensed to Bill Radja Pono <baingao@gmail.com>
 * Unauthorized use is prohibited
 */
session_start();
require_once 'includes.php';
$register_data = $_SESSION["REGISTER_DATA"];

$jenis_izin = strtolower($register_data['JenisIzin']);
$terbit_key = $register_data["AI"];
$db = new DbConnect();
$stmt = $db->connect()->query("SELECT AI FROM {$jenis_izin} WHERE NoReg={$terbit_key}");
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = null;
//print_r($result);
if ($result != null) {
    $key_baru = $result["AI"];
} else {
    $dba = new DbConnect();
    $stmta = $dba->connect()->prepare("INSERT INTO ".$jenis_izin." (NoReg, Tgl) VALUES (?, (SELECT CURDATE()))");
    $stmta->execute(array($terbit_key));
    $key_baru = $dba->getLastInsertId();
}
$_SESSION["UPDATE_KEY"] = $key_baru;
header("location: {$jenis_izin}_edit.php");
