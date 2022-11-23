<?php
require_once("../../model/db.php");
require_once("../con_posts.php");
require_once("../../model/redis.php");

$content = file_get_contents('php://input');
$like = (array) json_decode($content);

$usr = $like['usr'];
$pst = $like['pst'];
$co = new DB();
$query = "INSERT INTO main.LIKED(usr_id,pst_id) VALUES ($usr,$pst)";
pg_query($co->getDbconn(), $query);


$cache = new Cache();
$redis = $cache->getConn();

$last = $redis->get("LastUpdate");
$current = date('d-m-y h:i:s');

if(!empty($last)) {
    $date = new \DateTime($last);
    $current_dt = new \DateTime($current);
    $diff_in_sec = $current_dt->getTimestamp() - $date->getTimestamp();

    if($diff_in_sec > 20) {

        $top10 = getTop10Likes();
        $i = 1;
        
        $redis->set("LastUpdate", $current);
        
        foreach($top10 as $tuser) {
        
            $key = "trend_user_" . $i;
            $redis->del($key);
            $redis->rpush($key, $tuser['usr_id']);
            $redis->rpush($key, $tuser['usr_pseudo']);
            $redis->rpush($key, $tuser['nb_likes']);
        
            $i += 1;
        }

    }
} else {
    $redis->set("LastUpdate",$current);
}
?>