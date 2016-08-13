<?php
// ** Created by Bill Radja Pono on 07/23/2016
session_start();
require_once "includes.php";
if (isset($_SESSION['ID_USER'])) {
    User::isLoggedIn($_SESSION['ID_USER'], $_SESSION['API_KEY'], $_SESSION['LOGIN_TIME']);
} else {
    header('location: index.php');
}
require_once "header.php";
define("TABLE_NAME", "config");

$param = 1; // *** ingat cek di tabel config -> AI harus =1
$table = new Table();
$table->setKecuali(array("Version", "VersionControl"));
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
    <title>Konfigurasi Umum</title>
</head>
<body>
    <div id="content-header" class="container-fluid header" style="display: none;">
        <div id="content-title">
            <h3 class="tlt" data-in-effect="bounceInDown">Konfigurasi Umum</h3>
        </div>
        <div id="button-container" class="form-button"></div>
    </div>
    <div id="message-container" style="display: none;"></div>
    <div id="content-main" class="content-center" style="display: none;">
        <div class="container-fluid">
            <div class="columns-2">
                <form id="insert-form" role="form">    
                    <?php
                    $table->buildTableWithValue(TABLE_NAME, $row_value, TRUE);
                    ?>
                </form>
            </div>
            <div id='lower-button-container' class="form-button" style="display: block; text-align: center;"></div>
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
            $(function () {
                $('.tlt').textillate();
            })
            showUpdateButton();
        });
    </script>
</body>
<?php require_once "footer.php"; ?>
</html>