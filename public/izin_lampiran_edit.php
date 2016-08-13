<?php
// ** Created by Bill Radja Pono on 07/31/2016
session_start();
require_once "includes.php";
if (isset($_SESSION['ID_USER'])) {
    User::isLoggedIn($_SESSION['ID_USER'], $_SESSION['API_KEY'], $_SESSION['LOGIN_TIME']);
} else {
    header('location: index.php');
}
require_once "header.php";

$nama_izin_lampiran = $_GET["NAMA_IZIN_LAMPIRAN"];
$param = $_GET["UPDATE_KEY_LAMPIRAN"];
$nama_izin_parent = strtoupper($_GET["NAMA_IZIN"]);
$js_nama_izin_panjang = $_GET["NAMA_IZIN_PANJANG"];
$nama_izin_panjang = str_replace("-", " ", $_GET["NAMA_IZIN_PANJANG"]);
$param_id = $_GET["PARAM_ID"];

$table = new Table();
$table->setKecuali(array("No{$nama_izin_parent}", "Tag"));
$table->buildTable($nama_izin_lampiran, FALSE);
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
                    $table->buildTableWithValue($nama_izin_lampiran, $row_value, TRUE);
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
            showCustomTernakSelect(<?php echo $param_id;?>); // hanya untuk ipptlamp, tidak perlu if karena idTernak hanya ada di ipptlamp
            $(function () {
                $('.tlt').textillate();
            })
        });
    </script>
</body>
<?php require_once "footer.php"; ?>
</html>

