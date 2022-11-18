<?php
require_once("../../model/db.php");

$content = file_get_contents('php://input');
$like = (array) json_decode($content);

$usr = $like['usr'];
$pst = $like['pst'];
$co = new DB();
$query = "DELETE FROM main.flaged WHERE usr_id = $usr AND pst_id = $pst";
pg_query($co->getDbconn(), $query);
$co->close();
?>



