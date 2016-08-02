<?php

session_start();
require_once "includes.php";

if (isset($_GET['DELETE_KEY'])) {
    $_SESSION['DELETE_KEY'] = $_GET['DELETE_KEY'];
}
if (isset($_GET['DELETE_TABLE_NAME'])) {
    $_SESSION['DELETE_TABLE_NAME'] = $_GET['DELETE_TABLE_NAME'];
}
if (isset($_GET['DELETE_RETURN_TO'])) {
    $_SESSION['DELETE_RETURN_TO'] = $_GET['DELETE_RETURN_TO'];
}

$key_field = $_SESSION["DELETE_KEY"];
$table_name = $_SESSION["DELETE_TABLE_NAME"];
$return_to = $_SESSION["DELETE_RETURN_TO"];
$sql = "UPDATE ".$table_name." SET Tag=-1 WHERE AI=?";
$db = new DbConnect();
$stmt = $db->connect()->prepare($sql);
$stmt->execute(array($key_field));
$rowsAffected = $stmt->rowCount();
header("location: " . $return_to);