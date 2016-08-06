<?php
session_start();
require_once 'includes.php';

$nama_izin= $_GET['NAMA_IZIN'];
$js_nama_izin_panjang = $_GET['NAMA_IZIN_PANJANG'];
$nama_izin_panjang = str_replace("-", " ", $js_nama_izin_panjang);
$param_id = $_GET['PARAM_ID'];
$db = new DbConnect();
$sql = "SELECT COLUMN_NAME, COLUMN_TYPE, COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '" . DB_NAME . "' AND TABLE_NAME = '{$nama_izin}'";
$result = $db->connect()->query($sql);
$lampiran = $result->fetch(PDO::FETCH_ASSOC);
if ($lampiran != null) {
    if (isInString($lampiran['COLUMN_COMMENT'], '<LAMPIRAN>') == true) {
        $tabel_lampiran = getStringBetween($lampiran['COLUMN_COMMENT'], '<LAMPIRAN>', '</LAMPIRAN>');
        $array_lampiran = explode(",", getStringBetween($lampiran['COLUMN_COMMENT'], '<LAMPIRAN>', '</LAMPIRAN>'));
        echo "<form id='form-button-lampiran' class='form-inline' method='post'>";
        $jumlah_lampiran = count($array_lampiran);
        for ($i = 0; $i < count($array_lampiran); $i++) {
            $j = $i + 1;
            if ($jumlah_lampiran>1) { 
                echo "<button onclick='showLampiranIzin(\"".$nama_izin."\", \"".$js_nama_izin_panjang."\", this.value, \"".$param_id."\")' class='btn btn-primary' style='margin-right: 10px' type='button' id='{$array_lampiran[$i]}' name='{$array_lampiran[$i]}' value='{$array_lampiran[$i]}'><span>Lampiran {$j}</span></button>";
//                echo "<button onclick='showLampiranIzin(this.value)' class='btn btn-primary btn-space' style='margin-right: 10px' type='button' id='{$array_lampiran[$i]}' name='{$array_lampiran[$i]}' value='{$array_lampiran[$i]}'><span>Lampiran {$j}</span></button>";
            } else {              
                echo "<button onclick='showLampiranIzin(\"".$nama_izin."\", \"".$js_nama_izin_panjang."\", this.value, \"".$param_id."\")' class='btn btn-primary btn-block' style='margin-right: 10px' type='button' id='{$array_lampiran[$i]}' name='{$array_lampiran[$i]}' value='{$array_lampiran[$i]}'><span>L a m p i r a n</span></button>";
//                echo '<button onclick=test("'.$nama_izin.'"); class="btn btn-primary btn-block" style="margin-right: 10px" type="button"><span>L a m p i r a n</span></button>';    
            }
        }
        echo "</form>";
    }
    $result = null;
}
?>