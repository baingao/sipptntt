<?php

session_start();
require_once "includes.php";
if (isset($_SESSION['ID_USER'])) {
    User::isLoggedIn($_SESSION['ID_USER'], $_SESSION['API_KEY'], $_SESSION['LOGIN_TIME']);
} else {
    header('location: index.php');
}

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
echo $return_to;
$_SESSION["DELETE_KEY"] = null;
$_SESSION["DELETE_TABLE_NAME"] = null;
$_SESSION["DELETE_RETURN_TO"] = null;
if ($table_name=="user") {
    $sql = "UPDATE ".$table_name." SET Tag=-1 WHERE idUser=?";
} else {
    $sql = "UPDATE ".$table_name." SET Tag=-1 WHERE AI=?";
}
$db = new DbConnect();
$stmt = $db->connect()->prepare($sql);
$stmt->execute(array($key_field));
$rowsAffected = $stmt->rowCount();
//header("location: " . $return_to);