<?php

require_once 'includes.php';

$id_kab = intval($_GET['id_kab']);
$db = new DbConnect();
$sql = "SELECT AI, NamaKecamatan FROM kecamatan WHERE idKabupaten = '" . $id_kab . "'";
$sql .= " ORDER BY NamaKecamatan";
$result = $db->connect()->query($sql);
$kecamatan = $result->fetchAll(PDO::FETCH_ASSOC);
echo "<select id=\"idKec\" name=\"kecamatan\" class=\"form-control\" onchange=\"showKelurahan(this.value)\">";
echo "<option value=\"\">Pilih Kecamatan...</option>";
foreach ($kecamatan as $option) {
    echo "<option value=\"" . $option["AI"] . "\">" . $option["NamaKecamatan"] . "</option>";
}
echo "</select>";
$result = null;

?>