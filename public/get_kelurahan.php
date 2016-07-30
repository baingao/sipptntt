<?php
require_once 'includes.php';

$id_kec = intval($_GET['id_kec']);
$id_kel = intval($_GET['id_kel']);
$db = new DbConnect();
$sql = "SELECT AI, NamaKelurahan FROM kelurahan WHERE idKecamatan = '" . $id_kec . "'";
$sql .= " ORDER BY NamaKelurahan";
$result = $db->connect()->query($sql);
$kelurahan = $result->fetchAll(PDO::FETCH_ASSOC);
echo "<select id=\"idKel\" name=\"kelurahan\" class=\"form-control\">";
echo "<option value=\"\">Pilih Desa/Kelurahan...</option>";
foreach ($kelurahan as $option) {
    if ($option['AI'] == $id_kel) {
        echo "<option value=\"" . $option["AI"] . "\" selected>" . $option["NamaKelurahan"] . "</option>";
    } else {
        echo "<option value=\"" . $option["AI"] . "\">" . $option["NamaKelurahan"] . "</option>";
    }
}
echo "</select>";
$result = null;

?>