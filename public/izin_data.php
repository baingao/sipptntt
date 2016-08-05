<?php
// ** Created by Bill Radja Pono on 07/31/2016
// ** path to be here :
// ** header.php -> function_nav.php (createMenuEntryIzin())

session_start();
require_once "includes.php";
if (isset($_SESSION['ID_USER'])) {
    User::isLoggedIn($_SESSION['ID_USER'], $_SESSION['API_KEY'], $_SESSION['LOGIN_TIME']);
} else {
    header('location: index.php');
}

$nama_izin = $_GET["NAMA_IZIN"];
$js_nama_izin_panjang = $_GET["NAMA_IZIN_PANJANG"];
$nama_izin_panjang = str_replace("-", " ", $js_nama_izin_panjang);

if ($_POST) {
    if (isset($_POST["button_edit"])) {
//        $_SESSION["UPDATE_KEY"] = $_POST["button_edit"];
//        $_SESSION["NAMA_IZIN"] = $nama_izin;
//        $_SESSION["NAMA_IZIN_PANJANG"] = $nama_izin_panjang;
        $update_key = $_POST["button_edit"]; 
        header("location: izin_edit.php?NAMA_IZIN={$nama_izin}&NAMA_IZIN_PANJANG={$js_nama_izin_panjang}&UPDATE_KEY={$update_key}");
    }
    
    elseif (isset($_POST["button_delete"])) {
        $_SESSION["DELETE_KEY"] = $_POST["button_delete"];
        $_SESSION["DELETE_TABLE_NAME"] = $nama_izin;
        $_SESSION["DELETE_RETURN_TO"] = "izin_data.php=?NAMA_IZIN={$nama_izin}&NAMA_IZIN_PANJANG={$js_nama_izin_panjang}";
        header("location: submit_delete.php");
    }
    
    elseif (isset($_POST["button_print_izin"])) {
        $_SESSION["PRINT_KEY"] = $_POST["button_print_izin"];
        header('location: izin_print.php');
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
            $(function () {
                $('.tlt').textillate();
            })
        });
    </script>
</head>
<body>
    <div id="content-header" class="container-fluid header" style="display: none;">
        <div id="content-title">
            <h3 class="tlt" data-in-effect="bounceInRight"><?php echo $nama_izin_panjang ?> : Data</h3>
        </div>
        <div id="button-container" class="form-button"></div>
    </div>
    <div id="message-container" style="display: none;"></div>
    <div id="content-main" class="content-center" style="display: none;">
        <!--<div class="container-fluid">-->
                    <?php
                    Table::viewFromSql("SELECT AI, NoReg as 'No. Reg', Nomor as 'Nomor Izin', Tgl as 'Tanggal Terbit',"
                            . " Nama as 'Nama Pemohon', Alamat as 'Alamat Pemohon'"
                            . " FROM " . $nama_izin
                            . " WHERE Tag>=0 ORDER BY AI DESC", $nama_izin, 10, 'AI', [], false, false, false, true, true, true);
                    ?>
        <!--</div>-->
    </div>
    <div id="message-container" class='message-container'></div>
</body>
<?php require_once "footer.php"; ?>
</html>