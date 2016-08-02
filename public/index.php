<?php
// ** Created by Bill Radja Pono on 07/29/2016
session_start();
require_once "header.php";
?>

<!DOCTYPE html>
<head>
    <title>Sistem Informasi Pelayanan Perizinan Terpadu Provinsi NTT</title>
</head>
<body>
    <div id="content-header" class="container-fluid header" style="display: none">
        <div id="content-title">
            <h3 class="tlt" data-in-effect="bounceInLeft">Sistem Informasi Pelayanan Perizinan Terpadu</h3><br>
            <p class="tlt" style="font-size: 150%;" data-in-effect="bounceInRight">Provinsi Nusa Tenggara Timur</p>
        </div>
        <div id="button-container" class="form-button"></div>
    </div>
    <div id="message-container"></div>
    <div id="content-main" class="content-center"></div>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#content-header").fadeIn("slow");
            $("#navbar").fadeIn(3000);
            $("footer").fadeIn(4000);
            $(function () {
                $('.tlt').textillate({
                    selector: '.texts',
                    loop: true,
                    minDisplayTime: 2000,
                    initialDelay: 0,
                    autoStart: true,
                    inEffects: [],
                    outEffects: ['hinge'],
                    in: {
                        effect: 'fadeInLeftBig',
                        delayScale: 1.5,
                        delay: 50,
                        sync: false,
                        shuffle: true,
                        reverse: false,
                        callback: function () {}
                    },
                    out: {
                        effect: 'hinge',
                        delayScale: 1.5,
                        delay: 50,
                        sync: false,
                        shuffle: true,
                        reverse: false,
                        callback: function () {}
                    },
                    callback: function () {},
                    type: 'char'
                });
            })
        });
    </script>
</body>
<?php require_once "footer.php"; ?>
</html>