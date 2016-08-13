<?php
// ** Created by Bill Radja Pono on 07/23/2016

session_start();
define("NAMA_IZIN", "sip");

if ($_POST) {
    if (isset($_POST["button_edit"])) {
        $_SESSION["UPDATE_KEY"] = $_POST["button_edit"];
        header("location: " . NAMA_IZIN . "_edit.php");
    }
    
    elseif (isset($_POST["button_delete"])) {
        $_SESSION["DELETE_KEY"] = $_POST["button_delete"];
        $_SESSION["DELETE_TABLE_NAME"] = NAMA_IZIN;
        $_SESSION["DELETE_RETURN_TO"] = NAMA_IZIN . "_data.php";
        header("location: submit_delete.php");
    }
} else {
    require_once "header.php";
}
?>
<!DOCTYPE html>
<head>
    <title><?php echo strtoupper(NAMA_IZIN) ?></title>
</head>
<body>
    <div class="container-fluid header">
        <div id="content-title">
            <h3><?php echo strtoupper(NAMA_IZIN) ?> : Data</h3>
        </div>
        <div id="button-container" class="form-button"></div>
    </div>
    <div id="message-container"></div>
    <div id="content-main" class="content-center">
        <div class="container-fluid">
                    <?php
                    Table::tableFromSql("SELECT AI, NoReg as 'No. Reg', Nomor as 'Nomor Izin', Tgl as 'Tanggal Terbit',"
                            . " Nama as 'Nama Pemohon', Lokasi"
                            . " FROM " . NAMA_IZIN
                            . " WHERE Tag>=0 ORDER BY AI DESC", NAMA_IZIN, 10, 'AI', [], false, false, true, true);
                    ?>
        </div>
    </div>
    <div id="message-container"></div>
</body>
</html><?php

/* 
 * Licensed to Bill Radja Pono <baingao@gmail.com>
 * Unauthorized use is prohibited
 */

