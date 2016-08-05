<?php
// ** Created by Bill Radja Pono on 07/29/2016
session_start();
if (isset($_SESSION['ID_USER'])) {
    session_unset();
    session_destroy();
    session_start();
}
require_once "includes.php";

$User = new User();
if (isset($_POST['btn-login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $User->setName($username);
    $User->setPassword($password);

    if ($User->login()) {
        $_SESSION['ID_USER'] = $User->getIdUser();
        $_SESSION['API_KEY'] = $User->getApiKey();
        $_SESSION['LOGIN_TIME'] = $User->getLoginTime();
        $_SESSION['ROLE'] = $User->getRole();
        $User->redirect('register_data.php');
    } else {
        $error = "Kombinasi nama dan password salah !";
    }
}
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
    <div id="content-header" class="container-fluid header" style="display: none; margin-top: -50px">
        <div id="content-title">
            <h3 class="tlt" style="margin-bottom: -10px;" data-in-effect="bounceInLeft">Sistem Informasi Pelayanan Perizinan Terpadu</h3><br>
            <p class="tlt" style="font-size: 150%; margin-top:-10px;" data-in-effect="bounceInDown">Provinsi Nusa Tenggara Timur</p>
        </div>
        <div id="button-container" class="form-button"></div>
    </div>
    <div id="message-container"></div>
    <div id="content-main" class="content-center">
        <div class="container-fluid col-lg-4 col-lg-push-4 col-md-4 col-md-push-4 col-sm-6 col-sm-push-3 col-xs-12" style="margin-bottom: 60px; text-align: center;">
            <img src="./images/ntt.jpg" height="100">
            <h4 class="tlt" style="margin-bottom: 20px;" data-in-effect="bounceInRight">Silahkan Login</h4>
            <form class="form-group" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">	
                <div class="input-group" style="margin-bottom:15px;">
                    <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-user"></i></span>
                    <input id="nohp" class="form-control"  type="text" name="username" placeholder="Nama" aria-describedby="basic-addon1">			
                </div>		
                <div class="input-group" style="margin-bottom:15px">		
                    <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-lock"></i></span>		
                    <input class="form-control" type="password" name="password" placeholder="Password" aria-describedby="basic-addon1">		
                </div>
                <div class="form-inline">
                    <button class="btn btn-block btn-lg btn-danger" name="btn-login" type="submit"><span><i class="glyphicon glyphicon-user"></i> Login</span></button>
                </div>
            </form>
        </div>
    </div>
    <script src="./js/textillate/assets/jquery.fittext.js"></script>
    <script src="./js/textillate/assets/jquery.lettering.js"></script>
    <script src="./js/textillate/jquery.textillate.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#content-header").fadeIn("slow");
            $("#navbar").fadeIn(3000);
            $("footer").fadeIn(4000);
            $(function () {
                $('.tlt').textillate();
            });
        });
    </script>
</body>
<?php require_once "footer.php"; ?>
</html>