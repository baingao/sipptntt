<?php
// ** Created by Bill Radja Pono on 07/23/2016
session_start();
require_once "includes.php";
if (isset($_SESSION['ID_USER'])) {
    User::isLoggedIn($_SESSION['ID_USER'], $_SESSION['API_KEY'], $_SESSION['LOGIN_TIME']);
} else {
    header('location: index.php');
}

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
    <div id="content-header" class="container-fluid header" style="display: none;">
        <div id="content-title">
            <h3 class="tlt" data-in-effect="rollIn">Register : Daftar Baru</h3>
        </div>
        <div id="button-container" class="form-button"></div>
    </div>
    <div id="message-container" class='message-container'></div>
    <div id="content-main" class="content-center" style="display: none;">
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
            <div id='lower-button-container' class="form-button" style="display: block; text-align: center;"></div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#content-header").fadeIn("slow");
            $("#content-main").fadeIn(3000);
            $("#navbar").fadeIn(3000);
            $("footer").fadeIn(4000);
            showRegisterBaruSubmitButton();
            $(function () {
                $('.tlt').textillate();
            })
        });
    </script>
</body>
<?php require_once "footer.php"; ?>
</html>