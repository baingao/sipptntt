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

$id_user = $_GET['UPDATE_KEY'];
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
                echo "<div class='form-group'>";
                echo "<label>Nama user</label>";
                echo "<input id='idUser' name='idUser' class='form-control' type='hidden' value='{$row_value['idUser']}'>";
                echo "<input id='username' name='username' class='form-control' type='text' placeholder='Nama user' value='{$row_value['username']}'>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label>Role</label>";
                echo "<select id='role' name='role' class='form-control'>";
                echo "<option value={$row_value['role']}>" . User::roleAsString($row_value['role']) . "</option>";
                echo "<option value=0>-------------------------------</option>";
                echo "<option value=0>GUEST</option>";
                echo "<option value=1>FRONTDESK</option>";
                echo "<option value=2>ANALISA</option>";
                echo "<option value=3>DATA</option>";
                echo "<option value=4>SUPERVISOR</option>";
                echo "<option value=5>ADMIN</option>";
                echo "</select>";
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
            showUserUpdateButton();
        });
    </script>
</body>
<?php require_once "footer.php"; ?>
</html>