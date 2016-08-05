<?php
// ** Created by Bill Radja Pono on 07/23/2016
//session_destroy();
session_start();
require_once 'includes.php';

if (isset($_SESSION['ID_USER'])) {
    User::isLoggedIn($_SESSION['ID_USER'], $_SESSION['API_KEY'], $_SESSION['LOGIN_TIME']);
} else {
    header('location: index.php');
}

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
        header("location: register_edit.php?UPDATE_KEY={$_POST["button_edit"]}");
//    } elseif (isset($_POST["button_print_register"])) {
//        header("location: register_print.php?PRINT_KEY={$_POST["button_print_register"]}");
//    } elseif (isset($_POST["button_print_izin"])) {
//        $print_key = $_POST["button_print_izin"];
//        header("location: izin_print.php?PRINT_KEY={$print_key}");
//    }
//    elseif (isset($_POST["button_delete"])) {
//        $_SESSION["DELETE_KEY"] = $_POST["button_delete"];
//        $_SESSION["DELETE_TABLE_NAME"] = "register";
//        $_SESSION["DELETE_RETURN_TO"] = "register_data.php";
//        header('location: submit_delete.php');
    } elseif (isset($_POST["button_terbit"])) {
        require_once 'includes.php';
        $terbit_key = $_POST["button_terbit"];
        $db = new DbConnect();
        $stmt = $db->connect()->query("SELECT register.AI, register.NamaPemohon, register.AlamatPemohon,"
                . " register.TelpPemohon, register.idKab, register.idKec, register.idKel,"
                . " register.idJenisIzin, jenisizin.JenisIzin, jenisizin.NamaIzin"
                . " FROM register left join jenisizin on jenisizin.AI=register.idJenisIzin"
                . " WHERE register.AI={$terbit_key}");
        $select_result = $stmt->fetch(PDO::FETCH_ASSOC);
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

            <button type="submit" class="btn btn-default form-cari-control" id="button_cari_register" name="button_cari_register" onclick="tampilkanHasilPencarian()">Cari</button>

        </form>
    </div>
    <div id="content-main" class="content-center" style="display: none;">
        <!--<div class="container-fluid">-->
            <?php

            function tampilkanRegister($param) {
                $the_sql = "SELECT AI as 'No. Reg', TglDaftar as 'Tanggal Daftar', "
                        . "NamaPemohon as 'Nama Pemohon', AlamatPemohon as 'Alamat Pemohon', "
                        . "(SELECT NamaIzin FROM jenisizin WHERE jenisizin.AI=register.idJenisIzin) as 'Nama Izin', "
                        . "Pengurusan, User FROM register "
                        . "WHERE {$param} Tag>=0 ORDER BY AI DESC";
                switch ($_SESSION['ROLE']) {
                    case 0 : Table::tableFromSql($the_sql, 'register', 10, 'No. Reg', [], false, false, false, false, false, false);
                        break;
                    
                    case 1 : Table::tableFromSql($the_sql, 'register', 10, 'No. Reg', [], false, false, true, false, true, false);
                        break;
                    
                    case 2 : Table::tableFromSql($the_sql, 'register', 10, 'No. Reg', [], false, true, false, false, false, false);
                        break;
                    
                    case 3 : Table::tableFromSql($the_sql, 'register', 10, 'No. Reg', [], false, true, false, true, false, false);
                        break;
                    
                    case 4 : Table::tableFromSql($the_sql, 'register', 10, 'No. Reg', [], false, true, true, true, true, false);
                        break;
                    
                    case 5 : Table::tableFromSql($the_sql, 'register', 10, 'No. Reg', [], false, true, true, true, true, true);
                        break;
                    
                    case 6 : Table::tableFromSql($the_sql, 'register', 10, 'No. Reg', [], false, true, true, true, true, true);
                        break;
                }
//                Table::tableFromSql($the_sql, 'register', 10, 'No. Reg', [], false, true, true, true, true, true, false);
            }

            //echo $param_cari_register;
            try {
                tampilkanRegister($param_cari_register);
            } catch (Exception $error) {
                echo "Data tidak ditemukan.";
            }
            ?>
        <!--</div>-->
    </div>
    <div id="message-container" class='message-container'></div>
    <div id='div_session_write'> </div>
    <script type="text/javascript">
        function tampilkanHasilPencarian() {
            var hasil_pencarian = document.getElementById('hasil-pencarian');
            var form_tabel = document.getElementById('form-tabel');
            hasil_pencarian.innerHTML = '';
            form_tabel.submit();
        }
        
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