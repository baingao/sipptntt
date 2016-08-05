<?php
/*
 * Licensed to Bill Radja Pono <baingao@gmail.com>
 * Unauthorized use is prohibited
 */
//session_start();
//echo $_GET["NAMA_IZIN"];
//echo "<br/>";
//echo $_GET["NO_IZIN"];
// ** Created by Bill Radja Pono on 07/31/2016

session_start();
require_once "includes.php";
if (isset($_SESSION['ID_USER'])) {
    User::isLoggedIn($_SESSION['ID_USER'], $_SESSION['API_KEY'], $_SESSION['LOGIN_TIME']);
} else {
    header('location: index.php');
}

$nama_izin_lampiran = $_GET["NAMA_IZIN_LAMPIRAN"];
$no_izin = $_GET["NO_IZIN"];
$nama_izin_parent = $_GET["NAMA_IZIN"];
$js_nama_izin_panjang = $_GET["NAMA_IZIN_PANJANG"];
$nama_izin_panjang = str_replace("-", " ", $_GET["NAMA_IZIN_PANJANG"]);
$param_id = $_GET["PARAM_ID"];
//$_SESSION["NO_IZIN_LAMPIRAN"] = $no_izin;

switch ($nama_izin_lampiran) {
    case "ipptlamp": $sql_select = "SELECT ipptlamp.AI, ipptlamp.NoIPPT AS 'No. Reg',"
                                    . " ipptquota.Ternak AS 'Nama Ternak',"
                                    . " ipptlamp.Jumlah, ipptlamp.Kelamin, ipptlamp.Ket AS 'Keterangan'"
                                    . " FROM ipptlamp LEFT JOIN ipptquota "
                                    . " ON ipptquota.AI=ipptlamp.idTernak "
                                    . " WHERE ipptlamp.NoIPPT = {$no_izin}"
                                    . " AND ipptlamp.Tag>=0 ORDER BY ipptlamp.AI DESC";
        break;
}


if ($_POST) {
    if (isset($_POST["button_edit"])) {
        $update_key_lampiran = $_POST["button_edit"];
        header("location: izin_lampiran_edit.php?NAMA_IZIN_LAMPIRAN={$nama_izin_lampiran}&UPDATE_KEY_LAMPIRAN={$update_key_lampiran}&NAMA_IZIN={$nama_izin_parent}&NAMA_IZIN_PANJANG={$js_nama_izin_panjang}&PARAM_ID={$param_id}");
    } elseif (isset($_POST["button_tambah"])) {
        require_once 'includes.php';
        $db = new DbConnect();
        $stmt = $db->connect()->prepare("INSERT INTO {$nama_izin_lampiran} (No" . strtoupper($nama_izin_parent) . ") VALUES ({$no_izin})");
        $stmt->execute();
        $update_key_lampiran = $db->getLastInsertId();
        header("location: izin_lampiran_edit.php?NAMA_IZIN_LAMPIRAN={$nama_izin_lampiran}&UPDATE_KEY_LAMPIRAN={$update_key_lampiran}&NAMA_IZIN={$nama_izin_parent}&NAMA_IZIN_PANJANG={$js_nama_izin_panjang}&PARAM_ID={$param_id}");
        // header("location: izin_lampiran_edit.php?NAMA_IZIN_LAMPIRAN={$nama_izin_lampiran}&UPDATE_KEY_LAMPIRAN={$update_key_lampiran}&NAMA_IZIN={$nama_izin_parent}&NAMA_IZIN_PANJANG={$js_nama_izin_panjang}");
    } elseif (isset($_POST["button_delete"])) {
        $_SESSION["DELETE_KEY"] = $_POST["button_delete"];
        $_SESSION["DELETE_TABLE_NAME"] = $nama_izin_lampiran;
        $_SESSION["DELETE_RETURN_TO"] = "izin_lampiran_data.php";
        header("location: submit_delete.php");
    } elseif (isset($_POST["button_print_izin"])) {
        $_SESSION["PRINT_KEY"] = $_POST["button_print_izin"];
        header('location: izin_lampiran_print.php');
    }
}
require_once "header.php";
?>
<!DOCTYPE html>
<head>
    <title><?php echo $nama_izin_panjang ?></title>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#content-header").fadeIn("slow");
            $("#content-main").fadeIn(3000);
            $("#navbar").fadeIn(3000);
            $("#message-container").fadeIn(4000);
            $("footer").fadeIn(4000);
//            showUpdateLampiranButton();
            $(function () {
                $('.tlt').textillate();
            })
            document.getElementById("pagination-upper").innerHTML = "";
            document.getElementById("pagination-lower").innerHTML = "";
        });
    </script>
</head>
<body>
    <div id="content-header" class="container-fluid header" style="display: none;">
        <div id="content-title">
            <h3 class="tlt" data-in-effect="flipInX"><?php echo $nama_izin_panjang ?> : Lampiran</h3>
        </div>
        <div id="button-container" class="form-button">
            <form class="form-inline" method="post">
                <button type="submit" name="button_tambah" id="button_tambah" class="btn btn-success btn-space" method="POST"><span><i class="glyphicon glyphicon-plus"></i> Tambah</span></button>
            </form>
        </div>
    </div>
    <div id="message-container" style="display: none;"></div>
    <div id="content-main" class="content-center" style="display: none;">
        <?php
            Table::tableFromSql($sql_select, $nama_izin_lampiran, 10, 'AI', [], false, false, false, false, true, true);
//        $spec = "";
//        if (strcmp(strtolower($nama_izin_lampiran), 'ippt')) {
//            $spec = "(SELECT Ternak FROM ipptquota WHERE ipptquota.AI=ipptlamp.idTernak)"
//                    . " AS 'Nama Ternak',";
//        }
//        Table::tableFromSql("SELECT AI, NoIPPT as 'No. Reg',"
//                . " {$spec}"
//                . " Jumlah, Kelamin, Ket AS 'Keterangan'"
//                . " FROM " . $nama_izin_lampiran
//                . " WHERE No{$nama_izin_parent}={$no_izin} AND Tag>=0 ORDER BY AI DESC", $nama_izin_lampiran, 10, 'AI', [], false, false, false, false, true, true);
        ?>
    </div>
    <div id="message-container" class='message-container'></div>
</body>
<?php require_once "footer.php"; ?>
</html>

