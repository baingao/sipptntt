<?php
require_once '../../public/includes.php';
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = 100;
$perpage = 10;
$start = ($page > 1) ? ($page * $perpage) - $perpage : 0;
$db = new DbConnect();
$stmt = $db->connect()->prepare("SELECT SQL_CALC_FOUND_ROWS AI, NamaPemohon FROM register LIMIT {$start},{$perpage}");
$stmt->execute();
$select = $stmt->fetchALL(PDO::FETCH_ASSOC);
//echo "<pre>",print_r($select),"</pre>";
//------page--------4
$stmt = $db->connect()->query("SELECT IF(COUNT(AI)<{$limit}, COUNT(AI), {$limit}) AS total FROM register");
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$total = $result['total']; //total num of rows
echo $total;
$pages = ceil($total / $perpage); // ceil() is used to rounding off values
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Pegination</title>

    </head>
    <body>
        <?php foreach ($select as $selects): ?>
            <div class ="articles">	

                <p><?php echo $selects['AI'], ": ", $selects['NamaPemohon'], ".<br>" ?></p>

            </div>
        <?php endforeach; ?>
        <div class="pegination">

            <?php for ($i = 1; $i <= $pages; $i++): ?>
                <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>	
            <?php endfor; ?>

        </div>

    </body>
</html>