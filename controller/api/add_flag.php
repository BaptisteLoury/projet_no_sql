<?php
require_once("../../model/db.php");

$content = file_get_contents('php://input');
$like = (array) json_decode($content);

$usr = $like['usr'];
$pst = $like['pst'];
$co = new DB();
$query = "INSERT INTO main.flaged(usr_id,pst_id) VALUES ($usr,$pst)";
pg_query($co->getDbconn(), $query);
$co->close();
?>