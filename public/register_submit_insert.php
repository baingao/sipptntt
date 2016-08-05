<?php
// *** PERHATIAN ***
// *** File ini hanya untuk digunakan oleh register_baru.php ***
// *** Tidak bisa untuk yang lain ***

session_start();
require_once "includes.php";
if (isset($_SESSION['ID_USER'])) {
    User::isLoggedIn($_SESSION['ID_USER'], $_SESSION['API_KEY'], $_SESSION['LOGIN_TIME']);
} else {
    header('location: index.php');
}

$q = $_GET['params']; // dari ajax_form_handler.js

$db = new DbConnect();
$sql = $_SESSION["INSERT_SQL"];
$params = explode(ARRAY_DELIMITER, $q);
$array_list = array();
for ($i = 0; $i < count($params); $i++) {
    $key = getStringBetween($params[$i], KEY_DELIMITER, KEY_DELIMITER);
    $value = getStringBetween($params[$i], VALUE_DELIMITER, VALUE_DELIMITER);
    $array_list[$key] = $value;
}
    $stmt = $db->connect()->prepare($sql);
    $stmt->execute($array_list);
    $lastInsertId = $db->getLastInsertId();
    $affected_rows = $stmt->rowCount();
    
    echo "<div class='container-fluid col-lg-4 col-lg-push-4 col-md-4 col-md-push-4 col-sm-6 col-sm-push-3 col-xs-12' style='text-align: center;'>";
    echo "<h3>Nomor Registrasi : " . $lastInsertId . "</h3>";
    echo "<p>&nbsp</p>";
    echo "<a type='button' class='btn btn-block btn-danger' value={$lastInsertId} href='register_print.php?PRINT_KEY={$lastInsertId}' target='_blank'><i class='glyphicon glyphicon-print'></i> Cetak Bukti Registrasi</a>";
    echo "</div>";
    
    if (strtoupper(BUILD) == "DEBUG") {
        echo "<div class='container-fluid' style='margin-top: 25px;'>";
        echo "insert sql : <br>";
        echo $sql;
        echo "<p>&nbsp</p>";
        echo "raw data : <br>";
        print_r($params);
        echo "<p>&nbsp</p>";
        echo "array list : <br>";
        print_r($array_list);
        echo "<p>&nbsp</p>insert id : " . $lastInsertId . "<br>";
        echo "<p>&nbsp</p>" . $affected_rows . " rows inserted <br>";
        echo "</div>";
    }
    
    $stmt = null;
//    logIzin($no_reg, $id_transaksi, $transaksi, $no_izin, $proses, $user_id, $username, $api_key);
?>