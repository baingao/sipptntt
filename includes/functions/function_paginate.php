<?php
require 'connect.php';
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$perpage = 10;
$start = ($page > 1) ? ($page * $perpage) - $perpage : 0;
$select = $db->prepare("
		SELECT SQL_CALC_FOUND_ROWS id, title
		FROM pegination
		LIMIT {$start},5
		");
$select->execute();
$select = $select->fetchALL(PDO::FETCH_ASSOC);
//echo "<pre>",print_r($select),"</pre>";
//------page--------
$total = $db->query("SELECT FOUND_ROWS() as total")->fetch()['total']; //total num of rows

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

                <p><?php echo $selects['id'], ": ", $selects['title'], ".<br>" ?></p>

            </div>
<?php endforeach; ?>
        <div class="pegination">

        <?php for ($i = 1; $i <= $pages; $i++): ?>
                <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>	
<?php endfor; ?>

        </div>

    </body>
</html>