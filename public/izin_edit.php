<?php
// ** Created by Bill Radja Pono on 07/31/2016
// ** path to be here :
// ** header.php -> function_nav.php (createMenuEntryIzin())
// ** izin_data.php -> class_table.php (tablefromsql()) -> izin_data.php(POST[button_edit]);
// ** atau :
// ** register_data.php -> class_table.php (tablefromsql()) -> register_data.php(POST[button_edit]);

session_start();
require_once "includes.php";
if (isset($_SESSION['ID_USER'])) {
    User::isLoggedIn($_SESSION['ID_USER'], $_SESSION['API_KEY'], $_SESSION['LOGIN_TIME']);
} else {
    header('location: index.php');
}

require_once "header.php";

//$param = $_SESSION["UPDATE_KEY"];
//$nama_izin = $_SESSION["NAMA_IZIN"];
//$nama_izin_panjang = $_SESSION["NAMA_IZIN_PANJANG"];
$param = $_GET["UPDATE_KEY"];
$nama_izin = $_GET["NAMA_IZIN"];
$js_nama_izin_panjang = $_GET["NAMA_IZIN_PANJANG"];
$nama_izin_panjang = str_replace("-", " ", $js_nama_izin_panjang);
$table = new Table();
$table->setKecuali(array("NoReg", "Tag"));
$table->buildTable($nama_izin, FALSE);
$_SESSION["LAMPIRAN_KEYFIELD"] = $table->getKeyField();
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
<html>
<head>
    <title><?php echo $nama_izin_panjang; ?> Edit</title>
</head>
<body>
    <div id="content-header" class="container-fluid header" style="display: none;">
        <div id="content-title">
            <h3 class="tlt" data-in-effect="fadeInDownBig" data-out-effect="hinge"><?php echo $nama_izin_panjang;?> : Edit</h3>
        </div>
        <div id="button-container" class="form-button"></div>
    </div>
    <div id="message-container"></div>
    <div id="content-main" class="content-center" style="display: none;">
        <div class="container-fluid">
            <div class="columns-2">
                <form id="insert-form" role="form">    
                    <?php
                    $table->buildTableWithValue($nama_izin, $row_value, TRUE);
                    ?>
                </form>
                <div id='button-lampiran'></div>
            </div>
            <div id="lower-button-container" class="form-button" style="display: block; text-align: center;"></div>
        </div>
    </div>
    <div id="message-container" class='message-container'></div>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#content-header").fadeIn("slow");
            $("#content-main").fadeIn(3000);
            $("#navbar").fadeIn(3000);
            $("#message-container").fadeIn(4000);
            $("footer").fadeIn(4000);
            showUpdateButton();
            if (document.getElementById('idKabAsal')) {
                showLampiranButton(<?php echo "'{$nama_izin}','{$js_nama_izin_panjang}'";?>, document.getElementById('idKabAsal').value);
            } else {
                showLampiranButton(<?php echo "'{$nama_izin}','{$js_nama_izin_panjang}'";?>);
            }
            $(function () {
                $('.tlt').textillate();
            })
        });
    </script>
</body>
<?php require_once "footer.php"; ?>
</html>