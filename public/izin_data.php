<?php
// ** Created by Bill Radja Pono on 07/31/2016

session_start();
//$nama_izin = $_SESSION["JENIS_IZIN"];
$nama_izin = $_GET["q"];

if ($_POST) {
    if (isset($_POST["button_edit"])) {
        $_SESSION["UPDATE_KEY"] = $_POST["button_edit"];
        $_SESSION["NAMA_IZIN"] = $nama_izin;
        header("location: izin_edit.php");
        // header("location: " . $nama_izin . "_edit.php");
    }
    
    elseif (isset($_POST["button_delete"])) {
        $_SESSION["DELETE_KEY"] = $_POST["button_delete"];
        $_SESSION["DELETE_TABLE_NAME"] = $nama_izin;
        $_SESSION["DELETE_RETURN_TO"] = $nama_izin . "_data.php";
        header("location: submit_delete.php");
    }
} 
require_once "header.php";

?>
<!DOCTYPE html>
<head>
    <title><?php echo strtoupper($nama_izin) ?></title>
</head>
<body>
    <div class="container-fluid header">
        <div id="content-title">
            <h3><?php echo strtoupper($nama_izin) ?> : Data</h3>
        </div>
        <div id="button-container" class="form-button"></div>
    </div>
    <div id="message-container"></div>
    <div id="content-main" class="content-center">
        <div class="container-fluid">
                    <?php
                    Table::tableFromSql("SELECT AI, NoReg as 'No. Reg', Nomor as 'Nomor Izin', Tgl as 'Tanggal Terbit',"
                            . " Nama as 'Nama Pemohon', Alamat as 'Alamat Pemohon'"
                            . " FROM " . $nama_izin
                            . " WHERE Tag>=0 ORDER BY AI DESC", $nama_izin, 10, 'AI', [], false, false, true, true);
                    ?>
        </div>
    </div>
    <div id="message-container"></div>
</body>
</html>