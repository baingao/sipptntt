<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function createMenuEntryIzin() {
    $db_list_izin = new DbConnect();
    $query_list_izin = $db_list_izin->connect()->query("SELECT AI, JenisIzin, NamaIzin FROM jenisizin ORDER BY NamaIzin");
    $list_izin = $query_list_izin->fetchAll(PDO::FETCH_ASSOC);
    foreach ($list_izin as $izin) {
        $jenis_izin = strtolower($izin["JenisIzin"]);
        echo "<li><a href=\"izin_data.php?q={$jenis_izin}\" value=\"{$jenis_izin}\">" . $izin["NamaIzin"] . "</a></li>";
        //echo "<li><a href=\"" . strtolower($izin["JenisIzin"]) . "_data.php\">" . $izin["NamaIzin"] . "</a></li>";
    }
}
