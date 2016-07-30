<?php
// ** Created by Bill Radja Pono on 07/23/2016
session_start();
require_once "header.php";
define("TABLE_NAME", "register");

$param = $_SESSION["UPDATE_KEY"];
$table = new Table();
$table->setKecuali(array("NoReg", "Tag", "JK", "TglTerbit", "TglDaftar", "TglCek", "TglKadaluarsa", "TglDaftarUlang", "TglKadaluarsa", "JumlahDaftarUlang", "TglUpdate", "TglSelesai", "Proses", "User", "TagSms"));
$table->buildTable(TABLE_NAME, FALSE);
$_SESSION["SELECT_SQL"] = $table->getSelectSql(); $sql_select = $_SESSION["SELECT_SQL"];
$_SESSION["UPDATE_SQL"] = $table->getUpdateSql(); $sql_update = $_SESSION["UPDATE_SQL"];
$db = new DbConnect();
$stmt = $db->connect()->prepare($sql_select);
$stmt->execute(array($param));
$select_result = $stmt->fetch(PDO::FETCH_ASSOC);
foreach ($select_result as $key => $value) {
    $row_value[$key] = $value;
}
?>

<!DOCTYPE html>
<head>
    <title>Register Edit</title>
</head>
<body>
    <div class="container-fluid header">
        <div id="content-title">
            <h3>Register : Edit</h3>
        </div>
        <div id="button-container" class="form-button"></div>
    </div>
    <div id="message-container"></div>
    <div id="content-main" class="content-center">
        <div class="container-fluid">
            <div class="columns-2">
                <form id="insert-form" role="form">    
                    <?php
                    $table->buildTableWithValue(TABLE_NAME, $row_value, TRUE);
//                    echo $param . "<br>";
//                    echo $sql_select . "<br>";
//                    echo $sql_update . "<br>";
//                    print_r($row_value);
                    ?>
                </form>
            </div>
        </div>
    </div>
    <div id="message-container"></div>
    <script type="text/javascript">
        $(document).ready(function () {
            showUpdateButton();
            var idKab;
            var idKec;
            var idKel;
            idKab = document.getElementById('idKab').value;
            idKec = <?php echo json_encode($row_value['idKec']); ?>;
            idKel = <?php echo json_encode($row_value['idKel']); ?>;
            //showKecamatan(idKab, idKec);
            //showKelurahan(idKec, idKel);
            showKecKel(idKab, idKec, idKel);
        });
    </script>
</body>

</html>