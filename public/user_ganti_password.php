<?php
// ** Created by Bill Radja Pono on 07/23/2016
session_start();
require_once "includes.php";
if (isset($_SESSION['ID_USER'])) {
    User::isLoggedIn($_SESSION['ID_USER'], $_SESSION['API_KEY'], $_SESSION['LOGIN_TIME']);
} else {
    header('location: index.php');
}

define("TABLE_NAME", "user");

$id_user = $_SESSION['ID_USER'];
$sql = ("SELECT idUser, username, password, role FROM user WHERE idUser={$id_user}");
$db = new DbConnect();
$stmt = $db->connect()->query($sql);
$select_result = $stmt->fetch(PDO::FETCH_ASSOC);
foreach ($select_result as $key => $value) {
    $row_value[$key] = $value;
}
$stmt = null;

require_once "header.php";
?>

<!DOCTYPE html>
<head>
    <title>User Edit</title>
</head>
<body>
    <div id="content-header" class="container-fluid header" style="display: none;">
        <div id="content-title">
            <h3 class="tlt" data-in-effect="bounceInDown">User : Edit</h3>
        </div>
        <div id="button-container" class="form-button"></div>
    </div>
    <div id="message-container" style="display: none; text-align: center">
    </div>
    <div id="content-main" class="content-center" style="display: none;">
        <div class="container-fluid">
            <div class="columns-1 col-lg-6 col-lg-push-3 col-md-6 col-md-push-3 col-sm-6 col-sm-push-3 col-xs-12">
                <form id="insert-form" role="form">    
                <?php
                echo "<input id='idUser' name='idUser' class='form-control' type='hidden' value='{$row_value['idUser']}'>";
                echo "<input id='token' name='token' class='form-control' type='hidden' value='{$row_value['password']}'>";
                echo "<div class='form-group'>";
                echo "<label>Password sekarang</label>";
                echo "<input id='password_lama' name='password_lama' class='form-control' type='password' placeholder='Masukkan password sekarang'/>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label>Password baru</label>";
                echo "<input id='password_baru' name='password_baru' class='form-control' type='password' placeholder='Masukkan password baru'/>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label>Konfirmasi password baru</label>";
                echo "<input id='konfirmasi_password' name='konfirmasi_password' class='form-control' type='password' placeholder='Ulangi password baru'/>";
                echo "</div>";
                ?>
                </form>
                <div id='lower-button-container' class="form-button" style="display: block; text-align: center;"></div>
            </div>

        </div>
    </div>
    <div id="message-container" class='message-container'></div>
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
            showUserGantiPasswordUpdateButton();
        });
    </script>
</body>
<?php require_once "footer.php"; ?>
</html>