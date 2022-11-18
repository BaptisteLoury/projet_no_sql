<?php
    require_once("../../model/db.php");

    $content = file_get_contents('php://input');
    $search = (array) json_decode($content);
    
    $match = $search['match'];
    $co = new DB();
    $query = "SELECT usr_id, usr_pseudo FROM main.users WHERE usr_pseudo LIKE '%$match%'";
    $result = pg_query($query) or die('Échec de la requête : ' . pg_last_error());
    $matching_usr = array();

    while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
        ;
        $matching_usr[] = $line;
    }

    $co->close();

    header('Content-type: application/json');
    echo json_encode($matching_usr);
?>