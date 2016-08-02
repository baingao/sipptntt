<?php
// ** Created by Bill Radja Pono on 07/31/2016
session_start();
require_once "header.php";

//$param = $_GET['q'];
$param = $_SESSION["UPDATE_KEY"];
$table = new Table();
$table->setKecuali(array("NoReg", "Tag"));
$table->buildTable($_SESSION["NAMA_IZIN"], FALSE);
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
    <title><?php echo strtoupper($_SESSION["NAMA_IZIN"]) ?> Edit</title>
</head>
<body>
    <div id="content-header" class="container-fluid header" style="display: none;">
        <div id="content-title">
            <h3 class="tlt" data-in-effect="rotateInDownRight" data-out-effect="hinge"><?php echo strtoupper($_SESSION["NAMA_IZIN"]) ?> : Edit</h3>
        </div>
        <div id="button-container" class="form-button"></div>
    </div>
    <div id="message-container"></div>
    <div id="content-main" class="content-center" style="display: none;">
        <div class="container-fluid">
            <div class="columns-2">
                <form id="insert-form" role="form">    
                    <?php
                    $table->buildTableWithValue($_SESSION["NAMA_IZIN"], $row_value, TRUE);
                    ?>
                </form>
            </div>
        </div>
    </div>
    <div id="message-container" style="display: none;"></div>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#content-header").fadeIn("slow");
            $("#content-main").fadeIn(3000);
            $("#navbar").fadeIn(3000);
            $("#message-container").fadeIn(4000);
            $("footer").fadeIn(4000);
            showUpdateButton();
            $(function () {
                $('.tlt').textillate();
            })
        });
    </script>
</body>
<?php require_once "footer.php"; ?>
</html>

