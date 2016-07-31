<?php
// ** Created by Bill Radja Pono on 07/23/2016
session_start();
require_once "header.php";

if ($_POST) {
    echo "POSTED";
    header('Location: register.php');
}
?>

<!DOCTYPE html>
<head>
    <title>Register Baru</title>
</head>
<body>
    <div class="container-fluid header">
        <div id="content-title">
            <h3>Register : Daftar Baru</h3>
        </div>
        <div id="button-container" class="form-button"></div>
    </div>
    <div id="message-container"></div>
    <div id="content-main" class="content-center">
        <div class="container-fluid">
            <div class="columns-2">
                <form id="insert-form" role="form">    
                    <?php
                    $table = new Table();
                    $table->setKecuali(
                            array(
                                "AI",
                                "NoReg",
                                "Tag",
                                "JK",
                                "TglTerbit",
                                "TglDaftar",
                                "TglCek",
                                "TglKadaluarsa",
                                "TglDaftarUlang",
                                "TglKadaluarsa",
                                "JumlahDaftarUlang",
                                "TglUpdate",
                                "TglSelesai",
                                "Proses",
                                "User",
                                "TagSms"));
                    $table->buildTable("register", TRUE);
//                $table->createInsertSql();
                    $_SESSION["INSERT_SQL"] = $table->getInsertSql();
                    ?>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            showSubmitButton();
        });
    </script>
</body>

</html>