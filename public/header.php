<?php
// ** Created by Bill Radja Pono on 07/29/2016
require_once "includes.php";
if ($_POST) {
    if ($_POST["input_cari_param"]!="") {
        if ($_POST["cari_select"]=="AI") {
            $_SESSION["PARAM_CARI_REGISTER"] = $_POST["cari_select"] . "=". $_POST["input_cari_param"];
           
        } else {
            $_SESSION["PARAM_CARI_REGISTER"] = $_POST["cari_select"] . " like ". "'" . $_POST["input_cari_param"]."'";
        }
    }
    header("location: register_data.php");
}
?>

<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,800,100' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/custom.css">
    <script type="text/javascript" src="./js/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="./js/bootstrap.js"></script>
    <script type="text/javascript" src="./js/ajax_kec_kel_select_handler.js"></script>
    <script type="text/javascript" src="./js/ajax_page_handler.js"></script>
    <script type="text/javascript" src="./js/ajax_form_handler.js"></script>
    <title>Sistem Informasi Pelayanan Perizinan Terpadu Provinsi NTT</title>
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="background-color: #AAAAAA; color: whitesmoke;" href="index.php">SIPPT NTT</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Register <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a id="daftar_register" name="daftar_register" role="button" aria-haspopup="true" aria-expanded="false" href="register_baru.php">Daftar Baru<span class="sr-only">(current)</span></a></li>
                            <li><a id="data_register" name="data_register" role="button" aria-haspopup="true" aria-expanded="false" href="register_data.php">Data Register<span class="sr-only"></span></a></li>
                        </ul>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Data Izin <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php
                            createMenuEntryIzin();
                            ?>
                        </ul>
                    </li>
                </ul>
                <form class="navbar-form navbar-right" method="post">
                    <div class="form-group">
                        <select class="form-control" id="cari_select" name="cari_select">
                            <option value="AI">No. Reg</option>;
                            <option value="NamaPemohon">Nama Pemohon</option>;
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="input_cari_param" placeholder="Cari...">
                    </div>
                    <button type="submit" class="btn btn-default" id="button_cari_register" name="button_cari_register">Cari</button>
                </form>
            </div>
        </div>
    </nav>
</body>
</html>