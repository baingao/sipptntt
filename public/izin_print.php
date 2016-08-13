<?php

/*
 * Licensed to Bill Radja Pono <baingao@gmail.com>
 * Unauthorized use is prohibited
 */
$print_key = $_GET["PRINT_KEY"];
require_once "includes.php";
$db = new DbConnect();
$stmt = $db->connect()->query("SELECT register.AI, register.idJenisIzin, jenisizin.JenisIzin" 
        . " FROM register LEFT JOIN jenisizin ON jenisizin.AI=register.idJenisIzin"
        . " WHERE register.AI={$print_key}");
$result = $stmt->fetch(PDO::FETCH_ASSOC);
if ($result!=null) {
    $jenis_izin = strtolower($result['JenisIzin']);
    header("location: reports/{$jenis_izin}_print.php?PRINT_KEY={$print_key}");
}
