<?php
// ** Created by Bill Radja Pono on 07/23/2016
//session_destroy();
session_start();

$param_cari_register = "";
if (isset($_SESSION["PARAM_CARI_REGISTER"])) {
    $param_cari_register = $_SESSION["PARAM_CARI_REGISTER"] . " AND";
    $_SESSION["PARAM_CARI_REGISTER"] = null;
}

if ($_POST) {
    if (isset($_POST["button_cari_register"])) {
        if ($_POST["input_cari_param"] != "") {
            if ($_POST["cari_select"] == "AI") {
                $_SESSION["PARAM_CARI_REGISTER"] = $_POST["cari_select"] . "=" . $_POST["input_cari_param"];
            } else {
                $_SESSION["PARAM_CARI_REGISTER"] = $_POST["cari_select"] . " like " . "'" . $_POST["input_cari_param"] . "'";
            }
        }
        header("location: register_data.php");
    } elseif (isset($_POST["button_edit"])) {
        $_SESSION["UPDATE_KEY"] = $_POST["button_edit"];
        header('location: register_edit.php');
    } elseif (isset($_POST["button_print_register"])) {
        $_SESSION["PRINT_KEY"] = $_POST["button_print_register"];
        header('location: register_print.php');
    } elseif (isset($_POST["button_print_izin"])) {
        $_SESSION["PRINT_KEY"] = $_POST["button_print_izin"];
        header('location: izin_print.php');
//    } elseif (isset($_POST["button_delete"])) {
//        $_SESSION["DELETE_KEY"] = $_POST["button_delete"];
//        $_SESSION["DELETE_TABLE_NAME"] = "register";
//        $_SESSION["DELETE_RETURN_TO"] = "register_data.php";
//        header('location: submit_delete.php');
    } elseif (isset($_POST["button_terbit"])) {
        $terbit_key = $_POST["button_terbit"];
        require_once 'includes.php';
        $db = new DbConnect();
        $stmt = $db->connect()->query("SELECT register.AI, register.NamaPemohon, register.AlamatPemohon,"
                . " register.TelpPemohon, register.idKab, register.idKec, register.idKel,"
                . " register.idJenisIzin, jenisizin.JenisIzin"
                . " FROM register left join jenisizin on jenisizin.AI=register.idJenisIzin"
                . " WHERE register.AI={$terbit_key}");
        $select_result = $stmt->fetch(PDO::FETCH_ASSOC);
//        foreach ($select_result as $key => $value) {
//            $row_value["$key"] = $value;
//        }
//        $_SESSION["REGISTER_DATA"] = $row_value;
        $_SESSION["REGISTER_DATA"] = $select_result;
        header('location: register_terbit.php');
    }
} else {
//    
}

require_once "header.php";
?>
<!DOCTYPE html>
<head>
    <title>Register Data</title>
</head>
<body>
    <div id="content-header" class="container-fluid header" style="display: none;">
        <div id="content-title">
            <h3 class="tlt" data-in-effect="bounceInDown">Register : Data</h3>
        </div>
        <div id="button-container" class="form-button"></div>
    </div>
    <div id="message-container" style="display: none;">
        <form class="form-inline form-cari" method="post">
            <select class="form-control form-cari-control" id="cari_select" name="cari_select">
                <option value="AI">No. Reg</option>;
                <option value="NamaPemohon">Nama Pemohon</option>;
            </select>

            <input type="text" class="form-control form-cari-control" name="input_cari_param" size="50" placeholder="Cari...">

            <button type="submit" class="btn btn-default form-cari-control" id="button_cari_register" name="button_cari_register">Cari</button>

        </form>
    </div>
    <div id="content-main" class="content-center" style="display: none;">
        <div class="container-fluid">
            <?php

            function tampilkanRegister($param) {
                Table::tableFromSql("SELECT AI as 'No. Reg', TglDaftar as 'Tanggal Daftar', "
                        . "NamaPemohon as 'Nama Pemohon', AlamatPemohon as 'Alamat Pemohon', "
//                        . "(SELECT JenisIzin FROM jenisizin WHERE jenisizin.AI=register.idJenisIzin) as 'Kode', "
                        . "(SELECT NamaIzin FROM jenisizin WHERE jenisizin.AI=register.idJenisIzin) as 'Nama Izin', "
                        . "Pengurusan, User FROM register "
                        . "WHERE {$param} Tag>=0 ORDER BY AI DESC", 'register', 10, 'No. Reg', [], false, true, true, true, true, true);
            }

            //echo $param_cari_register;
            try {
                tampilkanRegister($param_cari_register);
            } catch (Exception $error) {
                echo "Data tidak ditemukan.";
            }
            ?>
        </div>
    </div>
    <div id="message-container"></div>
    <div id='div_session_write'> </div>
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
</body>
<?php require_once "footer.php"; ?>
</html>