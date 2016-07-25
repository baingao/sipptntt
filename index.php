<?php
// ** Created by Bill Radja Pono on 07/23/2016

include "./includes/includes.php";
?>

<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./includes/css/bootstrap.min.css">
    <title>Percobaan CRUD</title>
</head>
<body>
    <div class="container-fluid col-lg-4 col-md-6 col-sm-8 col-xs-12">
        <form role="form">    
                <?php
                $ippt = new Table();
                $ippt->setKecuali(array("AI", "NoReg", "Tag"));
                $ippt->createInsertForm("ippt");
                ?>
        </form>
    </div>
</body>

</html>