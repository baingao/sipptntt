<?php
// ** Created by Bill Radja Pono on 07/23/2016
session_start();
require_once "header.php";
define("NAMA_IZIN", "ippt");
?>

<!DOCTYPE html>
<head>

    <title><?php echo strtoupper(NAMA_IZIN) ?> Baru</title>
</head>
<body>
    <div class="container-fluid header">
        <div id="content-title">
            <h3><?php echo strtoupper(NAMA_IZIN) ?> : Daftar Baru</h3>
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
                                "Tag"));
                    $table->buildTable(NAMA_IZIN, TRUE);
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