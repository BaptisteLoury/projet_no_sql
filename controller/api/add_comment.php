<?php
    require_once("../../model/db.php");

    $content = file_get_contents('php://input');
    $like = (array) json_decode($content);
    
    $usr_id = $like['usr'];
    $pst_id = $like['pst'];
    $comment = $like['cmt'];
    $co = new DB();
    $query = "INSERT INTO main.comment (pst_id, usr_id, cmt_content) VALUES ($pst_id, $usr_id, '$comment')";
    pg_query($co->getDbconn(), $query);
    $co->close();
?>