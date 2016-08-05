<?php

session_start();
require_once 'includes.php';

$id_kab = $_GET['ID_KAB'];
$db = new DbConnect();
$sql = "SELECT AI, Ternak FROM ipptquota WHERE idKab={$id_kab}";
$result = $db->connect()->query($sql);
$ternak = $result->fetchAll(PDO::FETCH_ASSOC);
if ($ternak != null) {
//    echo "<select id='idTernak' nama='input_idTernak' class='form-control'>";
    foreach ($ternak as $select_ternak) {  
        echo "<option value={$select_ternak['AI']}>{$select_ternak['Ternak']}</option>";
    }
//    echo "</select>";
    $result = null;
}
?>