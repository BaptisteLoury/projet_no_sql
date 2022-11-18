<?php
require_once("../../model/db.php");

   /**
     * Ajoute ou retire des points si le post est une imposture
     * @param $pst_id
     * @return
     */
    function checkImposture($pst_id,$usr_id)
    {
        $co = new DB();
        $res = pg_query($co->getDbconn(), "SELECT pst_isImposteur FROM main.posts WHERE pst_id=$pst_id");
        if (pg_fetch_row($res)[0] == "t") {
            pg_query($co->getDbconn(), "UPDATE main.users SET usr_points = usr_points + 10 WHERE usr_id = $usr_id");
        }
        else {
            pg_query($co->getDbconn(), "UPDATE main.users SET usr_points = usr_points - 5 WHERE usr_id = $usr_id");
        }
    }

$content = file_get_contents('php://input');
$like = (array) json_decode($content);

$usr = $like['usr'];
$pst = $like['pst'];
$co = new DB();
$query = "INSERT INTO main.discovered(usr_id,pst_id) VALUES ($usr,$pst)";
pg_query($co->getDbconn(), $query);
checkImposture($pst,$usr);
$co->close();
?>