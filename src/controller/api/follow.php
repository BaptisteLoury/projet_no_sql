<?php
    require_once("../../model/db.php");

    $content = file_get_contents('php://input');
    $like = (array) json_decode($content);
    
    $usr = $like['usr'];
    $other = $like['other'];
    $co = new DB();
    $query = "INSERT INTO main.follow (usr_id, usr_id_1) VALUES ($usr,$other)";
    pg_query($co->getDbconn(), $query);
    $co->close();
?>