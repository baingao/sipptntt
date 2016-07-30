<?php
session_start();
require_once "includes.php";

$q = $_GET['params']; // dari ajax_form_handler.js

$db = new DbConnect();
$sql = $_SESSION["INSERT_SQL"];
$params = explode("|", $q);
$array_list = array();
for ($i = 0; $i < count($params); $i++) {
    $key = getStringBetween($params[$i], "'", "'");
    $value = getStringBetween($params[$i], "_", "_");
    $array_list[$key] = $value;
}
?>
<div class="container-fluid">
    <?php
    echo "insert sql : <br>";
    echo $sql;
    echo "<p>&nbsp</p>";
    echo "raw data : <br>";
    print_r($params);
    echo "<p>&nbsp</p>";
    echo "array list : <br>";
    print_r($array_list);

    $stmt = $db->connect()->prepare($sql);
    $stmt->execute($array_list);

    echo "<p>&nbsp</p>Last insert ID : " . $db->getLastInsertId();

    $affected_rows = $stmt->rowCount();
    echo "<p>&nbsp</p>" . $affected_rows . " rows inserted <br>";
    $stmt = null;
    ?>
</div>