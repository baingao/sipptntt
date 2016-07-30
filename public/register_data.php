<?php
// ** Created by Bill Radja Pono on 07/23/2016
//session_destroy();
session_start();

if ($_POST) {
    if (isset($_POST["button_edit"])) {
        $_SESSION["UPDATE_KEY"] = $_POST["button_edit"];
        header('location: register_edit.php');
    } elseif (isset($_POST["button_delete"])) {
        $_SESSION["DELETE_KEY"] = $_POST["button_delete"];
        $_SESSION["DELETE_TABLE_NAME"] = "register";
        $_SESSION["DELETE_RETURN_TO"] = "register_data.php";
        header('location: submit_delete.php');
    }
} else {
    require_once "header.php";
}
?>
<!DOCTYPE html>
<head>
    <title>Register Data</title>
</head>
<body>
    <div class="container-fluid header">
        <div id="content-title">
            <h3>Register : Data</h3>
        </div>
        <div id="button-container" class="form-button"></div>
    </div>
    <div id="message-container"></div>
    <div id="content-main" class="content-center">
        <div class="container-fluid">
            <?php
            //            $table = new TableData;
            Table::tableFromSql("SELECT AI as 'No. Reg', TglDaftar as 'Tanggal Daftar', "
                    . "NamaPemohon as 'Nama Pemohon', AlamatPemohon as 'Alamat Pemohon', "
                    . "(SELECT NamaIzin FROM jenisizin WHERE jenisizin.AI=register.idJenisIzin) as 'Nama Izin', "
                    . "Pengurusan, User FROM register "
                    . "WHERE Tag>=0 ORDER BY AI DESC", 'register', 10, 'No. Reg', [], false, true, true, true);
            ?>
        </div>
    </div>
    <div id="message-container"></div>
    <script type="text/javascript">
        $(document).ready(function () {
            // showSubmitButton();
        });
    </script>
</body>
</html>