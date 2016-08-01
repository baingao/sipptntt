<?php
session_start();
require_once "includes.php";

$q = $_GET['params']; // dari ajax_form_handler.js

$db = new DbConnect();
$sql = $_SESSION["UPDATE_SQL"];
$params = explode(ARRAY_DELIMITER, $q);
$array_list = array();
for ($i = 0; $i < count($params); $i++) {
    $key = getStringBetween($params[$i], KEY_DELIMITER, KEY_DELIMITER);
    $value = getStringBetween($params[$i], VALUE_DELIMITER, VALUE_DELIMITER);
    $array_list[$key] = $value;
}
?>
<div class="container-fluid">
    <?php
    if (strtoupper(BUILD) == "DEBUG") {
        echo "update sql : <br>";
        echo $sql;
        echo "<p>&nbsp</p>";
        echo "raw data : <br>";
        print_r($q);
        echo "<p>&nbsp</p>";
        echo "exploded data : <br>";
        print_r($params);
        echo "<p>&nbsp</p>";
        echo "array list : <br>";
        print_r($array_list);
    }

    $stmt = $db->connect()->prepare($sql);
    $stmt->execute($array_list);

    echo "<p>&nbsp</p>Update key ID : " . $array_list[":AI"];

    $affected_rows = $stmt->rowCount();
    echo "<p>&nbsp</p>" . $affected_rows . " rows updated <br>";
    $stmt = null;
    ?>
</div>