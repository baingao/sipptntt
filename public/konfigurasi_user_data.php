<?php
// ** Created by Bill Radja Pono on 07/31/2016
// ** path to be here :
// ** header.php -> function_nav.php (createMenuEntryIzin())

session_start();
require_once "includes.php";
if (isset($_SESSION['ID_USER'])) {
    User::isLoggedIn($_SESSION['ID_USER'], $_SESSION['API_KEY'], $_SESSION['LOGIN_TIME']);
} else {
    header('location: index.php');
}

if ($_POST) {
    if (isset($_POST["button_edit"])) {
        $update_key = $_POST["button_edit"];
        header("location: konfigurasi_user_edit.php?UPDATE_KEY={$update_key}");
    } elseif (isset($_POST["button_tambah"])) {
        header("location: konfigurasi_user_baru.php");
    } 
//    elseif (isset($_POST["button_delete"])) {
//        $_SESSION["DELETE_KEY"] = $_POST["button_delete"];
//        $_SESSION["DELETE_TABLE_NAME"] = "user";
//        $_SESSION["DELETE_RETURN_TO"] = "konfigurasi_user_data.php";
//        header("location: submit_delete.php");
//    }
}
require_once "header.php";

$db_select = new DbConnect();
$stmt_insert = $db_select->connect()->query("SELECT idUser, username, password, role FROM user WHERE tag>=0 ORDER BY username");
$users = $stmt_insert->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<head>
    <title>Konfigurasi User : Data</title>
</head>
<body>
    <div id="content-header" class="container-fluid header" style="display: none;">
        <div id="content-title">
            <h3 class="tlt" data-in-effect="bounceInRight">Konfigurasi User : Data</h3>
        </div>
        <div id="button-container" class="form-button">
            <form method="post">
                <button type="submit" name="button_tambah" id="button_tambah" class="btn btn-success btn-space" method="POST"><span><i class="glyphicon glyphicon-plus"></i> Tambah</span></button>
            </form>
        </div>
    </div>
    <div id="message-container" style="display: none;"></div>
    <div id="content-main" class="content-center col-lg-6 col-lg-push-3 col-md-6 col-md-push-3 col-sm-6 col-sm-push-3 col-xs-12" style="display: none;">
        <div class="table-responsive">
            <form id="form-tabel" method="post">
                <table class="table table-hover">
                    <tr> 
                    <th width="50">Edit</th>
                    <th width="50">Hapus</th>
                    <th width="60">ID User</th>
                    <th>Nama User</th>
                    <th>Role</th>
                    </tr>
                    <?php
                    if ($users != null) {
                        foreach ($users as $user) {
                            $role = User::roleAsString($user['role']);
                            echo "<tr>";
                            echo "<td width='40'><button name='button_edit' id='button_edit' class='btn btn-warning' value={$user['idUser']}><i class='glyphicon glyphicon-pencil'></i></button></td>";
                            echo "<td width='40'><button name='button_delete' id='button_delete' class='btn btn-danger' value={$user['idUser']} onclick='userConfirmDelete(this.value)'><i class='glyphicon glyphicon-trash'></i></button></td>";
                            echo "<td>{$user['idUser']}</td>";
                            echo "<td>{$user['username']}</td>";
                            echo "<td>{$role}</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </table>
            </form>
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
        });
    </script>
</body>
<?php require_once "footer.php"; ?>
</html>