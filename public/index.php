<?php
// ** Created by Bill Radja Pono on 07/23/2016

include "../includes/includes.php";
?>

<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/custom.css">
    <script type="text/javascript" src="./js/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="./js/ajax.js"></script>
    <script type="text/javascript" src="./js/bootstrap.js"></script>
    <title>Sistem Informasi Pelayanan Perizinan Terpadu Provinsi NTT</title>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="background-color: #AAAAAA; color: whitesmoke;" onclick="showHome()">SIPPT NTT</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                    <li class="active">
                        <a id="register" name="register" onclick="showRegister()">Register<span class="sr-only">(current)</span></a>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Entry Data Izin <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php
                            createMenuEntryIzin();
                            ?>
                        </ul>
                    </li>

                    <!--<li><a href="#">Logout</a></li>-->
                </ul>
                <form class="navbar-form navbar-right">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nomor Registrasi...">
                    </div>
                    <button type="submit" class="btn btn-default">Cari</button>
                </form>

            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <!--<div class="container-fluid col-lg-8 col-md-8 col-sm-10 col-xs-12">-->
    <div id="content-title" class="container-fluid">
        <h3>Sistem Informasi Pelayanan Perizinan Terpadu Satu Pintu Provinsi NTT</h3>
    </div>
    <div id="button-container" class="container-fluid form-button">
        <!--<button type="button" class="btn btn-success btn-space" method="POST" value="insert-form" onclick="formSubmit(this.value)">Submit</button>-->
        <!--<button type="reset" class="btn btn-danger btn-space" method="POST" value="insert-form" onclick="formReset(this.value)">Cancel</button>-->
    </div>
    <div id="message_container" style="color: red"></div>
    <div id="content-main">
    </div>
    <?php
//        $table->createInsertSql();
//        echo $table->getInsertSql();
//        echo "<p>";
//        $table->createUpdateSql();
//        echo $table->getUpdateSql();
//        echo "<p>";
//        $table->createDeleteSql();
//        echo $table->getDeleteSql();
    ?>
</body>

</html>