<?php
// ** Created by Bill Radja Pono on 07/29/2016
require_once "includes.php";
?>

<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,800,100' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="./js/textillate/assets/animate.css">
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
    <nav id="navbar" class="navbar navbar-default navbar-fixed-top" style="display: none;">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="background-color: #AAAAAA; color: white; font-size: 120%;" href="index.php"><i class="glyphicon glyphicon-home"></i>&nbsp SIPPT NTT</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-copy"></i> Register <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a id="daftar_register" name="daftar_register" role="button" aria-haspopup="true" aria-expanded="false" href="register_baru.php">Daftar Baru<span class="sr-only">(current)</span></a></li>
                            <li><a id="data_register" name="data_register" role="button" aria-haspopup="true" aria-expanded="false" href="register_data.php">Data Register<span class="sr-only"></span></a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-duplicate"></i> Data Izin <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php
                            createMenuEntryIzin();
                            ?>
                        </ul>
                    </li>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-cog"></i> Konfigurasi <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a id="konfigurasi_umum" name="konfigurasi_umum" role="button" aria-haspopup="true" aria-expanded="false" href="konfigurasi_umum.php">Umum<span class="sr-only"></span></a></li>
                            <li><a id="konfigurasi_umum" name="konfigurasi_user" role="button" aria-haspopup="true" aria-expanded="false" href="konfigurasi_user_data.php">Manajemen User<span class="sr-only"></span></a></li>
                            <li role="separator" class="divider"></li>
                            <li><a id="konfigurasi_daerah" name="konfigurasi_daerah" role="button" aria-haspopup="true" aria-expanded="false" href="konfigurasi_daerah.php">Data Daerah<span class="sr-only"></span></a></li>
                            <li><a id="konfigurasi_kuota_ternak" name="konfigurasi_kuota_ternak" role="button" aria-haspopup="true" aria-expanded="false" href="konfigurasi_kuota_ternak.php">Kuota Ternak<span class="sr-only"></span></a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> User <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a id="user_logout" name="user_logout" role="button" aria-haspopup="true" aria-expanded="false" href="logout.php">Logout<span class="sr-only"></span></a></li>
                        </ul>
                    </li>    
                </ul>
            </div>
        </div>
    </nav>
    <script src="./js/textillate/assets/jquery.fittext.js"></script>
    <script src="./js/textillate/assets/jquery.lettering.js"></script>
    <script src="./js/textillate/jquery.textillate.js"></script>
</body>
</html>