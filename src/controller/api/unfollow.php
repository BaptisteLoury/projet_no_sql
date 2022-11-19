<?php
require_once("../../model/db.php");

$content = file_get_contents('php://input');
$like = (array) json_decode($content);

$usr = $like['usr'];
$other = $like['other'];
$co = new DB();
$query = "DELETE FROM main.follow WHERE usr_id = $usr AND usr_id_1 = $other";
pg_query($co->getDbconn(), $query);
$co->close();
?>



